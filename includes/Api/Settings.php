<?php

namespace WPCMPlugin\Api;

class Settings {
    private $adminPages = array();
    private $adminSubPages = array();

    public function register() {
        if (!empty($this->adminPages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }
    }

    public function addPages(array $pages) {
        $this->adminPages = $pages;

        return $this;
    }

    public function addSubPages(array $pages) {
        $this->adminSubPages = array_merge($this->adminSubPages, $pages);

        return $this;
    }

    public function withSubPages($title = null) {
        if (empty($this->adminPages)) {
            return $this;
        }

        $adminPage = $this->adminPages[0];

        $subPage = array(
            array(
                'parent_slug'   => $adminPage['menu_slug'],
                'page_title'    => $adminPage['page_title'],
                'menu_title'    => ($title) ? $title : $adminPage['menu_title'],
                'capability'    => $adminPage['capability'],
                'menu_slug'     => $adminPage['menu_slug'],
                'callback'      => $adminPage['callback']
            )
        );
        $this->adminSubPages = $subPage;

        return $this;
    }

    public function addAdminMenu() {
        foreach ($this->adminPages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'],
                $page['callback'], $page['icon_url'], $page['position']);
        }

        foreach ($this->adminSubPages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'],
                $page['menu_slug'], $page['callback']);
        }
    }
}