<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Settings;

class ApartmentsController extends BaseController {
    public $callbacks;
    protected $customPostTypes = array();
    protected $subPages = array();

    public function register() {
        if (!$this->activated('apartments_manager')) {
            return;
        }

        $this->settings = new Settings();
        $this->callbacks = new AdminCallbacks();

        $this->setSubPages();

        $this->settings->addSubPages($this->subPages)->register();

        $this->setCustomPostTypes();

        if (!empty($this->customPostTypes)) {
            add_action('init', array($this, 'registerCustomPostTypes'));
        }
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

    private function setCustomPostTypes() {
        $this->customPostTypes = array(
            array(
                'post_type' => 'wpcm_apartments',
                'name' => 'Apartments',
                'singular_name' => 'Apartment',
                'public' => true,
                'has_archive' => true
            ),
            array(
                'post_type' => 'wpcm_rooms',
                'name' => 'Rooms',
                'singular_name' => 'Room',
                'public' => true,
                'has_archive' => true
            )
        );
    }

    public function registerCustomPostTypes() {
        foreach ($this->customPostTypes as $customPostType) {
            register_post_type($customPostType['post_type'], array(
                'labels' => array(
                    'name'          => $customPostType['name'],
                    'singular_name' => $customPostType['singular_name']
                ),
                'public'            => $customPostType['public'],
                'has_archive'       => $customPostType['has_archive']
            ));
        }
    }
}