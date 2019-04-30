<?php

namespace WPCMPlugin\Base;

class BaseController {
    protected $managers = array();
    protected $plugin;
    protected $plugin_path;
    protected $plugin_url;

    public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(dirname(__FILE__)));
        $this->plugin_url = plugin_dir_url(dirname(dirname(__FILE__)));
        $this->plugin = plugin_basename(dirname(dirname(dirname(__FILE__)))) . '/wpcm.php';

        $this->managers = [
            'apartments_manager' => 'Apartments Manager',
            'rooms_manager' => "Rooms Manager",
            'parking_manager' => "Parking Manager",
            'deposits_manager' => 'Deposits Manager',
            'testimonial_manager' => 'Testimonial Manager',
            'templates_manager' => 'Templates Manager',
            'security_manager' => 'Security Manager',
            'membership_manager' => 'Membership Manager',
            'chat_manager'=> 'Chat Manager'
        ];
    }
}