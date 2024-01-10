<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allow Registration
    |--------------------------------------------------------------------------
    |
    | This option controls whether users can register for an account.
    | In most cases, this should be set to false. Only the admin
    | will be created on initial install
    |
    */

    'can_register' => env('FINANCIAL_FREEDOM_ALLOW_REGISTRATION', false),
];