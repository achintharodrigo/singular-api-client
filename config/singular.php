<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Base Url
    |--------------------------------------------------------------------------
    |
    | This is where you can configure Singular base url, based on the
    | application environment. On production, the value should set to
    | https://api.singular.net/api/
    |
    */

    'base_url' => env('SINGULAR_BASE_URL', 'https://api.singular.net/api/'),

    /*
    |--------------------------------------------------------------------------
    | PayHere Database Connection
    |--------------------------------------------------------------------------
    |
    | This is the database connection you want Singular to use while storing &
    | reading your analytics data. By default Singular assumes you use your
    | default connection. However, you can change that to anything you want.
    |
    */

    'database_connection' => env('DB_CONNECTION'),

    /*
     * In order to integrate the Singular API into your site,
     * you'll need to have a paid account in singular.
     *
     * singular site: https://www.singular.net/
     *
     * Once you logged in you'll be able to get the Singular Reporting API Key. you
     * need to update your .env file with this API key.
     */

    'SINGULAR_API_KEY' => '',
];
