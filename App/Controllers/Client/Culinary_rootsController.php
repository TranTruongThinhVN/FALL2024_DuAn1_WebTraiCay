<?php

namespace App\Controllers\Client;

use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Culinary_roots\Culinary_roots;
use App\Views\Client\Pages\Culinary_roots\Detail_culinary_roots;

class Culinary_rootsController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Culinary_roots::render();
        Footer::render();
    }
    public static function detail()
    {
        Header::render();
        Detail_culinary_roots::render();
        Footer::render();
    }
}
