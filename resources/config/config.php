<?php

return [

    /*
     * The Google Tag Manager id, should be a code that looks something like "gtm-xxxx".
     */
    'id' => env('GOOGLE_TAG_MANAGER_ID', ''),

    /*
     * Enable or disable script rendering. Useful for local development.
     */
    'enabled' => env('GOOGLE_TAG_MANAGER_ENABLED', true),

    /*
     * The key under which data is saved to the session with flash.
     */
    'sessionKey' => env('GOOGLE_TAG_MANAGER_SESSION_KEY', '_googleTagManager'),

    /*
     * Configures the Google Tag Manager script domain.
     * Modify this value only if you're using "Google Tag Manage: Web Container" client
     * to serve gtm.js for your web container. Else, keep the default value.
     */
    'domain' => env('GOOGLE_TAG_MANAGER_DOMAIN', 'www.googletagmanager.com'),

    /*
     * Set false to disable adding the nonce to injected script tags when you cannot
     * have unsafe-inline enabled in a CSP. 
     */
    'nonceEnabled' => env('GOOGLE_TAG_MANAGER_NONCE_ENABLED', false),
];
