<?php

namespace WPNCEasyWP\Http\Providers;

use WPNCEasyWP\Http\OPcache\OPcache;
use WPNCEasyWP\WPBones\Support\ServiceProvider;

class OPcacheServiceProvider extends ServiceProvider
{

    public function register()
    {
        OPcache::boot();
    }

}