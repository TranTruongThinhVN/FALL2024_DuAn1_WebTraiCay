<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class ProductVariant extends BaseModel
{
    protected $table = 'product_variants';
    protected $id = 'id';

    public function getAllVariants()
    {
        return $this->getAll();
    }

    public function getAllVariantsWithOptions()
    {
        try {
            $sql = "SELECT 
            pv.id AS variant_id, 
            pv.name AS variant_name, 
            GROUP_CONCAT(o.name SEPARATOR ', ') AS options
        FROM 
            product_variants pv
        LEFT JOIN 
            product_variant_options o ON pv.id = o.product_variant_id
        GROUP BY 
            pv.id, pv.name";

            $conn = $this->_conn->MySQLi();
            $conn->query("SET SESSION group_concat_max_len = 10000"); // Đặt giới hạn độ dài cho GROUP_CONCAT
            $stmt = $conn->prepare($sql);
            $stmt->execute();


            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // Debug dữ liệu
            error_log(print_r($result, true));

            return $result;
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy biến thể và tùy chọn: ' . $th->getMessage());
            return [];
        }
    }

    public function getOneProductVariant($id)
    {
        return $this->getOne($id);
    }


    public function createVariant($data)
    {
        $sql = "INSERT INTO product_variants (name) VALUES (?)";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $data['name']);

        if ($stmt->execute()) {
            return $stmt->insert_id; // Trả về ID của biến thể vừa thêm
        } else {
            error_log("Error inserting variant: " . $conn->error);
            return false;
        }
    }


    public function updateVariant($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteVariant($id)
    {
        return $this->delete($id);
    }
    public function getOneProductVariantByName($name)
    {
        return $this->getOneByName($name);
    }
    public function getOneProductVariantByNameExceptId($name, $id)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE name = ? AND id != ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $name, $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi kiểm tra tên biến thể (trừ ID): ' . $th->getMessage());
            return null;
        }
    }
}
