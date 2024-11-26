<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class Order extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';

    public function getAllOrder()
    {
        return $this->getAll();
    }

    public function getOneOrder($id)
    {
        return $this->getOne($id);
    }

    public function createOrder($data)
    {
        return $this->create($data);
    }

    public function updateOrder($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteOrder($id)
    {
        return $this->delete($id);
    }

    public function getAllOrderByStatus()
    {
        return $this->getAllByStatus();
    }

    public function getOrdersWithPagination($currentPage, $perPage)
    {
        $offset = ($currentPage - 1) * $perPage; // Tính offset từ trang hiện tại

        try {
            // Gắn trực tiếp giá trị LIMIT và OFFSET vào câu truy vấn
            $sql = "SELECT * FROM $this->table LIMIT $perPage OFFSET $offset";

            // Thực thi truy vấn
            $result = $this->_conn->MySQLi()->query($sql);

            // Kiểm tra và trả về dữ liệu
            if ($result) {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                return $data;
            }

            // Nếu truy vấn thất bại, trả về mảng rỗng
            return [];
        } catch (\Throwable $th) {
            // Ghi lỗi vào log nếu có lỗi xảy ra
            error_log('Lỗi khi phân trang: ' . $th->getMessage());
            return [];
        }
    }

    public function countOrders()
    {
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);

            if ($result) {
                $total = $result->fetch_assoc()['total'];
                return (int)$total;
            }

            return 0; // Trả về 0 nếu truy vấn thất bại
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm số đơn hàng: ' . $th->getMessage());
            return 0;
        }
    }
}
