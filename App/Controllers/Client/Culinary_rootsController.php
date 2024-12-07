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
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $recipesPerPage = 9; // Số công thức mỗi trang
        $offset = ($currentPage - 1) * $recipesPerPage;

        // Lấy tổng số công thức
        $totalRecipes = $recipeModel->countFilteredRecipes("", "", Recipe::STATUS_ENABLE);

        // Lấy công thức theo danh mục có trạng thái được bật
        $recipes = $recipeModel->getFilteredRecipes("", "", Recipe::STATUS_ENABLE, $recipesPerPage, $offset);
        $allRecipes = $recipeModel->getAllRecipesByStatus();

        $recipeCategoryModel = new Recipe_category();
        $recipeCategories = $recipeCategoryModel->getAllRecipe_categoryByStatus();

        $data = [
            'recipes' => $recipes,
            'recipe_category' => $recipeCategories,
            'pagination' => [
                'total' => $totalRecipes,
                'perPage' => $recipesPerPage,
                'currentPage' => $currentPage,
            ],
        ];

        Header::render();
        Culinary_roots::render($data);
        Footer::render();
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

    public static function category($category_id)
    {
        $recipeModel = new Recipe();
        $recipes = $recipeModel->getRecipesByCategory($category_id);

        $recipe_category = new Recipe_category();
        $recipe_category = $recipe_category->getAllRecipe_categoryByStatus();

        $data = [
            'recipes' => $recipes,
            'recipe_category' => $recipe_category
        ];

        Header::render();
        Culinary_roots::render($data);
        Footer::render();
    }
    public static function fetchRecipesByCategory($id)
    {
        $recipeModel = new Recipe();
        $recipes = $recipeModel->getRecipesByCategory($id); // Lấy công thức theo danh mục

        if (!$recipes) {
            $recipes = []; // Nếu không có công thức nào
        }

        header('Content-Type: application/json');
        echo json_encode($recipes);
        exit;
    }
}
