<?php

namespace WPNCEasyWP\Http\Providers;

use WPNCEasyWP\Http\Varnish\VarnishCache;
use WPNCEasyWP\WPBones\Support\ServiceProvider;

class VarnishServiceProvider extends ServiceProvider
{

    public function register()
    {
        VarnishCache::boot();
    }

}