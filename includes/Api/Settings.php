<?php

namespace WPCMPlugin\Api;

class Settings {
    private $adminPages = array();

    public function register() {
        if (!empty($this->adminPages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }
    }

    public function addPages(array $pages) {
        $this->adminPages = $pages;

        return $this;
    }

    public function addAdminMenu() {
        foreach ($this->adminPages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'],
                $page['callback'], $page['icon_url'], $page['position']);
        }
    }
}