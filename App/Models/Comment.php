<?php

namespace App\Models;

class Comment extends BaseModel
{
    protected $table = 'comments';
    protected $id = 'id';

    public function getAllComment()
{
    $result = [];
    try {
        $sql = "SELECT 
        comments.*, 
        products.name AS product_name,
        users.name AS user_name,
        categories.name AS category_name  -- Thêm danh mục vào
        FROM 
            comments
        INNER JOIN 
            products ON comments.product_id = products.id 
        INNER JOIN 
            users ON comments.user_id = users.id
        INNER JOIN 
            categories ON products.category_id = categories.id  -- Thực hiện JOIN với bảng categories
        ";
        
        // Thực thi truy vấn
        $resultQuery = $this->_conn->MySQLi()->query($sql);
        
        // Kiểm tra kết quả của truy vấn
        if ($resultQuery === false) {
            throw new Exception("Error executing query: " . $this->_conn->MySQLi()->error);
        }

        // Lấy tất cả kết quả của truy vấn
        $result = $resultQuery->fetch_all(MYSQLI_ASSOC);

        // Lấy thêm hình ảnh nếu cần thiết (cần id bình luận)
        // Gọi hàm lấy hình ảnh nếu cần (chú ý hàm getCommentImages chưa được gọi đúng)
        foreach ($result as &$comment) {
            // Lấy hình ảnh cho từng bình luận (nếu cần)
            $comment['images'] = $this->getCommentImages($comment['id']);
        }

        return $result;
    } catch (\Throwable $th) {
        error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
        return $result;
    }
}

    public function getOneComment($id)
    {
        return $this->getOne($id);
    }

    public function createComment($data)
    {
        // Kiểm tra kết nối
        if (!$this->_conn->MySQLi()->ping()) {
            error_log('Kết nối MySQL bị mất, thử kết nối lại');
            $this->_conn->MySQLi()->connect(); // Tạo lại kết nối
        }
    
        // Kiểm tra dữ liệu
        if (strlen($data['content']) > 65535) {
            error_log('Nội dung quá dài, vượt giới hạn cho phép.');
            return false;
        }
    
        // Câu lệnh SQL
        $sql = "INSERT INTO comments (content, rating, user_id, product_id, created_at, updated_at, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        // Chuẩn bị câu lệnh
        $stmt = $this->_conn->MySQLi()->prepare($sql);
        if (!$stmt) {
            error_log('Lỗi chuẩn bị statement: ' . $this->_conn->MySQLi()->error);
            return false;
        }
    
        $updatedAt = date('Y-m-d H:i:s'); // Thêm thời gian cập nhật
        $status = 1; // Giá trị mặc định cho trạng thái
    
        // Bind dữ liệu
        if (!$stmt->bind_param(
            "siisssi", 
            $data['content'],
            $data['rating'],
            $data['user_id'],
            $data['product_id'],
            $data['created_at'],
            $updatedAt,
            $status
        )) {
            error_log('Lỗi bind_param: ' . $stmt->error);
            return false;
        }
    
        // Thực thi và kiểm tra lỗi
        if (!$stmt->execute()) {
            error_log('Lỗi thực thi statement: ' . $stmt->error);
            return false;
        }
    
        return true;
    } 
    public function getLatestComment()
{
    // $result = [];
    // try {
    //     $sql = "SELECT * FROM comments ORDER BY created_at DESC LIMIT 2;";
    //     $conn = $this->_conn->MySQLi();
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    //     $result = $stmt->get_result()->fetch_assoc();
    // } catch (\Throwable $th) {
    //     error_log('Lỗi khi lấy bình luận mới nhất: ' . $th->getMessage());
    // }
    // return $result;
}



    public function getComments($id)
    {
        $result = [];
        try {
            // Câu lệnh SQL để lấy bình luận của sản phẩm
            $sql = "SELECT comments.*, users.name AS username 
                FROM comments 
                INNER JOIN users ON comments.user_id = users.id 
                WHERE comments.product_id = ? 
                ORDER BY comments.created_at DESC";
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

    public function getAverageRating($id)
    {
        $averageRating = 0;
        $totalReviews = 0;
        $detailedRatings = [];

        try {
            // Truy vấn lấy số lượng từng loại sao
            $sql = "SELECT rating, COUNT(*) as count
                FROM comments
                WHERE product_id = $id
                GROUP BY rating
                ORDER BY rating DESC";
            $result = $this->_conn->MySQLi()->query($sql);
            $totalRatings = 0;
            while ($row = $result->fetch_assoc()) {
                $detailedRatings[] = $row;
                $totalRatings += $row['rating'] * $row['count'];
                $totalReviews += $row['count'];
            }

            // Tính điểm trung bình
            if ($totalReviews > 0) {
                $averageRating = $totalRatings / $totalReviews;
            }
        } catch (\Throwable $th) {
            // Log lỗi nếu xảy ra
            error_log('Error fetching average rating: ' . $th->getMessage());
        }

        // Trả về dữ liệu
        return [
            'average' => round($averageRating, 1), // Điểm trung bình làm tròn 1 chữ số thập phân
            'totalReviews' => $totalReviews, // Tổng số đánh giá
            'detailedRatings' => $detailedRatings // Chi tiết từng loại đánh giá
        ];
    }
    public function updateComment($id, $data)
    {
        $sql = "UPDATE comments SET content = ?, status = ?,  WHERE id = ?";

        $stmt = $this->_conn->MySQLi()->prepare($sql);
        $stmt->bind_param("ssi", $data['content'], $data['status'],  $id);
        $stmt->execute();

        if (!empty($data['images'])) {
            // Nếu có ảnh, lưu vào bảng comment_images
            $images = explode(',', $data['images']);
            foreach ($images as $image) {
                $this->saveImage($id, $image);
            }
        }

        return $stmt->affected_rows > 0;
    }





    private function saveImage($commentId, $imageUrl)
    {
        $sql = "INSERT INTO comment_images (comment_id, image_url) VALUES (?, ?)";
        $stmt = $this->_conn->MySQLi()->prepare($sql);
        $stmt->bind_param("is", $commentId, $imageUrl);
        $stmt->execute();
    } 
    public function deleteComment(int $id): bool
    {
        try {
            $sql = "DELETE FROM comments WHERE id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            // Trả về số hàng dữ liệu bị ảnh hưởng
            return $stmt->affected_rows > 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi xóa dữ liệu: ' . $th->getMessage());
            return false;
        }
    }


    public function getAllCommentByStatus()
    {
        return $this->getAllByStatus();
    } 
    public function getOneCommentJoinProductAndUser(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT 
            comments.*, 
            products.name AS product_name, 
            users.first_name AS first_name, 
            users.last_name AS last_name
        FROM comments
        INNER JOIN products ON comments.product_id = products.id
        INNER JOIN users ON comments.user_id = users.id
        WHERE comments.id = ?";

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

            // Thực hiện truy vấn
            $query = $this->_conn->MySQLi()->query($sql);

            if ($query) {
                $result = $query->fetch_all(MYSQLI_ASSOC);
                foreach ($result as &$product) {
                    $productId = $product['product_id'];
                    $product['average_rating'] = $this->getAverageRating($productId);
                    // var_dump($product['average_rating']); // Sửa $id thành $productId
                }
            } else {
                error_log("Lỗi khi thực hiện truy vấn: " . $this->_conn->MySQLi()->error);
            }
        } catch (\Throwable $th) {
            error_log('Error fetching products with comment count: ' . $th->getMessage());
        }

        return $result; // Trả về kết quả sau khi xử lý xong
    }
    public function getCommentsById($id)
    {
        $result = [];
        $sql = "SELECT * FROM comments WHERE product_id = $id";
        // SELECT comments.*, products.name AS product_name FROM comments INNER JOIN products ON comments.product_id = products.id WHERE comments.product_id = 1;
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
