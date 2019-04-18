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

// Abort if this file is called directly.
defined('ABSPATH') or die("Hey, what are you doing here? You silly human!");

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once(dirname(__FILE__) . '/vendor/autoload.php');
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN', plugin_basename(__FILE__));

// Activation
function activate_wpcm_plugin() {
    WPCMPlugin\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_wpcm_plugin');

// Deactivation
function deactivate_wpcm_plugin() {
    WPCMPlugin\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_wpcm_plugin');

if (class_exists('WPCMPlugin\\Init')) {
    WPCMPlugin\Init::register_services();
}

/*
use WPCMPlugin\Activate;
use WPCMPlugin\Deactivate;
use WPCMPlugin\Pages\Admin;

if (!class_exists('WPCMPlugin')) {
    class WPCMPlugin {


        protected function create_post_type() {
            add_action('init', array($this, 'custom_post_type'));
        }

        public function custom_post_type() {
            register_post_type('books', array('public' => true, 'label' => 'Books'));
        }

        public function activate() {
            Activate::activate();
        }
    }

    $bootstrap = new WPCMPlugin();
    $bootstrap->register();
}

*/