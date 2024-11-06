<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Store\Store;

class StoreController 
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        store::render();
        Footer::render();
    }
}
