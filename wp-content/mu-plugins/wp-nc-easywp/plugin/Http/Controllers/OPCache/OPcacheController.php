<?php

namespace WPNCEasyWP\Http\Controllers\OPCache;

use WPNCEasyWP\Http\Controllers\Controller;

class OPcacheController extends Controller
{
    public function index()
    {
        return WPNCEasyWP()
            ->view('opcache.index')
            ->withAdminStyles('wpnceasywp-opcache');
    }
}
