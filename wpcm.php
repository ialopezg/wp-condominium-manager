<?php
/**
 * @package wpcm
 *
 * Plugin Name: WP Condominium Manager
 * Description: WordPress Plugin for control of Condominiums, Real States properties (lands, houses, apartments, deposits, parking places and others.
 * Plugin URI: https://github.com/ialopezg/wpcm
 * Version: 0.0.1
 * Author: Isidro A. Lopez G.
 * Author URI: https://ialopezg.com
 * License: MIT
 * Text Domain: wpcm
 */

/**
 * Copyright (c) 2018 Isidro A. Lopez G.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

defined('ABSPATH') or die("Hey, you can't access this file, you silly human!");

class WPCMPlugin {
    public function __construct() {
        add_action('init', array($this, 'custom_post_type'));
    }

    public function register() {
        // Admin scripts and stylesheets
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));

        // Admin menu
        add_action('admin_menu', array($this, 'add_admin_pages'));
    }

    public function add_admin_pages() {
        add_menu_page('WPCM Plugin', 'WPCMP', 'manage_options', 'wpcm_plugin', array($this, 'admin_index'), 'dashicons-building', 110);
    }

    public function admin_index() {
        require_once(plugin_dir_path(__FILE__) . 'templates/admin.php');
    }

    protected function create_post_type() {
        add_action('init', array($this, 'custom_post_type'));
    }

    public function custom_post_type() {
        register_post_type('books', array('public' => true, 'label' => 'Books'));
    }

    public function enqueue() {
        // Enqueue all our scripts
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/styles.css', __FILE__));
        wp_enqueue_script('mypluginstyle', plugins_url('/assets/scripts.js', __FILE__));
    }

    public function activate() {
        require_once(plugin_dir_path(__FILE__) . 'includes/WPCMActivate.php');
        WPCMActivate::activate();
    }
}

if (class_exists('WPCMPlugin')) {
    $bootstrap = new WPCMPlugin();
    $bootstrap->register();
}

// Activation
register_activation_hook(__FILE__, array($bootstrap, 'activate'));

// Deactivation
require_once(plugin_dir_path(__FILE__) . '/includes/WPCMDeactivate.php');
register_deactivation_hook(__FILE__, array('WPCMDeactivate', 'deactivate'));