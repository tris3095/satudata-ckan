<?php
$body = file_get_contents('https://dna.web.bps.go.id/api/metadata/mskeg/detail/67559', false, stream_context_create([
    'http' => [
        'header' => "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzVhNmRjNDYwNDUxZGUyNGYyNDgxYjBkMGU3ZjUzZjQ3OTYzNTY5ZjUyZDY2ODkyYTJjZjBiMjAzNzM4Yzk1YjlkZGFmMTkxZmZkNDMzZTgiLCJpYXQiOjE3NzY3NTI3MzEuODk0MDQ0LCJuYmYiOjE3NzY3NTI3MzEuODk0MDQ4LCJleHAiOjE4MDgyODg3MzEuODcxNzM0LCJzdWIiOiIyNzIiLCJzY29wZXMiOltdfQ.y0xftZSylpNnX1cn87A-1M8Sjry4760EWqw95k9q8nccVJmkOIFvl2G1LifGuDdHzk8Ltd6gFRM2hkgKQjDy7TMYXKwyTrocfkS2wpZrZY-ARMrkwQhKXkN7aIyurnRXeA3J3SuXv9_EIsqjUmsm7MoURHDs1umk_62TQ4ZL2dKoZmSkem8xDzvfQY4f98Mx1ktSYD56luUOaWF45daCD3O-g1y9NOfGgvzVKOd0mS44JQu6McyrsKN_JPTNByoKf7fSUpbZMRRJiH4AXSR7P7Op-aeWkNyM9pV6HBVvMFmrUqW1hzM8SWU7txRNcbpLqrGY_ztONcZdeJSVENls1Q\r\nAccept: */*\r\n"
    ]
]));
$data = json_decode($body, true);
$collectionData = $data['result'] ?? [];

if (empty($collectionData)) {
    $collectionData = [];
} else {
    foreach ($collectionData as $key => $value) {
        if (is_array($value)) {
            if (empty($value)) {
                $collectionData[$key] = '-';
            } elseif (isset($value[0]['awal']) && isset($value[0]['akhir'])) {
                $collectionData[$key] = $value[0]['awal'] . ' s/d ' . $value[0]['akhir'];
            } elseif (isset($value[0]) && is_string($value[0])) {
                $collectionData[$key] = implode(', ', $value);
            } else {
                $collectionData[$key] = json_encode($value);
            }
        }
    }
}
print_r(array_slice($collectionData, 0, 5));
echo "Jadwal Desain: " . $collectionData['iii_jadwal_desain'] . "\n";
