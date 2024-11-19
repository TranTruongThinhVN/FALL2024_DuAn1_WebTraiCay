<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Category;
use App\Validations\CategoryValidation;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Category\Create;
use App\Views\Admin\Pages\Category\Edit;
use App\Views\Admin\Pages\Category\Index;

class CategoryController
{
    // hiển thị danh sách
    public static function index()
    {


        $category = new Category();
        $data = $category->getAllCategory();
        Header::render();

        Notification::render();
        NotificationHelper::unset();


        index::render($data);
        Footer::render();
    }

    //hiển thi ra form thêm
    public static function create()
    {

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }
    public static function store()
    {
        $is_valid = CategoryValidation::create();

        if (!$is_valid) {
            NotificationHelper::error('store', 'thêm loại sản phẩm thất bại');
            header('location: /admin/add-category');
            exit;
        }


        // kiểm tra tên loại có tồn tại chưa
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        $category = new Category();

        $is_exits = $category->getOneCategoryByName($name);

        if ($is_exits) {
            NotificationHelper::error('store', 'Tên loại sản phẩm Đã tồn tại');
            header('location: /admin/add-category');
            exit;
        }


        //Thực hiện thêm 
        $data = [
            'name' => $name,
            'description' => $description,

            'status' => $status,

        ];



        $result = $category->createCategory($data);

        if ($result) {
            NotificationHelper::success($message = "Thành công!", $details = "Thêm loại sản phẩm thành công.");
            header('location: /admin/category');
        } else {
            NotificationHelper::error('store', 'thêm loại sản phẩm thất bại');
            header('location: /admin/category');
            exit;
        }
    }



    public static function delete(int $id)
    {
        $category = new Category();
        if ($category) {
        }
        $result = $category->deleteCategory($id);
        if ($result) {
            NotificationHelper::success($message = "Thành công!", $details = "Thêm loại sản phẩm thành công.");
            header('location: /admin/category');
            exit;
        } else {
            echo "<script>
            alert('Xóa loại sản phẩm thất bại!');
            window.location.href = '/admin/category';
        </script>";
            exit;
        }
    }


    public static function edit(int $id)
    {

        $category = new Category();
        $data = $category->getOneCategory($id);

        if (!$data) {
            echo "<script>
            alert('Không thể xem loại sản phẩm này!');
            window.location.href = '/admin/category';
        </script>";
            exit;
        }
        if ($data) {
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Edit::render(data: $data);
            Footer::render();
        } else {
            header('location: /admin/category');
        }
    }

    public static function update(int $id)
    {


        // kiểm tra tên loại có tồn tại chưa
        $name = $_POST['name'];
        $description = $_POST['description'];

        $status = $_POST['status'];

        $category = new Category();
        $is_exits = $category->getOneCategoryByName($name);

        if ($is_exits) {
            if ($is_exits['id']) {
                NotificationHelper::error('update', 'Tên loại sản phẩm Đã tồn tại');
                header("location: /admin/category/$id");
                exit;
            }
        }


        //Thực hiện Cập nhật 
        $data = [
            'name' => $name,
            'description' => $description,

            'status' => $status,
        ];



        $result = $category->updateCategory($id, $data);

        if ($result) {

            NotificationHelper::success('update', 'Cập nhật thành công!');
            header("location: /admin/category");
        } else {
            NotificationHelper::error('update', 'Cập nhật thất bại!');
            header("location: /admin/category/$id");
            exit;
        }
    }
}
