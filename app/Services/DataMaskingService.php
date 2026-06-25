<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataMaskingService
{
    protected bool $enabled;
    protected string $maskChar;
    protected array $sensitiveKeys;
    protected array $patterns;

    public function __construct()
    {
        $this->enabled = config('masking.enabled', true);
        $this->maskChar = config('masking.mask_char', '*');
        $this->sensitiveKeys = config('masking.sensitive_keys', []);
        $this->patterns = config('masking.patterns', []);
    }

    /**
     * Check if a key/column header is considered sensitive.
     */
    public function isKeySensitive(string $key): bool
    {
        $key = strtolower(trim($key));
        foreach ($this->sensitiveKeys as $sensitiveKey) {
            if (str_contains($key, strtolower($sensitiveKey))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Mask a string based on key/column type or automatic detection.
     */
    public function maskStringAuto(string $value, string $key = ''): string
    {
        if (!$this->enabled || empty(trim($value))) {
            return $value;
        }

        $key = strtolower(trim($key));

        if (str_contains($key, 'nik') || str_contains($key, 'ktp')) {
            return $this->maskNik($value);
        }

        if (str_contains($key, 'email')) {
            return $this->maskEmail($value);
        }

        if (str_contains($key, 'phone') || str_contains($key, 'hp') || str_contains($key, 'telp') || str_contains($key, 'telepon')) {
            return $this->maskPhone($value);
        }

        if (str_contains($key, 'nama') || str_contains($key, 'name')) {
            return $this->maskName($value);
        }

        // Automatic detection fallback
        return $this->maskText($value);
    }

    /**
     * Mask NIK (16 digits). Keep first 6 (area code) and last 2, mask the middle 8.
     * Example: 3171123456789012 -> 317112******9012 (middle masked) or if short / invalid, mask all but last 2.
     */
    public function maskNik(string $nik): string
    {
        $clean = preg_replace('/\D/', '', $nik);
        if (strlen($clean) === 16) {
            return substr($clean, 0, 6) . str_repeat($this->maskChar, 6) . substr($clean, -4);
        }
        
        // Fallback for non-standard length
        if (strlen($clean) > 4) {
            return str_repeat($this->maskChar, strlen($clean) - 4) . substr($clean, -4);
        }
        return str_repeat($this->maskChar, strlen($nik));
    }

    /**
     * Mask Email address. Keeps first 2 and last 1 char of local part, masks the rest. Keeps domain.
     * Example: john.doe@example.com -> jo***e@example.com
     */
    public function maskEmail(string $email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // If invalid email format but matches pattern
            $parts = explode('@', $email);
            if (count($parts) !== 2) {
                return str_repeat($this->maskChar, strlen($email));
            }
        } else {
            $parts = explode('@', $email);
        }

        $local = $parts[0];
        $domain = $parts[1];
        $len = strlen($local);

        if ($len <= 2) {
            $maskedLocal = substr($local, 0, 1) . str_repeat($this->maskChar, max(1, $len - 1));
        } else {
            $maskedLocal = substr($local, 0, 2) . str_repeat($this->maskChar, max(1, $len - 3)) . substr($local, -1);
        }

        return $maskedLocal . '@' . $domain;
    }

    /**
     * Mask Phone number. Keeps first 4 digits (operator prefix) and last 3, masks the middle.
     * Example: 081234567890 -> 0812*****890
     */
    public function maskPhone(string $phone): string
    {
        $clean = preg_replace('/[^\d+]/', '', $phone);
        $len = strlen($clean);

        if ($len > 7) {
            // Handles +62 or 08 prefixes
            $prefixLen = str_starts_with($clean, '+') ? 5 : 4;
            return substr($clean, 0, $prefixLen) . str_repeat($this->maskChar, max(1, $len - $prefixLen - 3)) . substr($clean, -3);
        }

        return str_repeat($this->maskChar, max(1, strlen($phone)));
    }

    /**
     * Mask Name. Masks middle of each word in a name.
     * Example: Budi Santoso -> B**i S*****o
     */
    public function maskName(string $name): string
    {
        $words = explode(' ', $name);
        $maskedWords = [];

        foreach ($words as $word) {
            $len = strlen($word);
            if ($len <= 2) {
                $maskedWords[] = substr($word, 0, 1) . str_repeat($this->maskChar, max(0, $len - 1));
            } else {
                $maskedWords[] = substr($word, 0, 1) . str_repeat($this->maskChar, $len - 2) . substr($word, -1);
            }
        }

        return implode(' ', $maskedWords);
    }

    /**
     * Find and mask NIK, Email, and Phone patterns in raw text blocks using Regex.
     */
    public function maskText(string $text): string
    {
        if (!$this->enabled || empty($text)) {
            return $text;
        }

        // Mask Emails
        if (!empty($this->patterns['email'])) {
            $text = preg_replace_callback($this->patterns['email'], function ($matches) {
                return $this->maskEmail($matches[0]);
            }, $text);
        }

        // Mask NIKs
        if (!empty($this->patterns['nik'])) {
            $text = preg_replace_callback($this->patterns['nik'], function ($matches) {
                return $this->maskNik($matches[0]);
            }, $text);
        }

        // Mask Phones
        if (!empty($this->patterns['phone'])) {
            $text = preg_replace_callback($this->patterns['phone'], function ($matches) {
                return $this->maskPhone($matches[0]);
            }, $text);
        }

        return $text;
    }

    /**
     * Mask values inside CSV content. Detects sensitive columns and masks their values.
     * Runs pattern-based masking on other fields.
     */
    public function maskCsv(string $csvContent): string
    {
        if (!$this->enabled || empty($csvContent)) {
            return $csvContent;
        }

        $lines = preg_split('/\r\n|\r|\n/', $csvContent);
        if (empty($lines)) {
            return $csvContent;
        }

        // Detect line endings
        $lineEnding = "\n";
        if (str_contains($csvContent, "\r\n")) {
            $lineEnding = "\r\n";
        } elseif (str_contains($csvContent, "\r")) {
            $lineEnding = "\r";
        }

        // Parse headers from the first non-empty line
        $headerIndex = -1;
        $headers = [];
        foreach ($lines as $idx => $line) {
            if (!empty(trim($line))) {
                $headerIndex = $idx;
                $headers = str_getcsv($line);
                break;
            }
        }

        if ($headerIndex === -1 || empty($headers)) {
            return $csvContent; // No readable headers
        }

        // Identify sensitive columns
        $sensitiveCols = [];
        foreach ($headers as $colIdx => $header) {
            if ($this->isKeySensitive($header)) {
                $sensitiveCols[$colIdx] = strtolower(trim($header));
            }
        }

        $outputRows = [];
        // Keep lines before header as-is (e.g. metadata lines if any)
        for ($i = 0; $i < $headerIndex; $i++) {
            $outputRows[] = $lines[$i];
        }

        // Add header line as-is
        $outputRows[] = $lines[$headerIndex];

        // Process data lines
        $totalLines = count($lines);
        for ($i = $headerIndex + 1; $i < $totalLines; $i++) {
            $line = $lines[$i];
            if (empty(trim($line))) {
                $outputRows[] = $line;
                continue;
            }

            $row = str_getcsv($line);
            $newRow = [];

            foreach ($row as $colIdx => $val) {
                if (isset($sensitiveCols[$colIdx])) {
                    // Mask based on column type
                    $newRow[] = $this->maskStringAuto($val, $sensitiveCols[$colIdx]);
                } else {
                    // Auto mask pattern detection
                    $newRow[] = $this->maskText($val);
                }
            }

            // Write row back to CSV string format
            $tempStream = fopen('php://temp', 'r+');
            fputcsv($tempStream, $newRow);
            rewind($tempStream);
            $csvRow = rtrim(stream_get_contents($tempStream), "\r\n");
            fclose($tempStream);

            $outputRows[] = $csvRow;
        }

        return implode($lineEnding, $outputRows);
    }

    /**
     * Recursively mask keys/values in parsed arrays/objects.
     */
    public function maskArray(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->maskArray($value);
            } elseif (is_string($value)) {
                if ($this->isKeySensitive((string)$key)) {
                    $array[$key] = $this->maskStringAuto($value, (string)$key);
                } else {
                    $array[$key] = $this->maskText($value);
                }
            }
        }
        return $array;
    }

    /**
     * Mask values inside JSON content.
     */
    public function maskJson(string $jsonContent): string
    {
        if (!$this->enabled || empty($jsonContent)) {
            return $jsonContent;
        }

        $data = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Fallback to text masking if not valid JSON
            return $this->maskText($jsonContent);
        }

        if (is_array($data)) {
            $maskedData = $this->maskArray($data);
            return json_encode($maskedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        return $jsonContent;
    }

    /**
     * Fetch remote file, detect type, mask personal data if applicable, and return payload metadata.
     */
    public function maskFileFromUrl(string $url): array
    {
        try {
            $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));

            $response = Http::timeout(30)->get($url);
            if (!$response->successful()) {
                Log::warning("DataMaskingService: Failed to fetch remote url: " . $url . " Status: " . $response->status());
                return [
                    'content' => '',
                    'mime' => 'application/octet-stream',
                    'masked' => false,
                    'error' => true,
                    'status' => $response->status(),
                ];
            }

            $content = $response->body();
            $mimeType = $response->header('Content-Type') ?? 'application/octet-stream';

            if (!$this->enabled) {
                return [
                    'content' => $content,
                    'mime' => $mimeType,
                    'masked' => false,
                ];
            }

            $isCsv = ($extension === 'csv' || str_contains($mimeType, 'csv') || str_contains($mimeType, 'text/comma-separated-values'));
            $isJson = ($extension === 'json' || str_contains($mimeType, 'json'));
            $isTxt = ($extension === 'txt' || str_contains($mimeType, 'plain'));

            if ($isCsv) {
                return [
                    'content' => $this->maskCsv($content),
                    'mime' => 'text/csv',
                    'masked' => true,
                ];
            }

            if ($isJson) {
                return [
                    'content' => $this->maskJson($content),
                    'mime' => 'application/json',
                    'masked' => true,
                ];
            }

            if ($isTxt) {
                return [
                    'content' => $this->maskText($content),
                    'mime' => 'text/plain',
                    'masked' => true,
                ];
            }

            return [
                'content' => $content,
                'mime' => $mimeType,
                'masked' => false,
            ];
        } catch (\Exception $e) {
            Log::error("DataMaskingService: Exception while masking file download: " . $e->getMessage());
            return [
                'content' => '',
                'mime' => 'application/octet-stream',
                'masked' => false,
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
