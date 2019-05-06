<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

class Activate {
    public static function activate() {
        // Flush rewrite rules
        flush_rewrite_rules();

        if (get_option('wpcm_plugin')) {
            return;
        }

        $defaults = array();

        update_option('wpcm_plugin', $defaults);
    }
}