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
    public function getOneProduct($id)
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

    // public function deleteProduct($id)
    // {
    //     return $this->delete($id);
    // }
    // public function addProductToCart($user_id, $sku_id, $variant_id, $quantity)
    // {
    //     try {
    //         $mysqli = $this->_conn->MySQLi();

    //         if ($variant_id) {
    //             // Lấy `product_variant_id` từ bảng `product_variants`
    //             $query = "SELECT id FROM product_variants WHERE id = ?";
    //             $stmt = $mysqli->prepare($query);
    //             $stmt->bind_param('i', $variant_id);
    //             $stmt->execute();
    //             $result = $stmt->get_result()->fetch_assoc();

    //             if (!$result) {
    //                 throw new \Exception("Biến thể không tồn tại: Variant ID: $variant_id");
    //             }
    //         }

    //         // Chèn dữ liệu vào bảng `cart_products`
    //         $query = "INSERT INTO cart_products (user_id, sku_id, product_variant_id, quantity, created_at)
    //                   VALUES (?, ?, ?, ?, NOW())
    //                   ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
    //         $stmt = $mysqli->prepare($query);
    //         $stmt->bind_param('iiii', $user_id, $sku_id, $variant_id, $quantity);
    //         $stmt->execute();

    //         return true;
    //     } catch (\Exception $e) {
    //         error_log('Error adding product to cart: ' . $e->getMessage());
    //         return false;
    //     }
    // }
    // Trả giá theo variant-options phụ trợ để hiện giá trên giao diện
    public function getSkuPrice()
    {
        try {
            $variant_id = $_GET['variant_id'] ?? null;
            $option_id = $_GET['option_id'] ?? null;

            if (!$variant_id || !$option_id) {
                throw new \Exception("Thông tin biến thể không đầy đủ.");
            }

            $mysqli = $this->_conn->MySQLi();
            $query = "SELECT price FROM skus WHERE product_variant_id = ? AND id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ii', $variant_id, $option_id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            if ($result) {
                echo json_encode(['success' => true, 'price' => number_format($result['price'])]);
            } else {
                throw new \Exception("Không tìm thấy SKU tương ứng.");
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function getSkuByVariantAndOption($variantId, $optionId)
    {
        try {
            $sql = "
                SELECT s.id, s.price, s.image, s.discount_price 
                FROM skus s
                INNER JOIN skus_product_variant_options spvo ON s.id = spvo.sku_id
                WHERE spvo.product_variant_id = ? AND spvo.product_variant_options_id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $variantId, $optionId);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result ?: null;
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy SKU: ' . $th->getMessage());
            return null;
        }
    }


    public function clearCartByUserId($userId)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $sql = "DELETE FROM $this->table WHERE user_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $userId);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            error_log('Lỗi khi xóa giỏ hàng người dùng ID ' . $userId . ': ' . $th->getMessage());
            return false;
        }
    }


    public function addProductToCart($user_id, $product_id, $quantity)
    {
        try {
            $mysqli = $this->_conn->MySQLi();

            if (!$mysqli->ping()) {
                error_log('Kết nối MySQL đã mất. Tạo lại kết nối...');
                $this->_conn = new \App\Models\Database();
                $mysqli = $this->_conn->MySQLi();
                if (!$mysqli->ping()) {
                    throw new \Exception("Không thể tái tạo kết nối MySQL.");
                }
                error_log('Kết nối MySQL đã được tái tạo.');
            }
            $query = "SELECT id FROM product_variants WHERE product_id = ?";
            $stmt = $mysqli->prepare($query);

            if (!$stmt) {
                throw new \Exception("Lỗi prepare SELECT product_variant: " . $mysqli->error);
            }
            $stmt->bind_param('i', $product_id);
            if (!$stmt->execute()) {
                throw new \Exception("Lỗi execute SELECT product_variant: " . $stmt->error);
            }
            $stmt->store_result();

            // Nếu sku_id không tồn tại trong product_variants
            if ($stmt->num_rows === 0) {
                throw new \Exception("Sản phẩm variant không tồn tại.");
            }
            $stmt->bind_result($product_variant_id);
            $stmt->fetch();

            print_r($product_variant_id);
            // Kiểm tra xem sku_id có tồn tại trong skus không
            $query = "SELECT id FROM skus WHERE product_variant_id = ?";

            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                throw new \Exception("Lỗi prepare SELECT skus: " . $mysqli->error);
            }
            $stmt->bind_param('i', $product_variant_id);
            if (!$stmt->execute()) {
                throw new \Exception("Lỗi execute SELECT skus: " . $stmt->error);
            }
            $stmt->store_result();

            // Nếu sku_id không tồn tại trong skus
            if ($stmt->num_rows === 0) {
                throw new \Exception("sku_id không tồn tại trong bảng skus.");
            }
            // Kiểm tra xem sku_id có tồn tại trong product_variants không
            $stmt->bind_result($sku_id);
            $stmt->fetch();

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
                $query = "INSERT INTO cart_products (user_id, sku_id, product_variant_id, quantity, created_at) VALUES (?, ?, ?, ?, NOW())";
                $stmt = $mysqli->prepare($query);
                if (!$stmt) {
                    throw new \Exception("Lỗi prepare INSERT: " . $mysqli->error);
                }
                // Bind all 4 parameters: user_id, sku_id, product_variant_id, and quantity
                $stmt->bind_param('iiis', $user_id, $sku_id, $product_variant_id, $quantity);
                if (!$stmt->execute()) {
                    throw new \Exception("Lỗi execute INSERT: " . $stmt->error);
                }
                error_log("INSERT thành công: user_id = $user_id, sku_id = $sku_id, product_variant_id = $product_variant_id, quantity = $quantity");
            }

            return true;
        } catch (\Exception $e) {
            error_log('Error adding product to cart: ' . $e->getMessage());
            return false;
        }
    }

    public function getCartProducts($userId)
    {
        try {

            $mysqli = $this->_conn->MySQLi();
            if (!$mysqli->ping()) {
                error_log('Kết nối MySQL đã mất. Tạo lại kết nối...');
                $this->_conn = new \App\Models\Database();
                $mysqli = $this->_conn->MySQLi();
                if (!$mysqli->ping()) {
                    throw new \Exception("Không thể tái tạo kết nối MySQL.");
                }
                error_log('Kết nối MySQL đã được tái tạo.');
            }

            $query = "
                SELECT 
                    cp.quantity,
                    p.name AS sku_name,
                    p.price,
                    p.discount_price,
                    p.image,
                    p.id AS product_id,
                    p.name AS product_name,
                    p.type,
                    cp.cart_id as cart_id
                FROM cart_products cp
                INNER JOIN products p ON cp.product_id = p.id  
                WHERE cp.user_id = ?
            ";

            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                die("Prepare failed: " . $mysqli->error);
            }
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $cartProducts = [];
            while ($row = $result->fetch_assoc()) {
                $cartProducts[] = $row;
            }

            $stmt->close();

            return $cartProducts;
        } catch (\Exception $e) {
            error_log('Error adding product to cart: ' . $e->getMessage());
            return false;
        }
    }






    public function getSkuForSimpleProduct()
    {
        try {
            $mysqli = $this->_conn->MySQLi();

            // Lấy SKU cho sản phẩm đơn giản
            $query = "SELECT id FROM skus WHERE product_variant_id IS NULL AND status = 1";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result['id'] ?? null;
        } catch (\Exception $e) {
            error_log("Error fetching simple product SKU: " . $e->getMessage());
            return null;
        }
    }





    public function getProductDetails($sku_id)
    {
        try {
            $sql = "SELECT name, price, image FROM skus WHERE id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $sku_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Exception $e) {
            error_log("Error fetching product details: " . $e->getMessage());
            return null;
        }
    }
    // KIỂM TRA GUID ÚNG



    public function addItem($cartItem)
    {
        try {
            $mysqli = $this->_conn->MySQLi();

            // Lấy thông tin từ session và mảng $cartItem
            $user_id = $_SESSION['user']['id'] ?? null;
            $product_id = $cartItem['product_id'] ?? null;
            $sku_id = $cartItem['sku_id'] ?? null;
            $quantity = $cartItem['quantity'] ?? 1;

            // Kiểm tra đầu vào
            if ($user_id === null || $quantity === null || ($sku_id === null && $product_id === null)) {
                throw new \Exception("Thông tin thêm vào giỏ hàng không đầy đủ.");
            }

            // Kiểm tra nếu sản phẩm đã tồn tại
            $sqlCheck = "SELECT quantity FROM cart_products WHERE user_id = ? AND product_id = ? AND (sku_id = ? OR ? IS NULL)";
            $stmtCheck = $mysqli->prepare($sqlCheck);
            $stmtCheck->bind_param('iiii', $user_id, $product_id, $sku_id, $sku_id);
            $stmtCheck->execute();
            $result = $stmtCheck->get_result();

            if ($result->num_rows > 0) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng
                $row = $result->fetch_assoc();
                $newQuantity = $row['quantity'] + $quantity;

                $sqlUpdate = "UPDATE cart_products SET quantity = ?, updated_at = NOW() WHERE user_id = ? AND product_id = ? AND (sku_id = ? OR ? IS NULL)";
                $stmtUpdate = $mysqli->prepare($sqlUpdate);
                $stmtUpdate->bind_param('iiiii', $newQuantity, $user_id, $product_id, $sku_id, $sku_id);
                $stmtUpdate->execute();
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới
                $sqlInsert = "INSERT INTO cart_products (user_id, product_id, sku_id, quantity, created_at) 
                          VALUES (?, ?, ?, ?, NOW())";
                $stmtInsert = $mysqli->prepare($sqlInsert);
                $stmtInsert->bind_param('iiii', $user_id, $product_id, $sku_id, $quantity);
                $stmtInsert->execute();
            }
        } catch (\Exception $e) {
            // Ghi log lỗi
            error_log("Error adding item to cart: " . $e->getMessage());
            throw $e; // Để controller xử lý tiếp
        }
    }





    // Hiển thị giỏ hàng
    public function getCartItems($user_id)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $query = "SELECT 
    cp.cart_id,
    cp.user_id,
    cp.quantity,
    s.id AS sku_id,
    s.name AS sku_name,
    s.price AS sku_price,
    s.image AS sku_image,
    pv.name AS variant_name,
    p.name AS product_name
FROM 
    cart_products cp
JOIN 
    skus s ON cp.sku_id = s.id
JOIN 
    product_variants pv ON s.product_variant_id = pv.id
JOIN 
    products p ON pv.product_id = p.id
WHERE 
    cp.user_id = ?; -- Thay `1` bằng ID user thực tế
;
";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            // error_log("Cart Items: " . json_encode($result->fetch_all(MYSQLI_ASSOC)));

            return $result->fetch_all(MYSQLI_ASSOC); // Trả về danh sách sản phẩm
        } catch (\Exception $e) {
            error_log("Error fetching cart items: " . $e->getMessage());
            return [];
        }
    }
    // xóa 1 sản phẩm
    public function deleteProduct($cartId)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $query = "DELETE FROM cart_products WHERE cart_id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $cartId);
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } catch (\Exception $e) {
            error_log('Error deleting product: ' . $e->getMessage());
            return false;
        }
    }

    // xóa nhiều sản phẩm
    public function deleteMultipleProducts($cartIds)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $in = str_repeat('?,', count($cartIds) - 1) . '?';
            $query = "DELETE FROM cart_products WHERE cart_id IN ($in)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param(str_repeat('i', count($cartIds)), ...$cartIds);
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } catch (\Exception $e) {
            error_log('Error deleting multiple products: ' . $e->getMessage());
            return false;
        }
    }
    // +- gio hang
    public function updateProductQuantity($cartId, $quantity)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $query = "UPDATE cart_products SET quantity = ?, updated_at = NOW() WHERE cart_id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ii', $quantity, $cartId);
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } catch (\Exception $e) {
            error_log('Error updating product quantity: ' . $e->getMessage());
            return false;
        }
    }


    public function getCartItemById($cartId)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $query = "SELECT * FROM cart_products WHERE cart_id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $cartId);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Exception $e) {
            error_log('Error fetching cart item: ' . $e->getMessage());
            return null;
        }
    }

    public function getCartTotal($userId)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $query = "SELECT SUM(cp.quantity * s.price) AS total
                  FROM cart_products cp
                  JOIN skus s ON cp.sku_id = s.id
                  WHERE cp.user_id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result['total'] ?? 0;
        } catch (\Exception $e) {
            error_log('Error fetching cart total: ' . $e->getMessage());
            return 0;
        }
    }
}
