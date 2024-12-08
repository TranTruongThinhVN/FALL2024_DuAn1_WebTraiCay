<?php

namespace App\Controllers\Admin;

use App\Models\Admin\Comment;
use App\Models\Admin\Product;
use App\Models\Admin\User;
use App\Views\Admin\Index;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;

class DashboardController
{
    public static function index()
    {
        $userModel = new User();
        $productModel = new Product();
        $commentModel = new Comment();
        
        $totalUsers = $userModel->getTotalUsers();
        $totalAdmins = $userModel->countUsersByRole('admin');
        $totalRegularUsers = $userModel->countUsersByRole('user');

        $totalProducts = $productModel->getTotalProducts();
        $totalRevenue = $productModel->getTotalRevenue();
        $averagePrice = $productModel->getAveragePrice();
        $productsByCategory = $productModel->getProductsByCategory();
        $productSalesStats = $productModel->getProductSalesStatistics();

        $totalComments = $commentModel->getTotalComments();
        $mostCommentedProducts = $commentModel->getMostCommentedProducts();
        $data = [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalRegularUsers' => $totalRegularUsers,
            'totalProducts' => $totalProducts,
            'totalRevenue' => $totalRevenue,
            'averagePrice' => $averagePrice,
            'productsByCategory' => $productsByCategory,
            'productSalesStats' => $productSalesStats,
            'totalComments' => $totalComments,
            'mostCommentedProducts' => $mostCommentedProducts,
        ];

        Header::render();
        Index::render($data);
        Footer::render();
    }
}

