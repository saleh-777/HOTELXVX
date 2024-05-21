<?php

return [
  /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your plugin.
    |
    | Available Settings: "single", "daily", "errorlog".
    |
    | Set to false or 'none' to stop logging.
    |
    */

  "log" => false,

  "log_level" => "debug",

  /*
    |--------------------------------------------------------------------------
    | Screen options
    |--------------------------------------------------------------------------
    |
    | Here is where you can register the screen options for List Table.
    |
    */

  "screen_options" => [],

  /*
    |--------------------------------------------------------------------------
    | Custom Post Types
    |--------------------------------------------------------------------------
    |
    | Here is where you can register the Custom Post Types.
    |
    */

  "custom_post_types" => [],

  /*
    |--------------------------------------------------------------------------
    | Custom Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here is where you can register the Custom Taxonomy Types.
    |
    */

  "custom_taxonomy_types" => [],

  /*
    |--------------------------------------------------------------------------
    | Shortcodes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register the Shortcodes.
    |
    */

  "shortcodes" => [],

  /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the Widget for a plugin.
    |
    */

  "widgets" => [],

  /*
    |--------------------------------------------------------------------------
    | Ajax
    |--------------------------------------------------------------------------
    |
    | Here is where you can register your own Ajax actions.
    |
    */

  "ajax" => ["WPNCEasyWP\Ajax\WPHackGuardianAjax"],

  /*
    |--------------------------------------------------------------------------
    | Autoload Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | init to your plugin. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

  "providers" => [
    "WPNCEasyWP\Http\Providers\VarnishServiceProvider",
    "WPNCEasyWP\Http\Providers\CheckerServiceProvider",
    "WPNCEasyWP\Http\Providers\OPcacheServiceProvider",
    "WPNCEasyWP\Http\Providers\RedisServiceProvider",
    "WPNCEasyWP\Http\Providers\ClearByHttpRequestServiceProvider",
    "WPNCEasyWP\Http\Providers\WordPressLoginServiceProvider",
    "WPNCEasyWP\Http\Providers\WordPressVersionServiceProvider",
    "WPNCEasyWP\Http\Providers\EasyWPServiceProvider",
    "WPNCEasyWP\Http\Providers\HackGuardianServiceProvider",
    "WPNCEasyWP\Http\Providers\HeartbeatServiceProvider",
    "WPNCEasyWP\Http\Providers\AffiliateServiceProvider",
  ],
];
