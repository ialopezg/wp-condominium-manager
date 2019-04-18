<?php

/**
 * Trigger this file on  plugin uninstall
 *
 * @package wpcm
 */

defined('WP_UNINSTALL_PLUGIN') or die("Hey, you can't access this file, you silly human!");

// Clear database stored data
$books = get_posts(array('post_type' => 'book', 'numberposts' => -1));
foreach ($books as $book) {
    wp_delete_post($book->ID, true);
}