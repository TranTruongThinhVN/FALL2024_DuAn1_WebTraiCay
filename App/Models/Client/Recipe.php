<?php

namespace App\Models\Client;

use App\Models\BaseModel;

class Recipe extends BaseModel
{
    protected $table = 'recipes';
    protected $id = 'id';

    /**
     * Lấy tất cả công thức
     */
    public function getAllRecipesByStatus()
    {
        $result = [];
        try {
            $sql = "SELECT recipes.*, recipe_categories.name AS category_name 
        FROM recipes 
        INNER JOIN recipe_categories 
        ON recipes.category_id = recipe_categories.id 
        WHERE recipes.status = " . self::STATUS_ENABLE . " 
        AND recipe_categories.status = " . self::STATUS_ENABLE;

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    /**
     * Lấy thông tin chi tiết công thức theo ID
     */
    public function getOneRecipe($id)
    {
        try {
            $sql = "SELECT recipes.*, recipe_categories.name AS category_name
                    FROM recipes
                    INNER JOIN recipe_categories ON recipes.category_id = recipe_categories.id
                    WHERE recipes.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Error fetching recipe details: ' . $th->getMessage());
            return null;
        }
    }

    /**
     * Tạo công thức mới
     */
    public function createRecipe($data)
    {
        return $this->create($data);
    }

    /**
     * Cập nhật công thức
     */
    public function updateRecipe($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Xóa công thức
     */
    public function deleteRecipe($id)
    {
        return $this->delete($id);
    }

    /**
     * Tìm kiếm công thức theo từ khóa
     */
    public function searchByName($keyword)
    {
        try {
            $sql = "SELECT recipes.*, recipe_categories.name AS category_name
                    FROM recipes
                    INNER JOIN recipe_categories ON recipes.category_id = recipe_categories.id
                    WHERE recipes.title LIKE ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Prepare statement failed: " . $conn->error);
            }

            $searchTerm = "%" . $keyword . "%";
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();

            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error searching recipes: ' . $th->getMessage());
            return [];
        }
    }

    /**
     * Lọc công thức theo từ khóa, danh mục, trạng thái, và phân trang
     */
    public function getFilteredRecipes($keyword, $category_id, $status, $limit, $offset)
    {
        try {
            $sql = "SELECT recipes.*, recipe_categories.name AS category_name
                    FROM recipes
                    INNER JOIN recipe_categories ON recipes.category_id = recipe_categories.id
                    WHERE 1=1";

            $params = [];
            $types = "";

            // Lọc theo từ khóa
            if (!empty($keyword)) {
                $sql .= " AND recipes.title LIKE ?";
                $params[] = "%" . $keyword . "%";
                $types .= "s";
            }

            // Lọc theo danh mục
            if (!empty($category_id)) {
                $sql .= " AND recipes.category_id = ?";
                $params[] = $category_id;
                $types .= "i";
            }

            // Lọc theo trạng thái
            if ($status !== '') {
                $sql .= " AND recipes.status = ?";
                $params[] = $status;
                $types .= "i";
            }

            $sql .= " ORDER BY recipes.created_at DESC LIMIT ? OFFSET ?";
            $params[] = $limit;
            $params[] = $offset;
            $types .= "ii";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Prepare statement failed: " . $conn->error);
            }

            $stmt->bind_param($types, ...$params);
            $stmt->execute();

            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching filtered recipes: ' . $th->getMessage());
            return [];
        }
    }

    /**
     * Đếm tổng số công thức theo bộ lọc
     */
    public function countFilteredRecipes($keyword, $category_id, $status)
    {
        try {
            $sql = "SELECT COUNT(*) as total
                    FROM recipes
                    INNER JOIN recipe_categories ON recipes.category_id = recipe_categories.id
                    WHERE 1=1";

            $params = [];
            $types = "";

            // Lọc theo từ khóa
            if (!empty($keyword)) {
                $sql .= " AND recipes.title LIKE ?";
                $params[] = "%" . $keyword . "%";
                $types .= "s";
            }

            // Lọc theo danh mục
            if (!empty($category_id)) {
                $sql .= " AND recipes.category_id = ?";
                $params[] = $category_id;
                $types .= "i";
            }

            // Lọc theo trạng thái
            if ($status !== '') {
                $sql .= " AND recipes.status = ?";
                $params[] = $status;
                $types .= "i";
            }

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Prepare statement failed: " . $conn->error);
            }

            $stmt->bind_param($types, ...$params);
            $stmt->execute();

            return $stmt->get_result()->fetch_assoc()['total'];
        } catch (\Throwable $th) {
            error_log('Error counting filtered recipes: ' . $th->getMessage());
            return 0;
        }
    }

    public function isTitleExists($title)
    {
        $result = [];
        try {
            // Viết câu truy vấn với tham số
            $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE title=?";

            // Lấy kết nối MySQLi
            $conn = $this->_conn->MySQLi();

            // Chuẩn bị truy vấn
            $stmt = $conn->prepare($sql);

            // Gắn giá trị tham số
            $stmt->bind_param('s', $title); // 's' vì title là chuỗi

            // Thực thi câu truy vấn
            $stmt->execute();

            // Lấy kết quả
            $result = $stmt->get_result()->fetch_assoc();

            // Kiểm tra và trả về kết quả
            return $result['count'] > 0;
        } catch (\Throwable $th) {
            // Log lỗi nếu xảy ra lỗi
            error_log('Lỗi khi kiểm tra tiêu đề: ' . $th->getMessage());
            return false;
        }
    }
    public function getOneRecipeByStatus(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT recipes.*, recipe_categories.name AS category_name
                    FROM recipes
                    INNER JOIN recipe_categories ON recipes.category_id = recipe_categories.id
                    WHERE recipes.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getRecipesByCategory($category_id)
    {
        try {
            $sql = "SELECT recipes.*, recipe_categories.name AS category_name
                FROM recipes
                INNER JOIN recipe_categories ON recipes.category_id = recipe_categories.id
                WHERE recipes.category_id = ? AND recipes.status = " . self::STATUS_ENABLE;
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching recipes by category: ' . $th->getMessage());
            return [];
        }
    }
    public function getLatestRecipesWithCategory($limit = 6)
    {
        try {
            $sql = "SELECT recipes.*, recipe_categories.name AS category_name
                FROM recipes
                INNER JOIN recipe_categories ON recipes.category_id = recipe_categories.id
                WHERE recipes.status = 1 AND recipe_categories.status = 1
                ORDER BY recipes.created_at DESC
                LIMIT ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("i", $limit);
            $stmt->execute();

            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching latest recipes with categories: ' . $th->getMessage());
            return [];
        }
    }
}
