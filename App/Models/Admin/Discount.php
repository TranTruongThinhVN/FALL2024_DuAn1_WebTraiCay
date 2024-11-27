<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class Discount extends BaseModel
{
    protected $table = 'discounts';
    protected $id = 'id';

    public function getAllDiscounts()
    {
        return $this->getAll();
    }
    public function getOneDiscounts($id)
    {
        return $this->getOne($id);
    }

    public function createDiscounts($data)
    {
        return $this->create($data);
    }
    public function updateDiscounts($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteDiscounts($id)
    {
        return $this->delete($id);
    }
    public function getAllDiscountsByStatus()
    {
        return $this->getAllByStatus();
    }
    public function getDiscountByCode($code)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM discounts WHERE code = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $code);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy bằng tên: ' . $th->getMessage());
            return $result;
        }
    }
    public function searchDiscounts($keyword)
    {
        try {
            $sql = "SELECT * FROM discounts WHERE code LIKE ? OR description LIKE ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Sử dụng `%` để tìm kiếm toàn bộ chuỗi
            $likeKeyword = '%' . $keyword . '%';
            $stmt->bind_param('ss', $likeKeyword, $likeKeyword);

            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi tìm kiếm: ' . $th->getMessage());
            return [];
        }
    }
    public function getFilteredDiscounts($filters)
    {
        $sql = "SELECT * FROM discounts WHERE 1=1";
        $params = [];

        // Lọc theo loại giảm giá
        if (!empty($filters['discount_type'])) {
            $sql .= " AND discount_type = ?";
            $params[] = $filters['discount_type'];
        }

        // Tìm kiếm theo mã hoặc mô tả
        if (!empty($filters['search'])) {
            $sql .= " AND (code LIKE ? OR description LIKE ?)";
            $params[] = '%' . $filters['search'] . '%';
            $params[] = '%' . $filters['search'] . '%';
        }

        // Kết nối và thực thi truy vấn
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
