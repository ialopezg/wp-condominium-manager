<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Api\Callbacks;

use WPCMPlugin\Base\BaseController;

class AdminCallbacks extends BaseController {
    public function dashboard() {
        return require_once("$this->plugin_path/templates/admin.php");
    }

    public function optionsGroup($input) {
        return $input;
    }

    public function wpcmAdminSection() {
        echo 'Check this beautiful section!';
    }

    public function wpcmTextExample() {
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write something here!"/>';
    }
}