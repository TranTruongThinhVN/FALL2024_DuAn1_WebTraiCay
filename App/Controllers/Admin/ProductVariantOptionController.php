<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\ProductVariant;
use App\Models\Admin\ProductVariantOption;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Pages\ProductVariantOption\EditOption;
use App\Views\Admin\Pages\ProductVariantOption\ListVariantOption;

class ProductVariantOptionController
{
    public function index($variantId)
    {
        if (!$variantId) {
            echo "ID biến thể bị thiếu.";
            return;
        }

        // Lấy danh sách tùy chọn của biến thể
        $optionsModel = new ProductVariantOption();
        $options = $optionsModel->getOptionsByVariantId($variantId);

        // Lấy thông tin biến thể
        $variantModel = new ProductVariant();
        $variant = $variantModel->getOne($variantId);

        if (!$variant) {
            echo "Không tìm thấy biến thể.";
            return;
        }

        $data = [
            'variant' => $variant,
            'options' => $options
        ];

        // Render giao diện
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        ListVariantOption::render($data); // Kết hợp danh sách và form thêm
        Footer::render();
    }

    // Controller xử lý API
    public function getVariantOptions()
    {
        $variantId = $_GET['variant_id'] ?? null;

        if (!$variantId) {
            echo json_encode(['success' => false, 'message' => 'ID biến thể không hợp lệ']);
            return;
        }

        $optionsModel = new ProductVariantOption();
        $options = $optionsModel->getOptionsByVariantId($variantId);

        if (!empty($options)) {
            echo json_encode(['success' => true, 'options' => $options]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không có giá trị biến thể nào']);
        }
    }

    // public function create($variantId)
    // {
    //     error_log("Variant ID received: " . $variantId);

    //     $variantModel = new ProductVariant();
    //     $variant = $variantModel->getOneProductVariant($variantId);

    //     error_log("Variant fetched: " . print_r($variant, true));

    //     if (!$variant) {
    //         echo "Không tìm thấy biến thể.";
    //         return;
    //     }

    //     Header::render();
    //     CreateOption::render(['variant' => $variant]);
    //     Footer::render();
    // }

    public function store($id)
    {
        $name = $_POST['name'] ?? '';
        if (empty($name)) {
            // NotificationHelper::error('create_option', 'Tên tùy chọn không được để trống.');
            header("Location: /admin/variants-options/add-option/$id");
            exit;
        }

        $data = [
            'product_variant_id' => $id,
            'name' => trim($name),
        ];

        $model = new ProductVariantOption();
        $result = $model->createOption($data);

        if ($result) {
            NotificationHelper::success('create_option', 'Thêm tùy chọn thành công.');
            header("Location: /admin/variant-options/$id");
        } else {
            NotificationHelper::error('create_option', 'Thêm tùy chọn thất bại.');
            header("Location: /admin/variants-options/add-option/$id");
        }
        exit;
    }


    public function edit($id)
    {
        $optionsModel = new ProductVariantOption();
        $option = $optionsModel->getOne($id);

        if (!$option) {
            echo "Không tìm thấy tùy chọn.";
            return;
        }

        Header::render();
        EditOption::render(['option' => $option]);
        Footer::render();
    }

    public function update($id)
    {
        $name = $_POST['name'] ?? null;

        if (!$name) {
            echo "Dữ liệu không hợp lệ!";
            return;
        }
        // Lấy thông tin tùy chọn để tìm product_variant_id
        $optionsModel = new ProductVariantOption();
        $option = $optionsModel->getOneProductVariantOption($id);
        $data = ['name' => $name];

        $optionsModel = new ProductVariantOption();
        if ($optionsModel->update($id, $data)) {
            NotificationHelper::success('update_option', 'Cập nhật tùy chọn thành công.');
            header("Location: /admin/variant-options/" . $option['product_variant_id']);
            exit;
        } else {
            NotificationHelper::error('create_option', 'Cập nhật tùy chọn thất bại.');
        }
    }

    public function delete($id)
    {
        // Lấy thông tin tùy chọn để tìm product_variant_id
        $optionsModel = new ProductVariantOption();
        $option = $optionsModel->getOneProductVariantOption($id);

        if (!$option) {
            // Nếu không tìm thấy tùy chọn, thông báo lỗi và redirect về danh sách biến thể
            $_SESSION['errors']['delete'] = 'Không tìm thấy tùy chọn cần xóa.';
            header("Location: /admin/product-variants");
            exit;
        }

        $productVariantId = $option['product_variant_id'];

        // Thực hiện xóa
        if ($optionsModel->deleteOption($id)) {
            // Thông báo thành công và redirect về danh sách tùy chọn của biến thể
            NotificationHelper::success('delete_option', 'Xóa tùy chọn thành công.');
            header("Location: /admin/variant-options/$productVariantId");
            exit;
        } else {
            // Thông báo lỗi nếu xóa thất bại
            $_SESSION['errors']['delete'] = 'Xóa tùy chọn thất bại.';
            header("Location: /admin/variant-options/$productVariantId");
            exit;
        }
    }
}
