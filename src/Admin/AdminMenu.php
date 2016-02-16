<?php

namespace NFWP\Admin;

use Exception;
use NFWP\Support\AdminMenuOption;
use Philo\Blade\Blade;

class AdminMenu
{
    private $blade;
    public function __construct()
    {
        add_action('admin_menu', [$this, 'pluginMenu']);
        $views       = isset($this->view) ? $this->view : __DIR__ . '/Resources/Views';
        $cache       = isset($this->cache) ? $this->cache : __DIR__ . '/Resources/Cache';
        $this->blade = new Blade($views, $cache);
    }
    public function pluginMenu()
    {
        foreach ($this->admin_menus as $value) {
            $admin_menu = new AdminMenuOption($value);
            add_menu_page($admin_menu->page_title, $admin_menu->menu_title, $admin_menu->capability, $admin_menu->menu_slug, [$this, $admin_menu->function], $admin_menu->icon_url, $admin_menu->position);
        }
    }
    public function render($view, $data = [])
    {
        if (is_array($data)) {
            echo $this->blade->view()->make($view, $data)->render();
        } else {
            throw new Exception("data pass into view must be an array", 0);
        }
    }
}
