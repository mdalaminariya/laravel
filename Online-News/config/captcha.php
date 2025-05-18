<?php

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'options' => [
        'timeout' => 30,
        'size' => 'normal', // ✅ Forces checkbox instead of invisible reCAPTCHA
    ],
];
