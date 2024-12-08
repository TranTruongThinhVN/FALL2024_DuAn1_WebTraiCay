<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class Order extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';

    public function getAllOrder()
    {
        return $this->getAll();
    }

    public function getOneOrder($id)
    {
        return $this->getOne($id);
    }

    public function createOrder($data)
    {

        try {
            $mysqli = $this->_conn->MySQLi();



            $sql = "INSERT INTO $this->table 
                    (order_date, total_price, name, address, phone, order_status, payment_method, shipping_method, payment_status, user_id)
                    VALUES (CURRENT_TIMESTAMP, ?, ?, ?, ?, 0, ?, ?, 0, ?)";

            $stmt = $mysqli->prepare($sql);

            $stmt->bind_param(
                "dsssssi",
                $data['total'],
                $data['fullName'],
                $data['address'],
                $data['phoneNumber'],
                $data['paymentMethod'],
                $data['deliveryMethod'],
                $data['userId']
            );
            if ($stmt->execute()) {
                $insertedId = $mysqli->insert_id;

                if ($insertedId > 0) {
                    $orderDetailsResult = $this->createOrderDetail($insertedId, $data['cartItems']);
                    if (!$orderDetailsResult) {
                        error_log("Failed to insert order details for Order ID $insertedId");
                        return false;
                    }

                    return $insertedId;
                } else {
                    error_log("Insert ID is 0, check AUTO_INCREMENT field.");
                    return false;
                }
            } else {
                error_log("Failed to execute statement: " . $stmt->error);
                return false;
            }
        } catch (\Throwable $th) {
            error_log('Lỗi khi tạo đơn hàng: ' . $th->getMessage());
            return false;
        }
    }

    public function createOrderDetail($orderId, $cartItems)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $sqlInsert = "INSERT INTO order_details (quantity, price, order_id, sku_id, product_id) VALUES (?, ?, ?, NULL, ?)";
            $stmtInsert = $mysqli->prepare($sqlInsert);
            if (!$stmtInsert) {
                error_log("Failed to prepare INSERT statement: " . $mysqli->error);
                return false;
            }

            foreach ($cartItems as $item) {
                $quantity = $item['quantity'];
                $price = isset($item['discount_price']) && $item['discount_price'] !== null ? $item['discount_price'] : $item['price'];
                $productId = $item['product_id'];
                $stmtInsert->bind_param("idis", $quantity, $price, $orderId, $productId);
                if (!$stmtInsert->execute()) {
                    error_log("Failed to insert order detail: " . $stmtInsert->error);
                    return false;
                }
            }

            return true;
        } catch (\Throwable $th) {
            error_log('Lỗi khi tạo chi tiết đơn hàng: ' . $th->getMessage());
            return false;
        }
    }

    public function updateOrder($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteOrder($id)
    {
        return $this->delete($id);
    }

    public function getAllOrderByStatus()
    {
        return $this->getAllByStatus();
    }

    public function getOrdersWithPagination($currentPage, $perPage)
    {
        $offset = ($currentPage - 1) * $perPage; // Tính offset từ trang hiện tại

        try {
            // Gắn trực tiếp giá trị LIMIT và OFFSET vào câu truy vấn
            $sql = "SELECT * FROM $this->table LIMIT $perPage OFFSET $offset";

            // Thực thi truy vấn
            $result = $this->_conn->MySQLi()->query($sql);

            // Kiểm tra và trả về dữ liệu
            if ($result) {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                return $data;
            }

            // Nếu truy vấn thất bại, trả về mảng rỗng
            return [];
        } catch (\Throwable $th) {
            // Ghi lỗi vào log nếu có lỗi xảy ra
            error_log('Lỗi khi phân trang: ' . $th->getMessage());
            return [];
        }
    }

    public function countOrders()
    {
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);

            if ($result) {
                $total = $result->fetch_assoc()['total'];
                return (int)$total;
            }

            return 0; // Trả về 0 nếu truy vấn thất bại
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm số đơn hàng: ' . $th->getMessage());
            return 0;
        }
    }
}
