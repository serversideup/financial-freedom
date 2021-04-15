<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MeiliSearch Host Address
    |--------------------------------------------------------------------------
    |
    | This value is used to connect to your MeiliSearch instance. It should
    | include the HTTP address and binding that the server is listening on.
    |
    | For more information on the host address, check out the MeiliSearch
    | documentation here:
    | https://docs.meilisearch.com/guides/advanced_guides/configuration.html
    |
    */

    'host' => env('MEILISEARCH_HOST', 'http://localhost:7700'),

    /*
    |--------------------------------------------------------------------------
    | MeiliSearch Master Key
    |--------------------------------------------------------------------------
    |
    | This value is used to authenticate with your MeiliSearch instance. During
    | development this is not required, but it MUST be set during a production
    | environment.
    |
    | For more information on the master key, check out the MeiliSearch
    | documentation here:
    | https://docs.meilisearch.com/guides/advanced_guides/configuration.html
    |
    */

    'key' => env('MEILISEARCH_KEY', null),

];
