<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Order\Index;
use App\Views\Admin\Pages\Order\Edit;
use App\Models\Admin\Order;

class OrderController
{
    // hiển thị danh sách
    public static function index()
    {
        $orderModel = new Order();

        // Lấy số trang hiện tại
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $offset = ($currentPage - 1) * $perPage;

        // Kiểm tra tổng số bản ghi
        $totalRecords = $orderModel->countOrders();
        $totalPages = ceil($totalRecords / $perPage);

        // Lấy dữ liệu từ Model
        $data = $orderModel->getOrdersWithPagination($currentPage, $perPage);

        // Render giao diện
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data, $currentPage, $totalPages);
        Footer::render();
    }

    public static function edit($id)
    {
        $orderModel = new Order();

        // Lấy dữ liệu của đơn hàng cần chỉnh sửa
        $orderData = $orderModel->getOneOrder($id);

        if ($orderData) {
            // Render giao diện chỉnh sửa
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Edit::render($orderData);
            Footer::render();
        } else {
            // Xử lý khi không tìm thấy đơn hàng
            NotificationHelper::error('order_edit', 'Không tìm thấy đơn hàng cần chỉnh sửa.');
            header("Location: /admin/order");
            exit;
        }
    }

    public static function update($id)
    {
        $orderModel = new Order();
        $data = [
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'order_status' => $_POST['order_status'],
            'payment_method' => $_POST['payment_method'],
            'shipping_method' => $_POST['shipping_method'],
            'payment_status' => $_POST['payment_status']
        ];

        try {
            if ($orderModel->updateOrder($id, $data)) {
                NotificationHelper::success('order_update', 'Đơn hàng đã được cập nhật thành công!');
            } else {
                NotificationHelper::error('order_update', 'Có lỗi xảy ra khi cập nhật đơn hàng.');
            }
        } catch (\Throwable $th) {
            error_log('Error updating order: ' . $th->getMessage());
            NotificationHelper::error('order_update', 'Lỗi không mong muốn xảy ra.');
        }

        header("Location: /admin/order");
        exit;
    }

    public static function delete($id)
    {
        $orderModel = new Order();

        // Kiểm tra nếu là yêu cầu POST và đã xác nhận xóa
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['method']) && $_POST['method'] === 'DELETE') {
            try {
                if ($orderModel->deleteOrder($id)) {
                    NotificationHelper::success('order_delete', 'Đơn hàng đã được xóa thành công!');
                } else {
                    NotificationHelper::error('order_delete', 'Không thể xóa đơn hàng. Vui lòng kiểm tra lại.');
                }
            } catch (\Throwable $th) {
                error_log('Lỗi khi xóa đơn hàng: ' . $th->getMessage());
                NotificationHelper::error('order_delete', 'Đã xảy ra lỗi không mong muốn.');
            }

            header("Location: /admin/order");
            exit;
        }

        // Nếu không phải POST hoặc không hợp lệ
        NotificationHelper::error('order_delete', 'Yêu cầu xóa không hợp lệ.');
        header("Location: /admin/order");
        exit;
    }
}
