<?php

/**
 * @package wpcm
 */


namespace WPCMPlugin\Pages;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Callbacks\ManagerCallbacks;
use WPCMPlugin\Api\Settings;
use WPCMPlugin\Base\BaseController;

class Admin extends BaseController {
    public $callbacks;
    public $callbacks_manager;
    public $pages = array();
    public $settings;
    public $subPages = array();

    public function register() {
        $this->settings = new Settings();
        $this->callbacks = new AdminCallbacks();
        $this->callbacks_manager = new ManagerCallbacks();

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
        $args =  array(
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'wpcm_plugin',
                'callback'      => array($this->callbacks_manager, 'checkBoxSanitize')
            )
        );

        $this->settings->setSettings($args);
    }

    public function setSections() {
        $args = array(
            array(
                'id'        => 'wpcm_admin_index',
                'title'     => 'Settings Manager',
                'callback'  => array($this->callbacks_manager, 'adminSectionManager'),
                'page'      => 'wpcm_plugin'
            )
        );

        $this->settings->setSections($args);
    }

    public function setFields() {
        $args = array();
        foreach ($this->managers as $key => $value) {
            $args[] =  array(
                'id'        => $key,
                'title'     => $value,
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'option_name' => 'wpcm_plugin',
                    'label_for' => $key,
                    'class'     => 'ui-toggle'
                )
            );
        }

        $this->settings->setFields($args);
    }
}