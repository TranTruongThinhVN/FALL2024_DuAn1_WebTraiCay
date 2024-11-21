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
    public function getComments($id) {
        $result = [];
        try {
            // Câu lệnh SQL để lấy bình luận của sản phẩm
            $sql = "SELECT * FROM comments WHERE product_id = ? ORDER BY created_at DESC";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultSet = $stmt->get_result();
            while ($row = $resultSet->fetch_assoc()) { 
                $commentId = $row['id']; 
                $row['images'] = $this->getCommentImages($commentId); 
                $result[] = $row;
            } 
            $stmt->close();
        } catch (\Throwable $th) { 
            error_log('Lỗi khi lấy bình luận: ' . $th->getMessage());
        } 
        return $result;
    }
    public function getProductDetails($id) {
        $result = [];
        try { 
            // $product = $this->getOneProduct($id); 
            $comments = $this->getComments($id); 
            // $result['product'] = $product;
            $result['comments'] = $comments;
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy chi tiết sản phẩm: ' . $th->getMessage());
        } 
        return $result; 
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
public function getCommentsByid($id)
{
    $result = [];
    $sql = "SELECT comments.*, products.name AS product_name
        FROM comments
        INNER JOIN products ON comments.product_id = products.id
        WHERE comments.product_id = $id";

    $query = $this->_conn->MySQLi()->query($sql);
    if ($query) {
        $result = $query->fetch_all(MYSQLI_ASSOC);
        foreach ($result as &$comment) {
            // Format dates
            if (isset($comment['created_at'])) {
                $comment['created_at'] = $this->formatDate($comment['created_at']);
            }
            if (isset($comment['updated_at'])) {
                $comment['updated_at'] = $this->formatDate($comment['updated_at']);
            }

            // Get images for each comment
            $comment_id = $comment['id'];
            $comment['images'] = $this->getCommentImages($comment_id); // Call function to get images

        }
        
        // Fetch product comment count (total comments for the specific product)
        $countComments = $this->getProductsWithCommentCount(); // Call function to get all products with their comment count
        foreach ($countComments as $product) {
            if ($product['product_id'] == $id) {
                $result['total_comments'] = $product['total_comments']; // Assign the total_comments count for this specific product
                break; // Stop loop once the relevant product is found
            }
        }

    } else {
        error_log("Error executing query: " . $this->_conn->MySQLi()->error);
    }

    return $result;
}

    public function getCommentImages($id)
{
    $images = []; 
    $sql = "SELECT id, image_url, comment_id FROM comment_images WHERE comment_id = $id";
    $query = $this->_conn->MySQLi()->query($sql);
    if ($query) { 
        $images = $query->fetch_all(MYSQLI_ASSOC);
    } else { 
        error_log("Lỗi khi lấy ảnh cho comment_id = $id: " . $this->_conn->MySQLi()->error);
    }

    return $images;
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
        // Gọi CommentModel để lấy bình luận 
        $product['comments'] = $this->getCommentsByid($id);
    }

    return $product;
}

}
