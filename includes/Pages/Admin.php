<?php

namespace WPCMPlugin\Pages;

use WPCMPlugin\Base\BaseController;

class Admin extends BaseController {
    public function register() {
        // Admin menu
        add_action('admin_menu', array($this, 'add_admin_pages'));
    }

    public function add_admin_pages() {
        add_menu_page('WPCM Plugin', 'WPCMP', 'manage_options', 'wpcm_plugin', array($this, 'admin_index'), 'dashicons-building', 110);
    }

    public function admin_index() {
        require_once($this->plugin_path . 'templates/admin.php');
    }
}