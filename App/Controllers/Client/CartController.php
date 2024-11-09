<?php

namespace App\Controllers\Client;

use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Cart\Index;


class CartController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Index::render();
        Footer::render();
    }
}
