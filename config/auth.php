<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Tambahkan guard untuk admin
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        // Tambahkan guard untuk alumni
        'alumni' => [
            'driver' => 'session',
            'provider' => 'alumni',
        ],

        // Tambahkan guard untuk siswa
        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswa',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Tambahkan provider untuk admin
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        // Tambahkan provider untuk alumni
        'alumni' => [
            'driver' => 'eloquent',
            'model' => App\Models\Alumni::class,
        ],

        // Tambahkan provider untuk siswa
        'siswa' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // Opsi jika ingin reset password admin (bisa dihapus jika tidak diperlukan)
        // 'admins' => [
        //     'provider' => 'admins',
        //     'table' => 'admin_password_resets',
        //     'expire' => 60,
        //     'throttle' => 60,
        // ],
    ],

    'password_timeout' => 10800,

];
