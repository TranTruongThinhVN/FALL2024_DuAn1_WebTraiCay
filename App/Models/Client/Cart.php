<?php

namespace App\Models\Client;

use App\Models\BaseModel;

class Cart extends BaseModel
{
    protected $table = 'cart_products';
    protected $id = 'cart_id';

    public function getAllProduct()
    {
        return $this->getAll();
    }
    public function getOneUser($id)
    {
        return $this->getOne($id);
    }

    public function createProduct($data)
    {
        return $this->create($data);
    }
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete($id);
    }

    public function addProductToCart($user_id, $sku_id, $quantity)
    {
        try {
            // Lấy đối tượng mysqli
            $mysqli = $this->_conn->MySQLi();

            // Kiểm tra kết nối MySQL
            if (!$mysqli->ping()) {
                error_log('Kết nối MySQL đã mất. Tạo lại kết nối...');
                $this->_conn = new \App\Models\Database(); // Tạo lại đối tượng Database
                $mysqli = $this->_conn->MySQLi();
                if (!$mysqli->ping()) {
                    throw new \Exception("Không thể tái tạo kết nối MySQL.");
                }
                error_log('Kết nối MySQL đã được tái tạo.');
            }

            // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
            $query = "SELECT * FROM cart_products WHERE user_id = ? AND sku_id = ?";
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                throw new \Exception("Lỗi prepare SELECT: " . $mysqli->error);
            }
            $stmt->bind_param('ii', $user_id, $sku_id);
            if (!$stmt->execute()) {
                throw new \Exception("Lỗi execute SELECT: " . $stmt->error);
            }
            $result = $stmt->get_result()->fetch_assoc();

            if ($result) {
                // Nếu sản phẩm đã tồn tại, cập nhật số lượng
                $query = "UPDATE cart_products SET quantity = quantity + ?, updated_at = NOW() WHERE user_id = ? AND sku_id = ?";
                $stmt = $mysqli->prepare($query);
                if (!$stmt) {
                    throw new \Exception("Lỗi prepare UPDATE: " . $mysqli->error);
                }
                $stmt->bind_param('iii', $quantity, $user_id, $sku_id);
                if (!$stmt->execute()) {
                    throw new \Exception("Lỗi execute UPDATE: " . $stmt->error);
                }
                error_log("UPDATE thành công: user_id = $user_id, sku_id = $sku_id, quantity = $quantity");
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới
                $query = "INSERT INTO cart_products (user_id, sku_id, quantity, created_at) VALUES (?, ?, ?, NOW())";
                $stmt = $mysqli->prepare($query);
                if (!$stmt) {
                    throw new \Exception("Lỗi prepare INSERT: " . $mysqli->error);
                }
                $stmt->bind_param('iii', $user_id, $sku_id, $quantity);
                if (!$stmt->execute()) {
                    throw new \Exception("Lỗi execute INSERT: " . $stmt->error);
                }
                error_log("INSERT thành công: user_id = $user_id, sku_id = $sku_id, quantity = $quantity");
            }

            return true;
        } catch (\Exception $e) {
            error_log('Error adding product to cart: ' . $e->getMessage());
            return false;
        }
    }
}
