<?php

/*
|--------------------------------------------------------------------------
| Plugin options
|--------------------------------------------------------------------------
|
| Here is where you can insert the options model of your plugin.
| These options model will store in WordPress options table
| (usually wp_options).
| You'll get these options by using `$plugin->options` property
|
*/

return [
    'http_request' => [
        'done' => '',
    ],

    'varnish' => [
        'enabled'              => true,
        'schema'               => 'http://',
        'ip'                   => '127.0.0.1',
        'default_purge_method' => 'default',
        'last_do_purge_call'   => '',
        'last_purged_urls'     => '',
        'last_purge'           => '',
        'last_purge_url'       => '',
        'last_error'           => '',
        'purge_response'       => '',
        'log' => [],
        'error' => [],
    ],

    'banned-plugins' => []

];