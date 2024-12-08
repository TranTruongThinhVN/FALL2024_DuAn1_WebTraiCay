<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = 'users';
    protected $id = 'id';

    public function getAllUser()
    {
        $users = $this->getAll(); // Giả sử hàm getAll() lấy danh sách tất cả người dùng
        $totalUsers = $this->countUser(); // Đếm tổng số người dùng 
        $newestUser = $this->getUserNew();

        return [
            'users' => $users,
            'total_users' => $totalUsers,
            'newest_user' => $newestUser,
        ];
    }


    public function getOneUser($id)
    {
        return $this->getOne($id);
    }
    public function countUser()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS total_users FROM users;";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Không cần bind_param vì không có tham số truyền vào
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result['total_users']; // Trả về số lượng
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm số lượng người dùng: ' . $th->getMessage());
            return 0; // Trả về 0 nếu có lỗi
        }
    }


    public function getUserNew()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM users ORDER BY created_at DESC LIMIT 1;";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result; // Trả về thông tin người dùng mới nhất
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy người dùng mới nhất: ' . $th->getMessage());
            return $result; // Trả về mảng rỗng nếu lỗi
        }
    }

    public function getUserById($id)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM {$this->table} WHERE {$this->id} = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                throw new \Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $result;
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy thông tin người dùng theo ID: ' . $th->getMessage());
            return $result;
        }
    }

    public function createUser($data)
    {
        return $this->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    public function getAllUserByStatus()
    {
        return $this->getAllByStatus();
    }

    public function getUsersByPage($limit, $offset)
    {
        try {
            $sql = "SELECT * FROM $this->table LIMIT ? OFFSET ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Gắn giá trị tham số vào truy vấn
            $stmt->bind_param('ii', $limit, $offset);
            $stmt->execute();

            // Trả về kết quả dưới dạng mảng
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi truy vấn danh sách người dùng theo trang: ' . $th->getMessage());
            return [];
        }
    }

    public function getTotalUsers()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM $this->table";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result['total'] ?? 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm tổng số người dùng: ' . $th->getMessage());
            return 0;
        }
    }

    public function countUsersByRole($role)
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE role = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("s", $role);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc()['total'] ?? 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi đếm người dùng theo vai trò: ' . $th->getMessage());
            return 0;
        }
    }
}
