<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $table = 'categories';
    protected $id = 'id';

    public function getAllCategory()
    {
        return $this->getAll();
    }
    public function getOneCategory($id)
    {
        return $this->getOne($id);
    }
    public function countCategory()
{
    $result = [];
    try {
        $sql = "SELECT COUNT(*) AS total_category FROM categories";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
    } catch (\Throwable $th) {
        error_log('Lỗi khi đếm số sản phẩm: ' . $th->getMessage());
    }
    return $result['total_category'] ?? 0;
}
    public function createCategory($data)
    {
        return $this->create($data);
    }
    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
    public function getAllCategoryByStatus()
    {
        return $this->getAllByStatus();
    }
}
