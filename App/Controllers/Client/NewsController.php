<?php

namespace App\Controllers\Client;

use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\News\Detail;
use App\Views\Client\Pages\News\Index;

class NewsController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Index::render();
        Footer::render();
    }
    public static function detail()
    {
        Header::render();
        Detail::render();
        Footer::render();
    }
}
