<?php

namespace WPCMPlugin\Pages;

use WPCMPlugin\Base\BaseController;
use WPCMPlugin\Api\Settings;

class Admin extends BaseController {
    public $pages = array();
    public $settings;

    public function __construct() {
        $this->settings = new Settings();

        $this->pages = array(
            array(
                'page_title' => 'WPCM Plugin',
                'menu_title' => 'WPCM',
                'capability' => 'manage_options',
                'menu_slug' => 'wpcm_plugin',
                'callback' => function() { echo '<h1>WPCM Plugin</h1>'; },
                'icon_url' => 'dashicons-building',
                'position' => 110
            )
        );
    }

    public function register() {
        $this->settings->addPages($this->pages)->register();
    }
}