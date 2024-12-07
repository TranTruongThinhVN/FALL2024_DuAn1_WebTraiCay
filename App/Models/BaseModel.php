<?php

namespace App\Models;

use DateTime;
use App\Helpers\NotificationHelper;
use App\Interfaces\CrudInterface;
use Exception;

abstract class BaseModel implements CrudInterface
{
    protected $_conn;

    protected $table;
    protected $id;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;


    public function __construct()
    {
        $this->_conn = new Database();
    }
    public function formatDate($dateString, $format =  ('d-m-Y H:i:s '))
    {
        try {
            $date = new DateTime($dateString);
            return $date->format($format);
        } catch (Exception $e) {
            error_log("Lỗi định dạng ngày: " . $e->getMessage());
            return false; // Trả về false nếu có lỗi 
        }
    }
    public function getAll()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOne(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->id=?";
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
    public function create(array $data)
    {
        // $sql ="INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')";

        // $result = $this->_conn->connect()->query($sql);
        // return $result;

        try {
            $sql = "INSERT INTO $this->table (";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
            }
            // INSERT INTO $this->table (name, description, status, 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status
            $sql .=   " ) VALUES (";
            // INSERT INTO $this->table (name, description, status) VALUES (
            foreach ($data as $key => $value) {
                $sql .= "'$value', ";
            }

            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1', 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1'

            $sql .= ")";
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            return $stmt->execute();
            // return $stmt->insert_id; // Trả về ID của bản ghi mới
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    public function update(int $id, array $data)
    {
        try {
            $sql = "UPDATE $this->table SET ";
            foreach ($data as $key => $value) {
                $sql .= "$key = '$value', ";
            }
            $sql = rtrim($sql, ", ");

            $sql .= " WHERE $this->id=$id";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật dữ liệu: ' . $th->getMessage(), 0);
            return false;
        }
    }
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM $this->table WHERE $this->id=$id";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // trả về số hàng dữ liệu bị ảnh hưởng
            return $stmt->affected_rows;
        } catch (\Throwable $th) {
            error_log('Lỗi khi xóa dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function getAllByStatus()
    {
        $sql = "SELECT * FROM $this->table WHERE status=" . self::STATUS_ENABLE;
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getOneByName($name)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE name = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $name);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy bằng tên: ' . $th->getMessage());
            return $result;
        }
    }
    public function countOrders()
    {
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);

            if ($result) {
                $total = $result->fetch_assoc()['total'];
                return (int) $total;
            }

            return 0; // Trả về 0 nếu truy vấn thất bại
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm số đơn hàng: ' . $th->getMessage());
            return 0;
        }
    }
    public function getOrderById($id)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            }

            return null;
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy đơn hàng: ' . $th->getMessage());
            return null;
        }
    }
    public function updatePaymentStatus($id, $status)
    {
        try {
            $mysqli = $this->_conn->MySQLi();
            $sql = "UPDATE $this->table SET payment_status = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $status, $id);
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật trạng thái thanh toán: ' . $th->getMessage());
            return false;
        }
    }
    public function createOrder($data)
    {

        try {
            $mysqli = $this->_conn->MySQLi();



            $sql = "INSERT INTO $this->table 
                    (order_date, total_price, name, address, phone, order_status, payment_method, shipping_method, payment_status, user_id)
                    VALUES (CURRENT_TIMESTAMP, ?, ?, ?, ?, 0, ?, ?, 0, ?)";

            $stmt = $mysqli->prepare($sql);

            $stmt->bind_param(
                "dsssssi",
                $data['total'],
                $data['fullName'],
                $data['address'],
                $data['phoneNumber'],
                $data['paymentMethod'],
                $data['deliveryMethod'],
                $data['userId']
            );

            if ($stmt->execute()) {
                $insertedId = $mysqli->insert_id;
                if ($insertedId > 0) {
                    return $insertedId;
                } else {
                    error_log("Insert ID is 0, check AUTO_INCREMENT field.");
                    return false;
                }
            } else {
                error_log("Failed to execute statement: " . $stmt->error);
                return false;
            }
        } catch (\Throwable $th) {
            error_log('Lỗi khi tạo đơn hàng: ' . $th->getMessage());
            return false;
        }
    }
}
