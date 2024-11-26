<?php

namespace App\Controllers\Admin;

use App\Models\Admin\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
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
        $users = new User();
        $userData = $users->getAllUser();
        $userNew = $users->getUserNew();

        $products = new Product();
        $countProducts = $products->countProduct();

        $category = new Category();
        $countCategory = $category->countCategory();

        $comments = new Comment();
        $commentNew = $comments->getLatestComment();
        $data = [
            'users' => $userData,
            'user_new' => $userNew,
            'countProducts' => $countProducts,
            'countCategory' => $countCategory,
            'comment_new' => $commentNew,
            // 'countProducts' => $countProducts,
        ]; 
        Header::render();
        Index::render($data);
        Footer::render();
    }
}
