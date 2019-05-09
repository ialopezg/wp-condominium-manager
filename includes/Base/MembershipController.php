<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Settings;

class MembershipController extends BaseController {
    public $callbacks;
    protected $subPages = array();


    public function register() {
        if (!$this->activated('membership_manager')) {
            return;
        }

        $this->settings = new Settings();
        $this->callbacks = new AdminCallbacks();

        $this->setSubPages();

        $this->settings->addSubPages($this->subPages)->register();
    }

    public function setSubPages() {
        $this->subPages = array(
            array(
                'parent_slug'   => 'wpcm_plugin',
                'page_title'    => 'Membership',
                'menu_title'    => 'Membership Manager',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_membership',
                'callback'      => array($this->callbacks, 'adminMembership')
            )
        );
    }
}