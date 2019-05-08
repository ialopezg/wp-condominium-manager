<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Settings;

class ParkingsController extends BaseController {
    public $callbacks;
    protected $subPages = array();


    public function register() {
        $option = get_option('wpcm_plugin');
        $activated = isset($option['rooms_manager']) ? $option['rooms_manager'] : false;

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
                'page_title'    => 'Parkings',
                'menu_title'    => 'Parkings Manager',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_parkings',
                'callback'      => array($this->callbacks, 'adminParkings')
            )
        );
    }

    public function activate() {
        register_post_type('wpcm_parkings', array(
            'labels' => array(
                'name'          => 'Parkings',
                'singular_name' => 'Parking'
            ),
            'public'            => true,
            'has_archive'       => true
        ));
    }
}