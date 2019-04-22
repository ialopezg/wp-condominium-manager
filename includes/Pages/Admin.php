<?php

/**
 * @package wpcm
 */


namespace WPCMPlugin\Pages;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Settings;
use WPCMPlugin\Base\BaseController;

class Admin extends BaseController {
    public $callbacks;
    public $pages = array();
    public $settings;
    public $subPages = array();

    public function register() {
        $this->settings = new Settings();
        $this->callbacks = new AdminCallbacks();

        $this->setPages();
        $this->setSubPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages($this->pages)->withSubPages('Dashboard')->addSubPages($this->subPages)->register();
    }

    public function setPages() {
        $this->pages = array(
            array(
                'page_title' => 'WPCM Plugin',
                'menu_title' => 'WPCM',
                'capability' => 'manage_options',
                'menu_slug' => 'wpcm_plugin',
                'callback' => array($this->callbacks, 'dashboard'),
                'icon_url' => 'dashicons-building',
                'position' => 110
            )
        );
    }

    public function setSubPages() {
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

    public function setSettings() {
        $args = array(
            array(
                'option_group'  => 'wpcm_options_group',
                'option_name'   => 'text_example',
                'callback'      => array($this->callbacks, 'optionsGroup')
            )
        );

        $this->settings->setSettings($args);
    }

    public function setSections() {
        $args = array(
            array(
                'id'        => 'wpcm_admin_index',
                'title'     => 'Settings',
                'callback'  => array($this->callbacks, 'wpcmAdminSection'),
                'page'      => 'wpcm_plugin'
            )
        );

        $this->settings->setSections($args);
    }

    public function setFields() {
        $args = array(
            array(
                'id'        => 'text_example',
                'title'     => 'Text Example',
                'callback'  => array($this->callbacks, 'wpcmTextExample'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'text_sample',
                    'class'     => 'example-class'
                )
            )
        );

        $this->settings->setFields($args);
    }
}