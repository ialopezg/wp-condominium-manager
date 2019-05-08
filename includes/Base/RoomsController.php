<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Settings;

class RoomsController extends BaseController {
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
                'page_title'    => 'Rooms',
                'menu_title'    => 'Rooms Manager',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_rooms',
                'callback'      => array($this->callbacks, 'adminRooms')
            )
        );
    }

    public function activate() {
        register_post_type('wpcm_rooms', array(
            'labels' => array(
                'name'          => 'Rooms',
                'singular_name' => 'Room'
            ),
            'public'            => true,
            'has_archive'       => true
        ));
    }
}