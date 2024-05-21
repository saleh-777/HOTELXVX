<?php

namespace WPNCEasyWP\Http\Providers;

use WP_Error;
use WPNCEasyWP\Http\Support\Throttle;
use WPNCEasyWP\WPBones\Support\ServiceProvider;

class WordPressLoginServiceProvider extends ServiceProvider
{
    use Throttle;

    protected $admin_path = "";

    public function register()
    {
        $this->throttleName    = 'x_autologin_';
        $this->throttleTimeout = 30;

        if (isset($_REQUEST['ewp-action'])) {
            $this->admin_path = isset($_REQUEST['admin_path']) ? $_REQUEST['admin_path'] : "";

            $action = $_REQUEST['ewp-action'];
            $decode = parse_url($action);

            if ($url = $this->isAction($decode)) {
                if (!is_wp_error($this->grant($url))) {
                    do_action('clear_varnish');
                    do_action('clear_redis');
                    do_action('clear_opcache');

                    $this->login();
                }
            }
        }
    }

    protected function isAction($value)
    {
        // domains allowed
        $domains = [
          'dashboard.easywp.com',
          'dashboard.easywp.website',
          'dashboard.easywp.cloud',
          'easywp.cs',
          'dashboard.namecheapcloud.host',
          'dashboard.namecheapcloud.net',
          'cs-panel.namecheapcloud.host',
          'cs-panel.namecheapcloud.net',
          'spaceship.com',
          'www.spaceship.com',
        ];

        $host        = $value['host'];
        $isSpaceship = $host === 'spaceship.com' || $host === 'www.spaceship.com';

        if (!in_array($host, $domains)) {
            return false;
        }

        $path = array_filter(explode('/', $value['path']));

        if($isSpaceship) {
            if ($path[1] !== 'gateway' || $path[2] !== 'api' || $path[3] !== 'v1' || $path[4] !== 'easywp-dashboard' || $path[5] !== 'admin') {
                return false;
            }

            $query = substr($value['query'], 0, 9);

            if ($query !== 'websiteId') {
                return false;
            }

        } else {
            if ($path[1] !== 'api' || $path[2] !== 'v1' || $path[3] !== 'websites' || $path[5] !== 'wpadmin_webhook') {
                return false;
            }

            $query = substr($value['query'], 0, 5);

            if ($query !== 'state') {
                return false;
            }
        }

        return $value['scheme'] . '://' . $host . $value['path'] . '?' . $value['query'];
    }

    protected function grant($redirect)
    {
        $args = [
          'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
          ],
          'method' => 'GET',
    ];

        $url = rtrim(get_site_url(), '/');

        $redirect .= "&site_url={$url}";

        add_filter('https_ssl_verify', '__return_false');

        $response = wp_remote_request($redirect, $args);

        add_filter('https_ssl_verify', '__return_true');

        $code = wp_remote_retrieve_response_code($response);

        if (200 !== $code) {
            $error = new WP_Error('ewp_bad_status');
            $error->add_data($code);

            return $error;
        }

        return (array) json_decode(wp_remote_retrieve_body($response), true);
    }

    protected function login()
    {
        $redirect = esc_url_raw(self_admin_url());

        if (current_user_can('administrator')) {
            wp_safe_redirect($redirect . $this->admin_path);

            exit;
        }

        $user = $this->getUserId();

        if ($user) {
            wp_set_auth_cookie($user->ID);

            wp_safe_redirect($redirect . $this->admin_path);

            exit;
        }
    }

    protected function getUserId()
    {
        // Get the oldest administrator as a fallback.
        $user = get_users([
              'number' => 1,
              'role' => 'administrator',
              'orderby' => 'registered',
              'order' => 'ASC',
            ]);

        return !empty($user[0]->ID) ? $user[0] : false;
    }
}
