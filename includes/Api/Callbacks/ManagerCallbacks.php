<?php

/**
 * @package wpcm
 */

namespace WPCMPlugin\Api\Callbacks;

use WPCMPlugin\Base\BaseController;

class ManagerCallbacks extends BaseController {
    public function checkBoxSanitize($input) {
        $output = array();
        foreach ($this->managers as $key => $value) {
            $output[$key] = isset($input[$key]) ? true : false;
        }

        return $output;
    }

    public function adminSectionManager() {
        echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
    }

    public function checkBoxField($args) {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option($option_name);

        echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checkbox[$name] ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
    }
}