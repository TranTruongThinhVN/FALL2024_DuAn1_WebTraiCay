<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class ProductVariantOption extends BaseModel
{
    protected $table = 'product_variant_options';
    protected $id = 'id';
    private $optionsCache = [];

    public function getOptionsByVariantId($variantId)
    {
        if (isset($this->optionsCache[$variantId])) {
            return $this->optionsCache[$variantId];
        }

        try {
            $sql = "SELECT * FROM product_variant_options WHERE product_variant_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $variantId);
            $stmt->execute();

            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            $this->optionsCache[$variantId] = $result; // Lưu vào cache
            return $result;
        } catch (\Throwable $th) {
            error_log("Lỗi khi lấy giá trị biến thể: " . $th->getMessage());
            return [];
        }
    }






    public function createOption($data)
    {
        $sql = "INSERT INTO product_variant_options (product_variant_id, name) VALUES (?, ?)";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is', $data['product_variant_id'], $data['name']);

        if ($stmt->execute()) {
            return $stmt->insert_id; // Trả về ID của tùy chọn vừa thêm
        } else {
            error_log("Error inserting variant option: " . $conn->error);
            return false;
        }
    }
    public function getOneProductVariantOption($id)
    {
        return $this->getOne($id);
    }

    public function updateOption($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteOption($id)
    {
        return $this->delete($id);
    }
}
