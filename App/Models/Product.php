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

    public function getProductsWithCommentCount()
    {
        $result = [];
        try {
            $sql = "SELECT 
                        products.id AS product_id,
                        products.name AS product_name,
                        COUNT(comments.id) AS total_comments
                    FROM products
                    LEFT JOIN comments ON products.id = comments.product_id
                    GROUP BY products.id, products.name
                    ORDER BY total_comments DESC;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching products with comment count: ' . $th->getMessage());
            return $result;
        }
    }

    public function getCommentsByProductId($productId)
    {
        $result = [];
        $sql = "SELECT comments.*, products.name AS product_name
            FROM comments
            INNER JOIN products ON comments.product_id = products.id
            WHERE comments.product_id = $productId";

        $query = $this->_conn->MySQLi()->query($sql);
        if ($query) {
            $result = $query->fetch_all(MYSQLI_ASSOC);
            foreach ($result as &$comment) {
                // Format các ngày
                if (isset($comment['created_at'])) {
                    $comment['created_at'] = $this->formatDate($comment['created_at']);
                }
                if (isset($comment['update_at'])) {
                    $comment['update_at'] = $this->formatDate($comment['update_at']);
                }

                // Lấy danh sách ảnh cho từng bình luận
                $commentId = $comment['id'];
                $comment['images'] = $this->getCommentImages($commentId); // Gọi hàm lấy ảnh
            }
        } else {
            error_log("Lỗi khi thực hiện truy vấn: " . $this->_conn->MySQLi()->error);
        }

        return $result;
    }

    public function getCommentImages($commentId)
    {
        $images = []; // Mảng lưu danh sách ảnh
        $sql = "SELECT image_url FROM comment_images WHERE comment_id = $commentId";

        // Thực hiện truy vấn
        $query = $this->_conn->MySQLi()->query($sql);
        if ($query) {
            // Chuyển kết quả thành mảng
            $images = $query->fetch_all(MYSQLI_ASSOC);
        } else {
            // Log lỗi nếu truy vấn thất bại
            error_log("Lỗi khi lấy ảnh cho comment_id = $commentId: " . $this->_conn->MySQLi()->error);
        }

        return $images; // Trả về mảng chứa danh sách ảnh
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
}
