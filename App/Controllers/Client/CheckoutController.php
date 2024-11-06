<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Checkout\Checkout;
use App\Views\Client\Pages\Contact\Contact;

class CheckoutController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Checkout::render();
        Footer::render();
    }
}