<?php

namespace WPNCEasyWP\Http\Providers;

use WPNCEasyWP\Http\Support\AdminMenu;
use WPNCEasyWP\WPBones\Support\ServiceProvider;

class EasyWPServiceProvider extends ServiceProvider
{
  public function register()
  {
    // easywp admin menu bar
    add_action("admin_bar_menu", [$this, "adminBarMenu"], 100);

    // check if we have to do some action
    add_action("admin_init", [$this, "processBarActions"]);
    add_action("wp_loaded", [$this, "processBarActions"]);
  }

  public function processBarActions()
  {
    if (isset($_GET[AdminMenu::ACTION_KEY]) && check_admin_referer(AdminMenu::NONCE)) {
      $action = $_GET[AdminMenu::ACTION_KEY] ?: false;

      if ($action) {
        /**
         * Fires the request action.
         *
         * The dynamic portion of the hook name, $action, refers to the action will be execute.
         */
        do_action(AdminMenu::ACTION_KEY . "_{$action}");
      }
    }
  }

  /**
   * Add the EasyWP Menu in the admin admin bar for administrator user.
   *
   * @param $adminBar
   */
  public function adminBarMenu($adminBar)
  {
    // administrator only
    if (current_user_can("activate_plugins")) {
      $adminMenu = [
        [
          "id" => AdminMenu::PARENT_MENU_ID,
          "title" =>
            '<span class="desktop-clearcahe">' .
            __("Clear Cache", "wp-nc-easywp") .
            '</span> <span class="mobile-clearcache">🧽</span>',
          "href" => wp_nonce_url(add_query_arg(AdminMenu::ACTION_KEY, AdminMenu::ACTION_CLEAR_ALL), AdminMenu::NONCE),
          "meta" => [
            "title" => __("Clear Cache", "wp-nc-easywp"),
          ],
        ],
      ];

      //            $adminMenu[] = [
      //                'parent' => AdminMenu::PARENT_MENU_ID,
      //                'id'     => 'wpnceasywp-clear-all-cache',
      //                'title'  => __('Clear Cache', 'wp-nc-easywp'),
      //                'href'   => wp_nonce_url(add_query_arg(AdminMenu::ACTION_KEY, AdminMenu::ACTION_CLEAR_ALL), AdminMenu::NONCE),
      //                'meta'   => [
      //                    'title' => __('Clear Cache', 'wp-nc-easywp'),
      //                ],
      //            ];

      /**
       * Filter the additional admin menu item.
       *
       * The dynamic portion of the hook name, $adminMenu, refers to the list of menu item.
       *
       * @param array $adminMenu
       */
      $adminMenu = apply_filters("wpnceasywp_admin_menu", $adminMenu);

      foreach ($adminMenu as $menu) {
        $adminBar->add_node($menu);
      }
    }
  }
}
