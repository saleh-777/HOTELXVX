<?php

namespace WPNCEasyWP\Http\Providers;

if (!defined('ABSPATH')) {
    exit;
}

use WPNCEasyWP\WPBones\Support\ServiceProvider;

class AffiliateServiceProvider extends ServiceProvider
{
    /**
     * The Translate press affiliate ID.
     */
    const TRANSLATE_PRESS_AFFILIATE_ID = '182';

    /**
     * The ShortPixel affiliate ID.
     */
    const SHORTPIXEL_AFFILIATE_ID = '4XTAIBN2104525';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // translate press
        add_filter('trp_affiliate_link', [$this, 'trp_affiliate_link']);

        // shortpixel
        add_filter('spai_affiliate_link', [$this, 'spai_affiliate_link']);
    }

    /**
     * Returns the affiliate link for Translate Press.
     *
     * @param string $link
     */
    public function trp_affiliate_link($link)
    {
        $link = add_query_arg('ref', self::TRANSLATE_PRESS_AFFILIATE_ID, $link);

        return $link;
    }

    /**
     * Returns the affiliate link for ShortPixel.
     *
     * @param string $link
     */
    public function spai_affiliate_link($link)
    {
        $link = trailingslashit($link) . 'af/' . self::SHORTPIXEL_AFFILIATE_ID;

        return $link;
    }
}
