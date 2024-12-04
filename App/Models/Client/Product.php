<?php

namespace App\Models\Client;

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
    public function createProduct($data)
    {
        return $this->create($data);
    }
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }
    // Lấy theo type là đơn giản hay biến thể để hiển thị
    public function getProductsWithVariants($offset = 0, $itemsPerPage = 12)
    {
        try {
            $sql = "
        SELECT 
            p.id AS product_id, 
            p.name AS product_name, 
            p.type, 
            p.image, 
            p.price AS product_price, 
            p.discount_price AS product_discount_price,
            p.thumbnails,
            s.id AS sku_id, 
            s.name AS sku_name, 
            s.price AS sku_price, 
            s.discount_price AS sku_discount_price, 
            s.image AS sku_image
        FROM products p
        LEFT JOIN skus s ON p.id = s.product_variant_id
        WHERE p.status = 1
        LIMIT ? OFFSET ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $itemsPerPage, $offset);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching products with variants: ' . $th->getMessage());
            return [];
        }
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

    public function getFilteredProducts($priceRange, $originFilter, $orderBy, $direction, $offset, $itemsPerPage)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE status = 1";

            $params = [];
            $types = "";

            // Lọc theo khoảng giá
            if (!empty($priceRange)) {
                $sql .= " AND price BETWEEN ? AND ?";
                $params[] = $priceRange[0];
                $params[] = $priceRange[1];
                $types .= "ii";
            }

            // Lọc theo xuất xứ
            if (!empty($originFilter)) {
                $placeholders = implode(',', array_fill(0, count($originFilter), '?'));
                $sql .= " AND origin IN ($placeholders)";
                $params = array_merge($params, $originFilter);
                $types .= str_repeat("s", count($originFilter));
            }

            // Sắp xếp
            $sql .= " ORDER BY $orderBy $direction LIMIT ? OFFSET ?";
            $params[] = $itemsPerPage;
            $params[] = $offset;
            $types .= "ii";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception('Lỗi prepare: ' . $conn->error);
            }

            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching filtered products: ' . $th->getMessage());
            return [];
        }
    }



    public function getTotalFilteredProductCount($priceRange, $originFilter)
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM products WHERE status = 1"; // Thêm điều kiện WHERE nếu cần

            // Lọc theo khoảng giá
            if (!empty($priceRange)) {
                $sql .= " AND price BETWEEN ? AND ?";
            }

            // Lọc theo xuất xứ
            if (!empty($originFilter)) {
                $placeholders = implode(',', array_fill(0, count($originFilter), '?'));
                $sql .= " AND origin IN ($placeholders)";
            }

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $params = [];
            $types = "";

            if (!empty($priceRange)) {
                $params[] = $priceRange[0];
                $params[] = $priceRange[1];
                $types .= "ii";
            }
            if (!empty($originFilter)) {
                foreach ($originFilter as $origin) {
                    $params[] = $origin;
                    $types .= "s";
                }
            }

            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result['total'] ?? 0;
        } catch (\Throwable $th) {
            error_log('Error counting filtered products: ' . $th->getMessage());
            return 0;
        }
    }




    public function getAllFeaturedProducts()
    {
        try {
            $sql = "SELECT products.*, categories.name AS category_name 
FROM products 
INNER JOIN categories ON products.category_id = categories.id 
WHERE products.is_featured = 1 
  AND products.status = 1 
  AND categories.status = 1 
ORDER BY products.updated_at DESC, products.created_at DESC 
LIMIT 12;
"; // Lấy 12 sản phẩm nổi bật mới nhất

            $result = $this->_conn->MySQLi()->query($sql);

            if ($result === false) {
                throw new \Exception($this->_conn->MySQLi()->error);
            }

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị sản phẩm nổi bật: ' . $th->getMessage());
            return [];
        }
    }

    public function getVariantsByProductId($id)
    {
        $mysqli = $this->_conn->MySQLi();

        // Query to get variants and their options
        $query = "
        SELECT 
            pv.id AS variant_id, 
            pv.name AS variant_name, 
            pvo.id AS option_id, 
            pvo.name AS option_name 
        FROM product_variants pv
        LEFT JOIN product_variant_options pvo ON pv.id = pvo.product_variant_id
        WHERE pv.product_id = ?
    ";

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $id); // Ràng buộc tham số `id`
        $stmt->execute();

        $result = $stmt->get_result();

        $variants = [];
        while ($row = $result->fetch_assoc()) {
            $variantId = $row['variant_id'];
            if (!isset($variants[$variantId])) {
                $variants[$variantId] = [
                    'id' => $row['variant_id'],
                    'name' => $row['variant_name'],
                    'options' => [],
                ];
            }
            if ($row['option_id'] && $row['option_name']) {
                $variants[$variantId]['options'][] = [
                    'id' => $row['option_id'],
                    'name' => $row['option_name'],
                ];
            }
        }

        return array_values($variants); // Reset array keys
    }
    public function isVariantExist($variant_id, $sku_id)
    {
        $mysqli = $this->_conn->MySQLi();

        // Validate the relationship between variant and SKU
        $query = "SELECT pv.id FROM product_variants pv
                  JOIN skus s ON pv.id = s.product_variant_id
                  WHERE pv.id = ? AND s.id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ii', $variant_id, $sku_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Log the number of rows found
        $rows = $result->num_rows;
        error_log("Validation for Variant ID: $variant_id and SKU ID: $sku_id. Rows found: $rows");

        return $rows > 0; // Return true if association exists
    }
    // Phân trang
    // Lấy sản phẩm bằng cách phân trang:

    // Lấy tổng số sản phẩm:
    public function getTotalProductCount()
    {
        $result = 0;
        try {
            $conn = $this->_conn->MySQLi();
            $sql = "SELECT COUNT(*) AS total FROM " . $this->table . " WHERE status = 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm tổng số sản phẩm: ' . $th->getMessage());
        }

        return $result['total'] ?? 0;
    }
    // Lọc
    public function getProductsSortedAndPaginated($orderBy = 'id', $direction = 'ASC', $offset = 0, $limit = 12)
    {
        $result = [];
        try {
            $conn = $this->_conn->MySQLi();
            $sql = "SELECT * FROM " . $this->table . " ORDER BY $orderBy $direction LIMIT ?, ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $offset, $limit);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error fetching sorted and paginated products: ' . $th->getMessage());
        }
        return $result;
    }

    // Đếm sản phẩm 
    public function countProductsByStatus($status = '1')
    {
        $count = 0;
        try {
            $conn = $this->_conn->MySQLi();
            $sql = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE status = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $status);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $count = $result['total'] ?? 0;
        } catch (\Throwable $th) {
            error_log('Error counting products: ' . $th->getMessage());
        }
        return $count;
    }
    // macdinhdeyailsku
    public function getDefaultSkuByProductId($productId)
    {
        try {
            $sql = "SELECT * FROM skus 
                    WHERE product_variant_id IN (
                        SELECT id FROM product_variants WHERE product_id = ?
                    ) AND status = 1 LIMIT 1";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Lỗi prepare statement: " . $conn->error);
            }

            $stmt->bind_param('i', $productId);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy SKU mặc định: ' . $th->getMessage());
            return [];
        }
    }
}
