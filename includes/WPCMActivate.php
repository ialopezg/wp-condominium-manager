<?php

/**
 * @package wpcm
 */

class WPCMActivate {
    public static function activate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
}