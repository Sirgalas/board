<?php

return [
    'app_id' => env('SMS_ID'),
    'url' => env('SMS_URL'),
    'driver' => env('SMS_DRIVER', 'sms.ru'),

    'drivers' => [
        'sms.ru' => [
            'app_id' => env('SMS_APP_ID'),
            'url' => env('SMS__URL'),
        ],
    ],
];