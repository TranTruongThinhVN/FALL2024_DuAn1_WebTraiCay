<?php

namespace App\Models\Client;

use App\Models\BaseModel;

class Checkout extends BaseModel
{
    protected $table = 'checkout_address';
    protected $id = 'id';

    public function getAllCheckout()
    {
        return $this->getAll();
    }
    public function getOneCheckout($id)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM checkout_address WHERE id = ?";
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
}
