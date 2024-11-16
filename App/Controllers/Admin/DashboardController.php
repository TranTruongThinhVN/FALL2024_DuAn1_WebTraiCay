<?php

namespace App\Controllers\Admin;

use App\Views\Admin\Index;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Navbar;
use App\Views\Admin\Layouts\Settings_panel;
use App\Views\Admin\Layouts\Sidebar;

class DashboardController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render(); 
        Index::render();
        Footer::render();
    }
}
