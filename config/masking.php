<?php

return [
    /*
     * Enable or disable personal data masking globally.
     */
    'enabled' => env('DATA_MASKING_ENABLED', true),

    /*
     * Character used for masking sensitive data.
     */
    'mask_char' => '*',

    /*
     * Column headers or JSON object keys that contain sensitive personal data.
     * Values associated with these keys will be masked.
     */
    'sensitive_keys' => [
        'nik',
        'email',
        'telepon',
        'phone',
        'hp',
        'no_hp',
        'no_telp',
        'no_telepon',
        'ktp',
        'nama',
        'name',
        'alamat',
        'address',
    ],

    /*
     * Regular expression patterns used to auto-detect sensitive data in free text or CSV/JSON values.
     */
    'patterns' => [
        // Indonesian NIK (Nomor Induk Kependudukan) - 16 digits
        'nik' => '/\b\d{16}\b/',

        // Email address
        'email' => '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',

        // Indonesian mobile/phone numbers starting with 08 or +628
        'phone' => '/\b(?:08|\+628)\d{8,11}\b/',
    ],
];
