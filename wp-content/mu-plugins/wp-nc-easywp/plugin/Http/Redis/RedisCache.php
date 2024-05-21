<?php

namespace WPNCEasyWP\Http\Redis;

use WPNCEasyWP\Http\Support\AdminMenuableTrait;
use WPNCEasyWP\Http\Support\Cache;

class RedisCache extends Cache
{
    use AdminMenuableTrait;

    /**
     * Action used to clear all
     *
     * @var string
     */
    protected $action = 'clear_redis';

    /**
     * Entry point.
     */
    public function __construct()
    {
        //$this->addMenuItem(__('Flush Redis cache', 'wp-nc-easywp'));

        $this->enableForClearAll();

        // EASYWP-4703
        add_action('automatic_updates_complete', 'wp_cache_flush');
        add_action('upgrader_process_complete', 'wp_cache_flush');
        add_action('delete_option_update_core', 'wp_cache_flush');
        add_action('clear_redis', 'wp_cache_flush');
        add_action($this->action, 'wp_cache_flush');
        add_filter(
            'auto_core_update_email',
            function ($email) {
                wp_cache_flush();

                return $email;
            }
        );
    }

    /**
     * Method used to clear all.
     *
     * @param bool $silent Set to true to hidden the admin notice. Default false.
     */
    public function doActionMenu($silent = false)
    {
        wp_cache_flush();

        if (!$silent) {
            add_action('admin_notices', function () {
                echo '<div id="message" class="notice notice-success fade is-dismissible">';
                echo '<p>';
                _e('Redis cache emptied!', 'wp-nc-easywp');
                echo '</p>';
                echo '</div>';
            });
        }
    }
}
