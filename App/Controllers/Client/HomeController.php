<?php

namespace App\Controllers\Client;

use App\Models\Client\Product;
use App\Models\Client\Recipe;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;

class HomeController
{
    // hiển thị danh sách
    public static function index()
    {
        $product = new Product();
        $featuredProducts = $product->getAllFeaturedProducts(); // Lấy danh sách sản phẩm nổi bật
        $recipeModel = new Recipe();
        $latestRecipes = $recipeModel->getLatestRecipesWithCategory(6); // Lấy 6 công thức mới nhất

        $data = [
            'featuredProducts' => $featuredProducts,
            'latestRecipes' => $latestRecipes
        ];
        Header::render();
        Home::render($data);
        Footer::render();
    }
}
