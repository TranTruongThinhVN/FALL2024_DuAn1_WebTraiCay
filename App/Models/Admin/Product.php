<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

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
        try {
            $sql = "SELECT products.*, categories.name AS category_name
                    FROM products
                    INNER JOIN categories ON products.category_id = categories.id
                    WHERE products.id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if ($product) {
                // Nếu thumbnails null, gán giá trị mặc định
                $product['thumbnails'] = $product['thumbnails'] ?? json_encode([]);
            }

            return $product;
        } catch (\Throwable $th) {
            error_log('Error fetching product details: ' . $th->getMessage());
            return null;
        }
    }


    public $thumbnails;

    public function createProduct($data)
    {
        return $this->create($data);
        // return $this->update($id, $data);
    }




    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete($id);
    }
    // public function getAllProductByStatus()
    // {
    //     $result = [];
    //     try {
    //         $sql = "SELECT products.* FROM products INNER JOIN categories
    //      ON products.category_id=categories.id WHERE products.status=" . self::STATUS_ENABLE . " AND categories.status=" . self::STATUS_ENABLE;
    //         $result = $this->_conn->MySQLi()->query($sql);
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } catch (\Throwable $th) {
    //         error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
    //         return $result;
    //     }
    // }
    public function getOneProductByName($name)
    {
        return $this->getOneByName($name);
    }

    public function getProductsByPage($limit, $offset)
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name 
                FROM products 
                INNER JOIN categories ON products.category_id = categories.id 
                ORDER BY products.created_at ASC 
                LIMIT ? OFFSET ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("ii", $limit, $offset);
            $stmt->execute();

            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching products with pagination: ' . $th->getMessage());
            return false; // Return false on failure
        }
        return $result;
    }


    public function getTotalProducts()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM products";

            $conn = $this->_conn->MySQLi();
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['total'];
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm tổng số sản phẩm: ' . $th->getMessage());
            return 0;
        }
    }
    public function searchByName($keyword)
    {
        try {
            // Lấy kết nối MySQLi từ lớp Database
            $conn = $this->_conn->MySQLi();

            // Kiểm tra kết nối
            if (!$conn->ping()) {
                error_log("Connection lost. Reconnecting...");
                $conn = $this->_conn->MySQLi(); // Tái kết nối
            }

            // Câu lệnh SQL
            $sql = "SELECT products.*, categories.name AS category_name
                    FROM products
                    INNER JOIN categories ON products.category_id = categories.id
                    WHERE products.name LIKE ?";

            // Chuẩn bị truy vấn
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new \Exception("Prepare statement failed: " . $conn->error);
            }

            $searchTerm = "%" . $keyword . "%";
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();

            $result = $stmt->get_result();
            if (!$result) {
                throw new \Exception("Query execution failed: " . $conn->error);
            }

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error searching products: ' . $th->getMessage());
            return [];
        }
    }

    public function getFilteredProducts($keyword, $category_id, $status, $limit, $offset)
    {
        try {
            $sql = "SELECT products.*, categories.name AS category_name
                    FROM products
                    INNER JOIN categories ON products.category_id = categories.id
                    WHERE 1=1";

            $params = [];
            $types = "";

            // Áp dụng từ khóa tìm kiếm
            if (!empty($keyword)) {
                $sql .= " AND products.name LIKE ?";
                $params[] = "%" . $keyword . "%";
                $types .= "s";
            }

            // Áp dụng lọc theo danh mục
            if (!empty($category_id)) {
                $sql .= " AND products.category_id = ?";
                $params[] = $category_id;
                $types .= "i";
            }

            // Áp dụng lọc theo trạng thái
            if ($status !== '') {
                $sql .= " AND products.status = ?";
                $params[] = $status;
                $types .= "i";
            }

            $sql .= " ORDER BY products.created_at ASC LIMIT ? OFFSET ?";
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
            $result = $stmt->get_result();

            $products = $result->fetch_all(MYSQLI_ASSOC);

            // **Thêm đoạn mã này để tính toán final_price và final_discount_price**
            foreach ($products as &$product) {
                $product['final_price'] = $product['discount_price'] ?? $product['price'] ?? 0;
                $product['final_discount_price'] = $product['discount_price'] ?? 0; // Nếu không có discount_price, mặc định là 0
            }

            return $products; // Trả về mảng products sau khi đã tính toán giá

        } catch (\Throwable $th) {
            error_log('Error fetching filtered products: ' . $th->getMessage());
            return [];
        }
    }
    public function countFilteredProducts($keyword, $category_id, $status)
    {
        try {
            $sql = "SELECT COUNT(*) as total
                    FROM products
                    INNER JOIN categories ON products.category_id = categories.id
                    WHERE 1=1";

            $params = [];
            $types = "";

            // Áp dụng từ khóa tìm kiếm
            if (!empty($keyword)) {
                $sql .= " AND products.name LIKE ?";
                $params[] = "%" . $keyword . "%";
                $types .= "s";
            }

            // Áp dụng lọc theo danh mục
            if (!empty($category_id)) {
                $sql .= " AND products.category_id = ?";
                $params[] = $category_id;
                $types .= "i";
            }

            // Áp dụng lọc theo trạng thái
            if ($status !== '') {
                $sql .= " AND products.status = ?";
                $params[] = $status;
                $types .= "i";
            }

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Prepare statement failed: " . $conn->error);
            }

            // Kiểm tra xem có tham số cần bind không
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            return $row['total'];
        } catch (\Throwable $th) {
            error_log('Error counting filtered products: ' . $th->getMessage());
            return 0;
        }
    }

    public function getTotalRevenue()
    {
        try {
            $sql = "SELECT SUM(price * quantity_sold) as total_revenue FROM {$this->table}";
            $conn = $this->_conn->MySQLi();
            $result = $conn->query($sql);
            return $result->fetch_assoc()['total_revenue'] ?? 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi tính tổng doanh thu: ' . $th->getMessage());
            return 0;
        }
    }

    // Lấy giá trung bình của các sản phẩm
    public function getAveragePrice()
    {
        try {
            $sql = "SELECT AVG(price) as average_price FROM {$this->table}";
            $conn = $this->_conn->MySQLi();
            $result = $conn->query($sql);
            return $result->fetch_assoc()['average_price'] ?? 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi tính giá trung bình: ' . $th->getMessage());
            return 0;
        }
    }

    // Thống kê sản phẩm theo danh mục
    public function getProductsByCategory()
    {
        try {
            $sql = "SELECT categories.name AS category_name, COUNT(*) AS total_products
                    FROM {$this->table}
                    INNER JOIN categories ON {$this->table}.category_id = categories.id
                    GROUP BY categories.name";
            $conn = $this->_conn->MySQLi();
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi thống kê sản phẩm theo danh mục: ' . $th->getMessage());
            return [];
        }
    }

    // Thống kê số lượng bán được của từng sản phẩm
    public function getProductSalesStatistics()
    {
        try {
            $sql = "SELECT name, quantity_sold, price, (quantity_sold * price) AS revenue
                    FROM {$this->table}
                    ORDER BY revenue DESC";
            $conn = $this->_conn->MySQLi();
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi thống kê số lượng bán được: ' . $th->getMessage());
            return [];
        }
    }
}
