<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Category;
use App\Models\Admin\Discount;
use App\Validations\DiscountValidation;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Discount\Create;
use App\Views\Admin\Pages\Discount\Discount as DiscountDiscount;
use App\Views\Admin\Pages\Discount\Edit_discount;

class DiscountController
{
    // hiển thị danh sách
    public static function index()
    {
        $discount = new Discount();

        // Lấy dữ liệu từ GET
        $filters = [
            'discount_type' => $_GET['discount_type'] ?? '',
            'search' => $_GET['search'] ?? '',
        ];

        // Lấy danh sách mã giảm giá sau khi áp dụng bộ lọc
        $discounts = $discount->getFilteredDiscounts($filters);

        // Đảm bảo `$discounts` luôn là mảng
        if (!$discounts) {
            $discounts = [];
        }

        Header::render();
        Notification::render();
        NotificationHelper::unset();

        // Truyền dữ liệu vào giao diện
        DiscountDiscount::render(['discounts' => $discounts, 'filters' => $filters]);

        Footer::render();
    }

    public static function create()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }


    // xử lý chức năng thêm
    public static function store()
    {
        $is_valid = DiscountValidation::create();

        if (!$is_valid) {
            // NotificationHelper::error('store', 'thêm loại sản phẩm thất bại');
            header('location: /admin/add-discount');
            exit;
        }
        // Lấy dữ liệu từ form
        $data = [
            'code' => $_POST['code'],
            'description' => $_POST['description'],
            'discount_type' => $_POST['discount_type'],
            'discount_value' => $_POST['discount_value'],
            'min_order_value' => $_POST['min_order_value'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status'],
        ];

        // Gọi model để lưu dữ liệu
        $discount = new Discount();
        $result = $discount->createDiscounts($data);

        if ($result) {
            NotificationHelper::success('create', 'Thêm mã giảm giá thành công');
            header('location: /admin/discount');
            exit;
        } else {
            NotificationHelper::error('create', 'Thêm mã giảm giá thất bại');
            header('location: /admin/discounts/create');
            exit;
        }
    }
    public static function edit($id)
    {
        // Lấy thông tin mã giảm giá từ database
        $discountModel = new Discount();
        $discount = $discountModel->getOneDiscounts($id);

        if (!$discount) {
            NotificationHelper::error('edit', 'Không tìm thấy mã giảm giá');
            header('location: /admin/discounts');
            exit;
        }

        // Hiển thị giao diện sửa
        Header::render();
        Notification::render();
        NotificationHelper::unset();

        Edit_discount::render(['discount' => $discount]);

        Footer::render();
    }
    public static function update($id)
    {
        $is_valid = DiscountValidation::edit($id);
        if (!$is_valid) {
            // Quay lại trang sửa với lỗi
            header("location: /admin/edit-discount/$id");
            exit;
        }
        // Lấy dữ liệu từ form
        $data = [
            'code' => $_POST['code'],
            'description' => $_POST['description'],
            'discount_type' => $_POST['discount_type'],
            'discount_value' => $_POST['discount_value'],
            'min_order_value' => $_POST['min_order_value'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status'],
        ];

        // Cập nhật mã giảm giá
        $discountModel = new Discount();
        $result = $discountModel->updateDiscounts($id, $data);

        if ($result) {
            NotificationHelper::success('update', 'Cập nhật mã giảm giá thành công');
        } else {
            NotificationHelper::error('update', 'Cập nhật mã giảm giá thất bại');
        }

        header('location: /admin/discount');
        exit;
    }
    public static function delete($id)
    {
        $discountModel = new Discount();
        $result = $discountModel->deleteDiscounts($id);

        if ($result) {
            NotificationHelper::success('delete', 'Xóa mã giảm giá thành công');
        } else {
            NotificationHelper::error('delete', 'Xóa mã giảm giá thất bại');
        }

        header('location: /admin/discount');
        exit;
    }
}
