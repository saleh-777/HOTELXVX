<?php

namespace WPNCEasyWP\Http\Providers;

use WPNCEasyWP\WPBones\Support\ServiceProvider;

class ClearByHttpRequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (isset($_SERVER['HTTP_X_EWP_CLEAR'])) {

            WPNCEasyWP()->options->set('http_request', ['done' => date('Y-m-d H:i:s')]);

            add_action('shutdown', function () {
                WPNCEasyWP()->options->set('http_request', ['action_shutdown_before' => date('Y-m-d H:i:s')]);
                do_action('clear_redis');
                do_action('clear_varnish');
                do_action('clear_opcache');
                WPNCEasyWP()->options->set('http_request', ['action_shutdown_after' => date('Y-m-d H:i:s')]);
            });
        }
    }
}
