<?php

namespace App\Models\Client;

use App\Models\BaseModel;

class Order extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';

    // Lấy danh sách đơn hàng của user
    public function createOrder($userId, $totalPrice, $paymentMethod, $address, $phone, $fullname)
    {
        $mysqli = $this->_conn->MySQLi();
        try {
            $sql = "INSERT INTO orders (user_id, total_price, payment_method, address, phone, name, order_status, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, 0, NOW())";

            // Chuẩn bị câu lệnh SQL
            $stmt = $mysqli->prepare($sql); // Thêm dòng này
            if (!$stmt) {
                throw new \Exception("Lỗi chuẩn bị truy vấn: " . $mysqli->error);
            }

            // Bind tham số
            $stmt->bind_param('idssss', $userId, $totalPrice, $paymentMethod, $address, $phone, $fullname);

            // Thực thi câu lệnh
            $stmt->execute();

            // Kiểm tra lỗi khi thực thi
            if ($stmt->errno) {
                throw new \Exception("Lỗi khi thực thi truy vấn: " . $stmt->error);
            }

            // Trả về ID của đơn hàng vừa tạo
            return $stmt->insert_id;
        } catch (\Exception $e) {
            // Ghi log lỗi
            error_log("Lỗi khi tạo đơn hàng: " . $e->getMessage());
            return false;
        }
    }

    public function addOrder($orderId, $productId, $skuId, $price, $discount, $quantity)
    {
        try {
            $sql = "
                INSERT INTO order_details 
                (order_id, product_id, sku_id, price, discount_price, quantity, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
            ";

            $stmt = $this->_conn->MySQLi()->prepare($sql);
            if (!$stmt) {
                throw new \Exception("Lỗi chuẩn bị truy vấn: " . $this->_conn->MySQLi()->error);
            }

            $stmt->bind_param('iiidii', $orderId, $productId, $skuId, $price, $discount, $quantity);
            $stmt->execute();

            if ($stmt->affected_rows === 0) {
                throw new \Exception("Không thêm được chi tiết đơn hàng.");
            }

            $stmt->close();
            return true;
        } catch (\Exception $e) {
            error_log("Lỗi khi thêm chi tiết đơn hàng: " . $e->getMessage());
            return false;
        }
    }



    public function getOrdersByUserId($userId)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            error_log("Trước khi truy vấn - Kết nối sống: " . ($mysqli->ping() ? "Yes" : "No"));

            $sql = "SELECT * FROM orders WHERE user_id = ?";
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new \Exception("Prepare error: " . $mysqli->error);
            }

            $stmt->bind_param('i', $userId);
            $stmt->execute();

            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            error_log("Kết quả: " . json_encode($data));

            return $data;
        } catch (\Exception $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return [];
        }
    }




    public function getOrderDetails($orderId)
    {
        try {
            $sql = "
            SELECT 
                od.*, 
                s.product_id, 
                p.name AS product_name, 
                p.origin AS product_origin,
                p.image AS product_image,
                pv.name AS variant_name,
                GROUP_CONCAT(pvo.name SEPARATOR ', ') AS variant_options
            FROM order_details od
            LEFT JOIN skus s ON od.sku_id = s.id
            LEFT JOIN products p ON s.product_id = p.id
            LEFT JOIN product_variants pv ON s.product_variant_id = pv.id
            LEFT JOIN product_variant_options pvo ON pv.id = pvo.product_variant_id
            WHERE od.order_id = ?
            GROUP BY od.id";

            $mysqli = $this->_conn->MySQLi();


            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new \Exception('Prepare statement failed: ' . $mysqli->error);
            }

            $stmt->bind_param('i', $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            if (!$result) {
                throw new \Exception('Query execution failed: ' . $stmt->error);
            }

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching order details: ' . $th->getMessage());
            return [];
        }
    }
    public function updateOrderStatus($orderId, $status)
    {
        try {
            $mysqli = $this->_conn->MySQLi();

            $sql = "UPDATE orders SET status = ?, updated_at = NOW() WHERE id = ?";
            $stmt = $mysqli->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Prepare error: " . $mysqli->error);
            }

            $stmt->bind_param('si', $status, $orderId);
            $stmt->execute();

            if ($stmt->affected_rows === 0) {
                throw new \Exception("Không có đơn hàng nào được cập nhật. Kiểm tra lại `orderId`.");
            }

            $stmt->close();
            return true;
        } catch (\Exception $e) {
            error_log("Error updating order status: " . $e->getMessage());
            return false;
        }
    }
}
