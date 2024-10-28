<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Midtrans Server Key
    |--------------------------------------------------------------------------
    |
    | Masukkan server key Anda yang didapatkan dari dashboard Midtrans.
    | Server key ini digunakan untuk proses server-side API.
    |
    */
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Client Key
    |--------------------------------------------------------------------------
    |
    | Masukkan client key Anda yang didapatkan dari dashboard Midtrans.
    | Client key ini digunakan untuk proses client-side (Snap.js).
    |
    */
    'client_key' => env('MIDTRANS_CLIENT_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Environment
    |--------------------------------------------------------------------------
    |
    | Tentukan apakah Anda ingin menggunakan environment 'sandbox' untuk testing
    | atau 'production' untuk produksi. Ini akan menentukan API endpoint yang digunakan.
    |
    */
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    /*
    |--------------------------------------------------------------------------
    | Midtrans 3DS
    |--------------------------------------------------------------------------
    |
    | Mengaktifkan atau menonaktifkan 3DS (3D Secure) untuk transaksi menggunakan
    | kartu kredit. Sangat disarankan untuk mengaktifkannya.
    |
    */
    'is_3ds' => env('MIDTRANS_IS_3DS', true),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Sanitized
    |--------------------------------------------------------------------------
    |
    | Mengaktifkan fitur sanitized untuk membersihkan data request yang dikirim
    | ke Midtrans.
    |
    */
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),

];
