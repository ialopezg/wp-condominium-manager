<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

use WPCMPlugin\Api\Callbacks\AdminCallbacks;
use WPCMPlugin\Api\Settings;

class TemplatesController extends BaseController {
    public $callbacks;
    protected $subPages = array();


    public function register() {
        if (!$this->activated('templates_manager')) {
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
                'page_title'    => 'Templates',
                'menu_title'    => 'Templates Manager',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wpcm_templates',
                'callback'      => array($this->callbacks, 'adminTemplates')
            )
        );
    }
}