<?php

if (! function_exists('group_icon')) {
    function group_icon($name)
    {
        $n = strtolower($name);

        return match (true) {
            str_contains($n, 'ekonomi') => 'bi bi-graph-up',
            str_contains($n, 'industri') => 'bi bi-buildings',
            str_contains($n, 'pendidikan') => 'bi bi-mortarboard',
            str_contains($n, 'kesehatan'), str_contains($n, 'sosial') => 'bi bi-heart-pulse',
            str_contains($n, 'lingkungan') => 'bi bi-tree',
            str_contains($n, 'pemerintahan') => 'bi bi-bank',
            default => 'bi bi-folder',
        };
    }
}

if (! function_exists('mask_pribadi')) {
    /**
     * Mask personal sensitive data (NIK, Email, Phone, Name, etc.)
     *
     * @param string $value The text or string to be masked
     * @param string $type The specific type (e.g. 'nik', 'email', 'phone', 'name') or 'auto' for pattern matching in text.
     * @return string
     */
    function mask_pribadi($value, $type = 'auto')
    {
        if (empty($value)) {
            return $value;
        }

        try {
            $service = app(\App\Services\DataMaskingService::class);
            if ($type === 'auto') {
                return $service->maskText($value);
            }
            return $service->maskStringAuto($value, $type);
        } catch (\Exception $e) {
            return $value;
        }
    }
}

