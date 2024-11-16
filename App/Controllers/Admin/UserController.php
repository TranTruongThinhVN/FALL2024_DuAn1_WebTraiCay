<?php

namespace App\Controllers\Admin;

use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Navbar;
use App\Views\Admin\Layouts\Settings_panel;
use App\Views\Admin\Layouts\Sidebar;
use App\Views\Admin\Pages\User\Details;
use App\Views\Admin\Pages\User\ListUser; 

class UserController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render(); 
        ListUser::render();
        Footer::render();
    }
    public static function details()
    {
        Header::render(); 
        Details::render();
        Footer::render();
    }
}
