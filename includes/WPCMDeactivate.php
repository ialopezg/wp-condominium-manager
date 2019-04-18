<?php

/**
 * @package wpcm
 */

class WPCMDeactivate {
    public static function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
}