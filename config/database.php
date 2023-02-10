<?php

return [
    'stores' => [
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],
        'redis' => [

            'client' => 'predis',

            'default' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', 'tes123'),
                'port' => env('REDIS_PORT', 6379),
                'database' => 0,
            ],

        ],
    ],


];