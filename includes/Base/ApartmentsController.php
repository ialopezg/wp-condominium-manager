<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Settings;

class ApartmentsController extends BaseController {
    public $callbacks;
    protected $subPages = array();


    public function register() {
        $option = get_option('wpcm_plugin');
        $activated = isset($option['apartments_manager']) ? $option['apartments_manager'] : false;

        if (!$activated) {
            return;
        }

        $this->settings = new Settings();
        $this->callbacks = new AdminCallbacks();

        $this->setSubPages();

        $this->settings->addSubPages($this->subPages)->register();

        add_action('init', array($this, 'activate'));
    }

    public function setSubPages() {
        $this->subPages = array(
            array(
                'parent_slug'   => 'wpcm_plugin',
                'page_title'    => 'Apartments Manager',
                'menu_title'    => 'Apartments Manager',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_apartments',
                'callback'      => array($this->callbacks, 'adminApartments')
            )
        );
    }

    public function activate() {
        register_post_type('wpcm_apartments', array(
            'labels' => array(
                'name'          => 'Apartments',
                'singular_name' => 'Apartment'
            ),
            'public'            => true,
            'has_archive'       => true
        ));
    }
}