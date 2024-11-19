<?php

namespace App\Models;

class Comment extends BaseModel
{
    protected $table = 'comments';
    protected $id = 'id';

    public function getAllComment()
    {
        return $this->getAll();
    }
    public function getOneComment($id)
    {
        return $this->getOne($id);
    }

    public function createComment($data)
    {
        return $this->create($data);
    }
    public function updateComment($id, $data)
{
    $sql = "UPDATE comments SET content = ?, status = ?, update_at = ? WHERE id = ?";
    
    $stmt = $this->_conn->MySQLi()->prepare($sql);
    $stmt->bind_param("sssi", $data['content'], $data['status'], $data['update_at'], $id);
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

    
    




    public function deleteComment(int $id): bool {
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
    public function getAllCommentJoinProductAndUser()
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
        LIMIT 0, 25"; 
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
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
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
        
    } catch (\Throwable $th) {
        error_log('Lỗi khi lấy danh sách sản phẩm với tổng bình luận: ' . $th->getMessage());
        return $result;
    }
}






}

