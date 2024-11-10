<?php

namespace App\Controllers\Admin;

use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Navbar;
use App\Views\Admin\Layouts\Settings_panel;
use App\Views\Admin\Layouts\Sidebar;
use App\Views\Admin\Pages\Product\Product;

class ProductController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Navbar::render();
        Sidebar::render();
        Settings_panel::render();
        Product::render();
        Footer::render();
    }
}
