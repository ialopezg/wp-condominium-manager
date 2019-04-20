<?php

namespace WPCMPlugin\Pages;

use WPCMPlugin\Base\BaseController;
use WPCMPlugin\Api\Settings;

class Admin extends BaseController {
    public $pages = array();
    public $settings;
    public $subPages = array();

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

        $this->subPages = array(
            array(
                'parent_slug'   => 'wpcm_plugin',
                'page_title'    => 'Custom Post Types',
                'menu_title'    => 'CPT',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_cpt',
                'callback'      => function() { echo '<h1>CPT Manager</h1>'; }
            ),
            array(
                'parent_slug'   => 'wpcm_plugin',
                'page_title'    => 'Custom Taxonomies',
                'menu_title'    => 'Taxonomies',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_taxonomies',
                'callback'      => function() { echo '<h1>Taxonomies Manager</h1>'; }
            ),
            array(
                'parent_slug'   => 'wpcm_plugin',
                'page_title'    => 'Custom Widgets',
                'menu_title'    => 'Widgets',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_widgets',
                'callback'      => function() { echo '<h1>Widgets Manager</h1>'; }
            )
        );
    }

    public function register() {
        $this->settings->addPages($this->pages)->withSubPages('Dashboard')->addSubPages($this->subPages)->register();
    }
}