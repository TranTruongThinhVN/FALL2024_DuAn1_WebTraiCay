<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Recipe;
use App\Models\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Recipe_category;
use App\Validations\ProductValidation;
use App\Validations\RecipeValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Detail_product;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Edit_product;
use App\Views\Admin\Pages\Product\Index;
use App\Views\Admin\Pages\Product\Product as ProductAdmin;
use App\Views\Admin\Pages\Recipe\Create as RecipeCreate;
use App\Views\Admin\Pages\Recipe\Edit as RecipeEdit;
use App\Views\Admin\Pages\Recipe\Index as RecipeIndex;
use App\Views\Client\Pages\News\Detail;

class RecipeController
{


    // hiển thị danh sách
    public static function index()
{
    $keyword = $_GET['search'] ?? ''; // Từ khóa tìm kiếm
    $category_id = $_GET['category'] ?? ''; // Lọc theo danh mục
    $status = Recipe::STATUS_ENABLE; // Trạng thái mặc định là hiển thị
    $recipeModel = new Recipe();

    // Lấy thông tin phân trang từ URL (nếu không có, mặc định là trang 1)
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $recipesPerPage = 9; // Số công thức mỗi trang
    $offset = ($currentPage - 1) * $recipesPerPage;

    // Lấy tổng số công thức theo bộ lọc
    $totalRecipes = $recipeModel->countFilteredRecipes($keyword, $category_id, $status);

    // Lấy công thức cho trang hiện tại
    $recipes = $recipeModel->getFilteredRecipes($keyword, $category_id, $status, $recipesPerPage, $offset);

    // Lấy danh sách danh mục để hiển thị trong bộ lọc
    $categories = (new Recipe_category())->getAllRecipe_category();

    // Gửi dữ liệu tới View
    Header::render();
    Notification::render();
    NotificationHelper::unset();
    RecipeIndex::render([
        'recipes' => $recipes,
        'search' => $keyword,
        'categories' => $categories,
        'selected_category' => $category_id,
        'pagination' => [
            'total' => $totalRecipes,
            'perPage' => $recipesPerPage,
            'currentPage' => $currentPage,
        ],
    ]); // Truyền dữ liệu vào View
    Footer::render();
}



    // hiển thị giao diện form thêm
    public static function create()
    {
        $recipes = new Recipe();
        $categories = (new Recipe_category())->getAllRecipe_category(); // Lấy tất cả danh mục
        $data = [
            'recipes' => $recipes->getAllRecipes(),
            'categories' => $categories, // Truyền danh mục vào View
        ];
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        RecipeCreate::render($data);
        Footer::render();
    }



    // // xử lý chức năng thêm
    public static function store()
    {

        // Kiểm tra và lấy dữ liệu từ POST
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $ingredients = $_POST['ingredients'] ?? '';
        $instructions = $_POST['instructions'] ?? '';
        $image_url = '';

        $recipeModel = new Recipe();

        // Kiểm tra tiêu đề đã tồn tại
        if ($recipeModel->isTitleExists($title)) {
            $_SESSION['errors']['title'] = 'Tiêu đề đã tồn tại. Vui lòng chọn tiêu đề khác.';
        }

        // Xử lý upload ảnh nếu có
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image_url']['tmp_name'];
            $imageName = uniqid() . '_' . basename($_FILES['image_url']['name']);
            $uploadDir = __DIR__ . '/../../../public/uploads/recipes/';
            $uploadFilePath = $uploadDir . $imageName;

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
                $image_url = '/public/uploads/recipes/' . $imageName;
            } else {
                $_SESSION['errors']['image_url'] = 'Lỗi khi tải lên hình ảnh.';
            }
        } elseif (empty($image_url)) {
            $_SESSION['errors']['image_url'] = 'Vui lòng tải lên hình ảnh.';
        }

        // Nếu có lỗi, quay lại trang thêm công thức
        if (!empty($_SESSION['errors'])) {
            header('Location: /admin/add_recipe');
            exit;
        }

        // Lưu công thức vào cơ sở dữ liệu
        $success = $recipeModel->create([
            'title' => $title,
            'description' => $description,
            'category_id' => $category_id,
            'ingredients' => $ingredients,
            'instructions' => $instructions,
            'image_url' => $image_url,
            'status' => 1, // Mặc định công thức hiển thị
        ]);


        if ($success) {
            NotificationHelper::success('Thành công!', 'Thêm công thức thành công.');
            header('Location: /admin/recipe');
            exit;
        } else {
            $_SESSION['errors']['database'] = 'Lỗi khi lưu vào cơ sở dữ liệu.';
            header('Location: /admin/add_recipe');
            exit;
        }
    }



    // // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        $recipeModel = new Recipe();
        $recipe = $recipeModel->getOneRecipe($id);

        if (!$recipe) {
            NotificationHelper::error('edit', 'Không thể xem công thức này');
            header('location: /admin/recipes');
            exit;
        }

        $categoryModel = new Recipe_category();
        $categories = $categoryModel->getAllRecipe_category();

        // Truyền đầy đủ dữ liệu vào view
        $data = [
            'recipe' => $recipe,          // Thông tin công thức
            'categories' => $categories, // Danh mục công thức
        ];

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        RecipeEdit::render($data); // Đảm bảo render đúng view
        Footer::render();
    }




    // // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        session_start();

        // Kiểm tra dữ liệu đầu vào
        $_POST['id'] = $id;
        $is_valid = RecipeValidation::edit($id); // Kiểm tra validate dữ liệu đầu vào

        if (!$is_valid) {
            error_log("Validation failed: " . print_r($_SESSION['errors'], true));
            $_SESSION['old'] = $_POST;
            header("Location: /admin/recipes/$id/edit");
            exit;
        }

        $recipeModel = new Recipe();
        $existingRecipe = $recipeModel->getOneRecipe($id); // Kiểm tra xem công thức có tồn tại không

        if (!$existingRecipe) {
            NotificationHelper::error('update', 'Không tìm thấy công thức để cập nhật');
            header('location: /admin/recipe');
            exit;
        }

        // Chuẩn bị dữ liệu cập nhật
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'],
            'ingredients' => $_POST['ingredients'],
            'instructions' => $_POST['instructions'],
            'image_url' => $existingRecipe['image_url'], // Giữ hình ảnh hiện tại làm mặc định
            'status' => $_POST['status'], // Mặc định công thức hiển thị

        ];

        // Xử lý upload hình ảnh nếu có
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image_url']['tmp_name'];
            $uniqueName = uniqid() . '_' . basename($_FILES['image_url']['name']);
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/recipes/';
            $uploadFilePath = $uploadDir . $uniqueName;

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
                $data['image_url'] = '/public/uploads/recipes/' . $uniqueName;

                // Xóa ảnh cũ nếu cần
                if (!empty($existingRecipe['image_url'])) {
                    $oldImagePath = $_SERVER['DOCUMENT_ROOT'] . $existingRecipe['image_url'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                $_SESSION['errors']['image_url'] = 'Lỗi khi tải lên ảnh';
                $_SESSION['old'] = $_POST;
                header("Location: /admin/recipes/$id/edit");
                exit;
            }
        }

        // Thực hiện cập nhật vào cơ sở dữ liệu
        $result = $recipeModel->updateRecipe($id, $data);

        if ($result) {
            NotificationHelper::success('update', 'Cập nhật công thức thành công');
            header('location: /admin/recipe');
            exit;
        } else {
            NotificationHelper::error('update', 'Cập nhật công thức thất bại');
            $_SESSION['old'] = $_POST;
            header("location: /admin/recipes/$id/edit");
            exit;
        }
    }





    // // thực hiện xoá
    public static function delete(int $id)
    {
        session_start();

        $recipeModel = new Recipe();
        $recipe = $recipeModel->getOneRecipe($id); // Lấy thông tin công thức

        if (!$recipe) {
            NotificationHelper::error('delete', 'Không tìm thấy công thức để xóa');
            header('location: /admin/recipe');
            exit;
        }

        // Xóa ảnh nếu tồn tại
        if (!empty($recipe['image_url'])) {
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . $recipe['image_url'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Xóa công thức trong cơ sở dữ liệu
        $result = $recipeModel->deleteRecipe($id);

        if ($result) {
            NotificationHelper::success('delete', 'Xóa công thức thành công');
            header('location: /admin/recipe');
            exit;
        } else {
            NotificationHelper::error('delete', 'Đã xảy ra lỗi khi xóa công thức');
            header('location: /admin/recipe');
            exit;
        }
    }
}
