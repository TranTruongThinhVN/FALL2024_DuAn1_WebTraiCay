<?php

namespace App\Controllers\Client;

use App\Models\Admin\Recipe_category;
use App\Models\Client\Recipe;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Culinary_roots\Culinary_roots;
use App\Views\Client\Pages\Culinary_roots\Detail_culinary_roots;

class Culinary_rootsController
{
    // hiển thị danh sách
    public static function index()
    {

        $recipeModel = new Recipe();
        $recipeModel = $recipeModel->getAllRecipes();

        $recipe_category = new Recipe_category();
        $recipe_category = $recipe_category->getAllRecipe_categoryByStatus();

        $data = [
            'recipes' => $recipeModel,
            'recipe_category' => $recipe_category
        ];
        Header::render();
        Culinary_roots::render($data);
        Footer::render();
        var_dump($data);
    }
    public static function detail($id)
    {
        $recipeModel = new Recipe();
        $recipe = $recipeModel->getOneRecipeByStatus($id); // Lấy thông tin công thức theo ID
        if (!$recipe) {
            // Xử lý nếu không tìm thấy công thức
            header("Location: /404");
            exit;
        }

        $data = [
            'recipes' => $recipe
        ];

        Header::render();
        Detail_culinary_roots::render($data);
        Footer::render();
    }
}
