<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class Recipe_category extends BaseModel
{
    protected $table = 'recipe_categories';
    protected $id = 'id';

    public function getAllRecipe_category()
    {
        return $this->getAll();
    }
    public function getOneRecipe_category($id)
    {
        return $this->getOne($id);
    }

    public function createRecipe_category($data)
    {
        return $this->create($data);
    }
    public function updateRecipe_category($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteRecipe_category($id)
    {
        return $this->delete($id);
    }
    public function getAllRecipe_categoryByStatus()
    {
        return $this->getAllByStatus();
    }

    public function getOneRecipe_categoryByName($name)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE name=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Sửa 'i' thành 's' vì $name là chuỗi
            $stmt->bind_param('s', $name);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function searchRecipe_category($keyword)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE name LIKE ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $searchTerm = '%' . $keyword . '%';
            $stmt->bind_param('s', $searchTerm);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Error searching categories: ' . $th->getMessage());
            return [];
        }
    }
}
