<?php

namespace App\Controllers\Client;

use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Policy\Policy;

class PolicyController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Policy::render();
        Footer::render();
    }
}
