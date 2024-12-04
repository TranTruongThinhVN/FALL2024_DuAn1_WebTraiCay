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
                throw new \Exception("Error executing query: " . $this->_conn->MySQLi()->error);
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
        try {
            // Tạo câu lệnh SQL để chèn comment vào bảng
            $sql = "INSERT INTO $this->table (";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
            }

            $sql = rtrim($sql, ", ");
            $sql .= " ) VALUES (";

            foreach ($data as $key => $value) {
                $sql .= "'$value', ";
            }

            $sql = rtrim($sql, ", ");
            $sql .= ")";

            // Kết nối và chuẩn bị câu truy vấn
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Thực thi câu truy vấn
            if ($stmt->execute()) {
                // Lấy comment_id vừa được tạo ra
                $comment_id = $conn->insert_id;

                // Kiểm tra nếu có hình ảnh, thêm vào bảng comment-images
                if (!empty($data['images'])) {
                    foreach ($data['images'] as $image_url) {
                        $this->addCommentImage($comment_id, $image_url); // Gọi hàm addCommentImage để thêm hình ảnh
                    }
                }

                return $comment_id; // Trả về comment_id nếu thành công
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    public function addCommentImage($comment_id, $image_url)
    {
        try {
            // Tạo mảng dữ liệu cần thêm vào bảng comment_images
            $data = [
                'image_url' => $image_url,
                'comment_id' => $comment_id
            ];

            // Kiểm tra dữ liệu trước khi tiếp tục
            if (empty($data['image_url']) || empty($data['comment_id'])) {
                error_log('Dữ liệu không hợp lệ: ' . var_export($data, true));
                return false;
            }

            // Câu lệnh SQL để thêm dữ liệu vào bảng comment_images
            $sql = "INSERT INTO comment_images (image_url, comment_id) VALUES (?, ?)"; // Sửa tên bảng là comment_images

            // var_dump($sql);
            // die;
            // Kết nối và chuẩn bị câu truy vấn
            $conn = $this->_conn->MySQLi();

            if ($conn === false) {
                error_log('Không thể kết nối cơ sở dữ liệu');
                return false;
            }

            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                error_log('Failed to prepare SQL: ' . $conn->error);
                return false;
            }

            // Liên kết tham số vào câu truy vấn
            $stmt->bind_param('si', $data['image_url'], $data['comment_id']); // 's' cho image_url (string), 'i' cho comment_id (int)

            // Thực thi câu truy vấn
            if (!$stmt->execute()) {
                error_log('Failed to execute SQL: ' . $stmt->error);
                return false;
            }

            return true;
        } catch (\Throwable $th) {
            // Ghi lại lỗi nếu có
            error_log('Lỗi khi thêm dữ liệu hình ảnh: ' . $th->getMessage());
            return false;
        }
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

    //     public function getPagedComments($productId, $offset, $limit)
    // {
    //     try {
    //         // Kiểm tra và ép kiểu dữ liệu an toàn
    //         $productId = (int)$productId;  // Chắc chắn productId là số nguyên
    //         $offset = max(0, (int)$offset); // Đảm bảo offset >= 0
    //         $limit = max(1, (int)$limit);  // Đảm bảo limit >= 1

    //         // Truy vấn trực tiếp với tham số đã được kiểm tra
    //         $sql = "SELECT * FROM comments 
    //                 WHERE product_id = ? 
    //                 ORDER BY created_at DESC 
    //                 LIMIT ?, ?";

    //         $conn = $this->_conn->MySQLi();  // Kết nối MySQLi
    //         $stmt = $conn->prepare($sql);    // Sử dụng prepared statement
    //         $stmt->bind_param("iii", $productId, $offset, $limit); // Bảo vệ chống SQL Injection

    //         $stmt->execute();  // Thực thi truy vấn
    //         $result = $stmt->get_result();  // Lấy kết quả

    //         return $result->fetch_all(MYSQLI_ASSOC);  // Dùng fetch_all() với MySQLi
    //     } catch (\Exception $e) {
    //         error_log($e->getMessage()); // Log lỗi
    //         return [];
    //     }
    // }






    public function getCommentByProductId($id, $offset, $limit)
    {
        $result = [];
        try {
            // Câu lệnh SQL để lấy bình luận của sản phẩm với phân trang
            $sql = "SELECT comments.*, 
                       users.name AS username, 
                       products.name AS product_name
                FROM comments
                INNER JOIN users ON comments.user_id = users.id
                INNER JOIN products ON comments.product_id = products.id
                WHERE comments.product_id = ?
                ORDER BY comments.created_at DESC
                LIMIT ?, ?";  // Thêm LIMIT và OFFSET vào câu truy vấn

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iii', $id, $offset, $limit);  // Bind thêm LIMIT và OFFSET
            $stmt->execute();
            $resultSet = $stmt->get_result();

            // Duyệt qua kết quả và lấy thêm hình ảnh bình luận
            while ($row = $resultSet->fetch_assoc()) {
                $commentId = $row['id'];
                $row['images'] = $this->getCommentImages($commentId);  // Lấy hình ảnh cho bình luận
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
        // var_dump($images);
        // die
        return $images;
    }

    public function getCountImagesByProductId($id)
    {
        $result = [];
        // Câu truy vấn SQL để lấy tổng số hình ảnh cho sản phẩm
        $sql = "SELECT COUNT(comment_images.id) AS total_images
            FROM comment_images
            JOIN comments ON comment_images.comment_id = comments.id
            WHERE comments.product_id = $id";

        // Thực thi câu truy vấn
        $query = $this->_conn->MySQLi()->query($sql);

        if ($query) {
            // Lấy kết quả
            $row = $query->fetch_assoc(); // Fetch kết quả dưới dạng mảng kết hợp
            return $row['total_images']; // Trả về tổng số hình ảnh
        } else {
            error_log("Lỗi khi lấy ảnh cho product_id = $id: " . $this->_conn->MySQLi()->error);
            return 0; // Trả về 0 nếu có lỗi
        }
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
        try {
            $sql = "UPDATE $this->table SET ";
            foreach ($data as $key => $value) {
                $sql .= "$key = '$value', ";
            }
            $sql = rtrim($sql, ", ");

            $sql .= " WHERE $this->id=$id";

            if (!empty($data['images'])) {
                // Nếu có ảnh, lưu vào bảng comment_images
                $images = explode(',', $data['images']);
                foreach ($images as $image) {
                    $this->updateImage($id, $image);
                }
            }
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật dữ liệu: ' . $th->getMessage(), 0);
            return false;
        }

        return $stmt->affected_rows > 0;
    }
    public function updateImage($commentId, $imageUrl)
    {
        // Tạo câu truy vấn SQL
        $sql = "UPDATE comment_images SET image_url = '$imageUrl' WHERE comment_id = $commentId";

        // Thực thi câu truy vấn
        if ($this->_conn->MySQLi()->query($sql)) {
            // Kiểm tra số bản ghi bị ảnh hưởng
            if ($this->_conn->MySQLi()->affected_rows > 0) {
                echo "Cập nhật thành công!";
            } else {
                echo "Không có bản ghi nào được cập nhật. Kiểm tra comment_id.";
            }
        } else {
            echo "Lỗi thực thi truy vấn: " . $this->_conn->MySQLi()->error;
        }
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

    public function getCountCommentByProductID($id)
    {
        $result = 0;
        try {
            $id = (int)$id; // Đảm bảo id là số nguyên
            $sql = "SELECT COUNT(*) AS total_comments FROM comments WHERE product_id = ?";

            // Thực hiện truy vấn với prepared statement
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);  // Bảo vệ chống SQL Injection

            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result['total_comments'] ?? 0; // Trả về tổng số bình luận
        } catch (\Throwable $th) {
            error_log('Error fetching comment count: ' . $th->getMessage());
            return 0; // Nếu có lỗi, trả về 0
        }
    }

    // public function getCommentsByProductId($id)
    // {
    //     $result = [];
    //     $sql = "SELECT * FROM comments WHERE product_id = " .$id;
    //     // SELECT comments.*, products.name AS product_name FROM comments INNER JOIN products ON comments.product_id = products.id WHERE comments.product_id = 1;
    //     $query = $this->_conn->MySQLi()->query($sql);
    //     if ($query) {
    //         $result = $query->fetch_all(MYSQLI_ASSOC);
    //         foreach ($result as &$comment) {
    //             // Format dates
    //             if (isset($comment['created_at'])) {
    //                 $comment['created_at'] = $this->formatDate($comment['created_at']);
    //             }
    //             if (isset($comment['updated_at'])) {
    //                 $comment['updated_at'] = $this->formatDate($comment['updated_at']);
    //             }

    //             // Get images for each comment
    //             $comment_id = $comment['id'];
    //             $comment['images'] = $this->getCommentImages($comment_id); // Call function to get images

    //         }

    //         // Fetch product comment count (total comments for the specific product)
    //         $countComments = $this->getProductsWithCommentCount(); // Call function to get all products with their comment count
    //         foreach ($countComments as $product) {
    //             if ($product['product_id'] == $id) {
    //                 $result['total_comments'] = $product['total_comments']; // Assign the total_comments count for this specific product
    //                 break; // Stop loop once the relevant product is found
    //             }
    //         }
    //     } else {
    //         error_log("Error executing query: " . $this->_conn->MySQLi()->error);
    //     }

    //     return $result; } 

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
            // $product['comments'] = $this->getCommentsByProductId($id);
        }

        return $product;
    }
}
