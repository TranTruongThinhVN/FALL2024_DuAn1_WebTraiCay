<?php

namespace App\Controllers\Admin;

use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Navbar;
use App\Views\Admin\Layouts\Settings_panel;
use App\Views\Admin\Layouts\Sidebar;
use App\Views\Admin\Pages\Checkout\Checkout;

class CheckoutController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render(); 
        Checkout::render();
        Footer::render();
        
    }
    // public static function create()
    // {
    //     Header::render();
    //     Navbar::render();   
    //     Sidebar::render();
    //     Create::render();
    //     Settings_panel::render(); 
    //     Footer::render();
    // }
}