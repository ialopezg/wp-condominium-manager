<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Base;

class Deactivate {
    public static function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
}