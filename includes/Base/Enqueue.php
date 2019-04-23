<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

use WPCMPlugin\Base\BaseController;

class Enqueue extends BaseController {
    public function register() {
        // Admin scripts and stylesheets
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    public function enqueue() {
        // Enqueue all our scripts
        wp_enqueue_style('mypluginstyle', $this->plugin_url . 'assets/styles.css');
        wp_enqueue_script('mypluginscript', $this->plugin_url . 'assets/scripts.js');
    }
}