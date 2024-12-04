<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Recipe_category;
use App\Validations\Recipe_categoryValidation;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Recipe_category\Create;
use App\Views\Admin\Pages\Recipe_category\Edit;
use App\Views\Admin\Pages\Recipe_category\Index;


class Recipe_categoriesController
{
    // Hiển thị danh sách danh mục công thức
    public static function index()
    {
        $recipeCategoryModel = new Recipe_category();
        $search = $_GET['search'] ?? null; // Lấy từ khóa tìm kiếm từ URL

        $data = $search
            ? $recipeCategoryModel->searchRecipe_category($search)
            : $recipeCategoryModel->getAllRecipe_category();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }

    // Hiển thị form thêm danh mục công thức
    public static function create()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }

    // // Xử lý thêm danh mục công thức
    public static function store()
    {
        $is_valid = Recipe_categoryValidation::create();

        if (!$is_valid) {
            header('location: /admin/add-recipe_category');
            exit;
        }

        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'status' => $_POST['status'],

        ];

        $recipeCategoryModel = new Recipe_category();
        $result = $recipeCategoryModel->createRecipe_category($data);

        if ($result) {
            NotificationHelper::success('Thành công!', 'Thêm danh mục công thức thành công.');
            header('location: /admin/recipe_category');
        } else {
            NotificationHelper::error('store', 'Thêm danh mục công thức thất bại.');
            header('location: /admin/add-recipe_category');
            exit;
        }
    }

    // // Xóa danh mục công thức
    public static function delete(int $id)
    {
        $recipeCategoryModel = new Recipe_category();
        $result = $recipeCategoryModel->deleteRecipe_category($id);
        if ($result) {
            NotificationHelper::success('Thành công!', 'Xóa danh mục công thức thành công.');
            header('location: /admin/recipe_category');
        } else {
            NotificationHelper::error('delete', 'Xóa danh mục công thức thất bại.');
            header('location: /admin/recipe_category');
            exit;
        }
    }

    // // Hiển thị form chỉnh sửa danh mục công thức
    public static function edit(int $id)
    {
        $recipeCategoryModel = new Recipe_category();
        $data = $recipeCategoryModel->getOneRecipe_category($id);

        if (!$data) {
            echo "<script>alert('Không tìm thấy danh mục công thức!'); window.location.href = '/admin/recipe-categories';</script>";
            exit;
        }

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render($data);
        Footer::render();
    }

    // // Xử lý cập nhật danh mục công thức
    public static function update(int $id)
    {
        $is_valid = Recipe_categoryValidation::create($id); // Truyền ID danh mục đang sửa

        if (!$is_valid) {
            header("location: /admin/recipe_category/$id");
            exit;
        }

        $name = $_POST['name'];
        $data = [
            'name' => $name,
            'description' => $_POST['description'],
            'status' => $_POST['status'],
        ];

        $recipeCategoryModel = new Recipe_category();

        // Thực hiện cập nhật
        $result = $recipeCategoryModel->updateRecipe_category($id, $data);

        if ($result) {
            NotificationHelper::success('Thành công!', 'Cập nhật danh mục công thức thành công.');
            header("location: /admin/recipe_category");
        } else {
            NotificationHelper::error('update', 'Cập nhật danh mục công thức thất bại.');
            header("location: /admin/recipe_category/$id/edit");
            exit;
        }
    }
}
