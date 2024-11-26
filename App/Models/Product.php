<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = 'products';
    protected $id = 'id';

    public function getAllProduct()
    {
        return $this->getAll();
    }
    public function getOneProduct($id) {
        $result = [];
        try {
            $sql = "SELECT * FROM products WHERE id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    
    public function getProductDetails($id) {
        $result = [];
        try { 
            $product = $this->getOneProduct($id); 
            $data = new Comment(); 
            $comments = $data->getComments($id); 
            // $countComment = $this->getProductsWithCommentCount();
            $raTingComment = $data->getAverageRating($id);
            $result['product'] = $product;
            $result['comments'] = $comments;
            $result['rating'] = $raTingComment; 
            $result['comment_count'] = count($comments);
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy chi tiết sản phẩm: ' . $th->getMessage());
        } 
        return $result; 
    } 
    public function countProduct()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS total_products FROM products;";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm số sản phẩm: ' . $th->getMessage());
        }
        return $result['total_products'] ?? 0;
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
    public function getAllProductByStatus()
    {
        $result = [];
        try {
            $sql = "SELECT products.* 
            FROM products 
            INNER JOIN categories 
            ON products.category_id=categories.id 
            WHERE products.status=" . self::STATUS_ENABLE . "
            AND categories.status=" . self::STATUS_ENABLE;

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOneProductByName($name)
    {
        return $this->getOneByName($name);
    }

    public function getAllProductJoinCategory()
    {
        $result = [];
        try {
            //$sql = "SELECT * FROM $this->table";
            $sql = "SELECT products.*,categories.name 
            AS category_name 
            FROM products 
            INNER JOIN categories 
            ON products.category_id=categories.id;";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getAllProductByCategoryAndStatus(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name
            FROM products INNER JOIN categories 
            ON products.category_id=categories.id 
            WHERE products.status=" . self::STATUS_ENABLE . "
            AND categories.status=" . self::STATUS_ENABLE . " AND products.category_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOneProductByStatus(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name
            FROM products INNER JOIN categories 
            ON products.category_id=categories.id 
            WHERE products.status=" . self::STATUS_ENABLE . "
            AND categories.status=" . self::STATUS_ENABLE . " AND products.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    } 

    public function searchProducts($keyword)
    {
        // Truy vấn cơ sở dữ liệu để tìm sản phẩm theo tên hoặc mô tả
        $result = [];
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE name LIKE ? OR description LIKE ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Thêm ký tự '%' vào trước và sau từ khóa để tìm kiếm
            $searchTerm = '%' . $keyword . '%';
            $stmt->bind_param('ss', $searchTerm, $searchTerm); // 'ss' cho 2 tham số kiểu string

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi tìm kiếm sản phẩm: ' . $th->getMessage());
        }

        return $result;
    }

    public function filterProductsByPrice($minPrice = 0, $maxPrice = PHP_INT_MAX)
    {
        $result = [];
        try {
            $conn = $this->_conn->MySQLi();
            $sql = "SELECT * FROM " . $this->table . " WHERE price BETWEEN ? AND ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $minPrice, $maxPrice);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi lọc sản phẩm theo giá: ' . $th->getMessage());
        }

        return $result;
    }
    public function getOneProductWithComments($id)
{
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $this->_conn->MySQLi()->prepare($sql); // Sử dụng prepared statement
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($product) {
        $data = new Comment();
        $product['comments'] = $data->getCommentsByid($id);
    }

    return $product;
}

    
}
