<?php

namespace WPNCEasyWP\Http\OPcache;

use Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use WPNCEasyWP\Http\Support\AdminMenuableTrait;
use WPNCEasyWP\Http\Support\Cache;

class OPcache extends Cache
{
    use AdminMenuableTrait;

    /**
     * Action used to clear all
     *
     * @var string
     */
    protected $action = 'clear_opcache';

    /**
     * List of actions where will be clear the opcache.
     *
     * @var array
     */
    protected $actions = [
        'activate_plugin',
        'deactivate_plugin',
        'switch_theme',
        'upgrader_process_complete',
        'automatic_updates_complete',
        'delete_option_update_core',
        'clear_opcache',
    ];

    /**
     * Entry point.
     */
    public function __construct()
    {
        foreach ($this->actions as $action) {
            add_action($action, [$this, 'flushOPcache']);
        }

        add_filter(
            'auto_core_update_email',
            function ($email) {
                $this->flushOPcache();

                return $email;
            }
        );

        //$this->addMenuItem(__('Clear OPcache', 'wp-nc-easywp'));

        $this->enableForClearAll();
    }

    public function flushOPcache()
    {
        if (function_exists('opcache_reset')) {
            //$this->flushOPcacheFiles();
            WPNCEasyWP()->options->set('opcache_reset', ['last_time' => date('Y-m-d H:i:s')]);
            opcache_reset();
            //$this->flushOPcachePreload();
        }
    }

    protected function flushOPcacheFiles()
    {
        try {
            if (class_exists('RecursiveDirectoryIterator')) {
                $fileCache = ini_get('opcache.file_cache');

                if ($fileCache && is_writable($fileCache)) {
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($fileCache, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
                    foreach ($files as $fileinfo) {
                        if ($fileinfo->isDir()) {
                            @rmdir($fileinfo->getRealPath());
                        } else {
                            @unlink($fileinfo->getRealPath());
                        }
                    }
                }
            }
        } catch (Exception $e) {
            logger()->error('flushOPcacheFiles', [$e]);
        }
    }

    protected function flushOPcachePreload()
    {
        try {
            if (function_exists('opcache_compile_file') && class_exists('RecursiveDirectoryIterator')) {
                $di = new RecursiveDirectoryIterator(ABSPATH, RecursiveDirectoryIterator::SKIP_DOTS);
                $it = new RecursiveIteratorIterator($di);

                foreach ($it as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) == "php") {
                        @opcache_compile_file($file);
                    }
                }
            }
        } catch (Exception $e) {
            logger()->error('flushOPcachePreload', [$e]);
        }
    }


    /**
     * Method used to clear all.
     *
     * @param bool $silent Set to true to hidden the admin notice. Default false.
     */
    public function doActionMenu($silent = false)
    {
        $this->flushOPcache();

        if (!$silent) {
            add_action('admin_notices', function () {
                echo '<div id="message" class="notice notice-success fade is-dismissible">';
                echo '<p>';
                _e('OPcache emptied!', 'wp-nc-easywp');
                echo '</p>';
                echo '</div>';
            });
        }
    }
}
