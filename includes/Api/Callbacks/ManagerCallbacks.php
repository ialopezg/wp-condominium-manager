<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Api\Callbacks;

use WPCMPlugin\Base\BaseController;

class ManagerCallbacks extends BaseController {
    public function checkBoxSanitize($input) {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function adminSectionManager() {
        echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
    }

    public function checkBoxField($args) {
        $name = $args['label_for'];
        $classes = $args['class'];
        $checkbox = get_option($args['label_for']);

        echo '<div class="' . $classes .  '"><input type="checkbox" id="' . $name . '" name="' . $name . '" value="1" class=""' . (isset($checkbox) ? ' checked' : '') . '/><label for="' . $name . '"><div></div></label></div>';
    }
}