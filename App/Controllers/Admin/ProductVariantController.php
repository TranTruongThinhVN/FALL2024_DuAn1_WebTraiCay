<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Product;
use App\Models\Admin\ProductVariant;
use App\Models\Admin\ProductVariantOption;
use App\Validations\ProductVariantValidation;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Pages\ProductVariants\ListVariants;
use App\Views\Admin\Pages\ProductVariants\CreateVariant;
use App\Views\Admin\Pages\ProductVariants\EditVariant;

class ProductVariantController
{
    // public function index()
    // {
    //     $variantModel = new ProductVariant();

    //     // Lấy tất cả biến thể kèm thông tin sản phẩm
    //     $variants = $variantModel->getAllVariantsWithProducts();

    //     // Render view
    //     Header::render();
    //     ListVariants::render([
    //         'variants' => $variants, // Truyền toàn bộ dữ liệu từ JOIN
    //     ]);
    //     Footer::render();
    // }

    public function index()
    {
        $variantModel = new ProductVariant();

        // Lấy tất cả biến thể kèm tùy chọn
        $variants = $variantModel->getAllVariantsWithOptions();

        // Render view
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        ListVariants::render([
            'variants' => $variants, // Truyền toàn bộ dữ liệu từ JOIN
        ]);
        Footer::render();
    }

    public function create()
    {


        Header::render();
        CreateVariant::render(); // Truyền danh sách sản phẩm vào view
        Footer::render();
    }





    public function store()
    {

        $is_valid = ProductVariantValidation::validateName();

        if (!$is_valid) {
            // Trả về form với lỗi nếu không hợp lệ
            header('location: /admin/create-variants');
            // echo 'Tồn tại';
            exit;
        }

        $data = [
            'name' => $_POST['name'],
        ];

        $model = new ProductVariant();
        $result = $model->createVariant($data);

        if ($result) {
            header('Location: /admin/product-variants');
        } else {
            // NotificationHelper::error('Lỗi khi thêm biến thể.');
        }
    }



    public static function edit($id)
    {
        $model = new ProductVariant();
        $variant = $model->getOne($id);

        Header::render();
        EditVariant::render(['variant' => $variant]);
        Footer::render();
    }

    public static function update($id)
    {
        $is_valid = ProductVariantValidation::validateEditName($id);

        if (!$is_valid) {
            header("location: /admin/edit-variants/$id");
            exit;
        }

        $data = [
            'name' => $_POST['name'],
        ];

        $model = new ProductVariant();
        $result = $model->updateVariant($id, $data);

        if ($result) {
            NotificationHelper::success('update_variant', 'Cập nhật thuộc tính sản phẩm thành công');
            header('Location: /admin/product-variants');
        } else {
            NotificationHelper::error('update_variant', 'Cập nhật thuộc tính sản phẩm thất bại');
        }
    }

    public static function delete($id)
    {
        $model = new ProductVariant();
        $result = $model->deleteVariant($id);

        if ($result) {
            NotificationHelper::success('delete_variant', 'Xóa thuộc tính sản phẩm thành công');
            header('Location: /admin/product-variants');
        } else {
            NotificationHelper::error('delete_variant', 'Xóa thuộc tính sản phẩm thất bại');
            header('Location: /admin/product-variants');
        }
    }
}
