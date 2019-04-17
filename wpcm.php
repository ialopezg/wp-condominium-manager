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

    }

    public function activate() {}

    public function deactivate() {}

    public function uninstall() {}
}

if (class_exists('WPCMPlugin')) {
    $bootstrap = new WPCMPlugin();
}

// Activation
register_activation_hook(__FILE__, array($bootstrap, 'activate'));

// Deactivation
register_deactivation_hook(__FILE__, array($bootstrap, 'deactivate'));

// Uninstall