<?php

namespace WPCMPlugin\Base;

class BaseController {
    protected $plugin;
    protected $plugin_path;
    protected $plugin_url;

    public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(dirname(__FILE__)));
        $this->plugin_url = plugin_dir_url(dirname(dirname(__FILE__)));
        $this->plugin = plugin_basename(dirname(dirname(dirname(__FILE__)))) . '/wpcm.php';
    }
}