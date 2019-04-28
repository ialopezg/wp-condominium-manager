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
        $args = array(
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'cpt_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'taxonomy_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'widget_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'gallery_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'testimonial_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'templates_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'login_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'membership_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
            ),
            array(
                'option_group'  => 'wpcm_plugin_settings',
                'option_name'   => 'chat_manager',
                'callback'      => array($this->callbacks, 'checkBoxSanitize')
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
        $args = array(
            array(
                'id'        => 'cpt_manager',
                'title'     => 'Activate CPT Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'cpt_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'taxonomy_manager',
                'title'     => 'Activate Taxonomy Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'taxonomy_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'widget_manager',
                'title'     => 'Activate Widget Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'widget_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'media_manager',
                'title'     => 'Activate Gallery Media Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'widget_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'testimonial_manager',
                'title'     => 'Activate Testimonial Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'widget_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'templates_manager',
                'title'     => 'Activate Templates Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'widget_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'login_manager',
                'title'     => 'Activate Login/Signup Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'widget_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'membership_manager',
                'title'     => 'Activate Membership Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'widget_manager',
                    'class'     => 'ui-toggle'
                )
            ),
            array(
                'id'        => 'chat_manager',
                'title'     => 'Activate Chat Manager',
                'callback'  => array($this->callbacks_manager, 'checkBoxField'),
                'page'      => 'wpcm_plugin',
                'section'   => 'wpcm_admin_index',
                'args'      => array(
                    'label_for' => 'widget_manager',
                    'class'     => 'ui-toggle'
                )
            )
        );

        $this->settings->setFields($args);
    }
}