<?php

namespace App\Models\Client;

use App\Helpers\NotificationHelper;
use App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = 'Users';
    protected $id = 'id';

    public function getAllUser()
    {
        return $this->getAll();
    }
    public function getOneUser($id)
    {
        return $this->getOne($id);
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
    public function getOneUserByEmail(string $email)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM users WHERE email=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            // fetch_assoc có tồn tại hay không thì sẽ lấy thằng đầu tiên luôn
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy dữ liệu email: ' . $th->getMessage());
            // thất bại thì trả về mảng rỗng
            return $result;
        }
    }
    public function updateResetToken($email, $token, $expires)
    {
        try {
            $sql = "UPDATE users SET reset_token = ?, reset_token_expires = ? WHERE email = ?";
            $stmt = $this->_conn->MySQLi()->prepare($sql);

            if (!$stmt) {
                error_log("Lỗi chuẩn bị truy vấn: " . $this->_conn->MySQLi()->error);
                return false;
            }

            $stmt->bind_param('sss', $token, $expires, $email);

            if (!$stmt->execute()) {
                error_log("Lỗi thực thi truy vấn: " . $stmt->error);
                return false;
            }

            return $stmt->affected_rows > 0;
        } catch (\Throwable $th) {
            error_log("Lỗi khi cập nhật reset token: " . $th->getMessage());
            return false;
        }
    }




    public function findUserByResetToken($token)
    {
        $sql = "SELECT * FROM users WHERE reset_token = ? AND reset_token_expires > NOW()";
        $stmt = $this->_conn->MySQLi()->prepare($sql);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function updatePasswordByEmail($email, $password)
    {
        // Check if the database connection is initialized
        if ($this->_conn === null) {
            error_log("Database connection is not initialized.");
            return false;
        }

        $mysqli = $this->_conn->MySQLi();

        // Check if the connection is alive
        if (!$mysqli->ping()) {
            error_log("MySQL connection is not alive.");
            return false;
        }

        $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expires = NULL WHERE email = ?";
        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            error_log("Failed to prepare statement: " . $mysqli->error);
            return false;
        }

        $stmt->bind_param('ss', $password, $email);

        if (!$stmt->execute()) {
            error_log("Failed to execute statement: " . $stmt->error);
            return false;
        }

        return $stmt->affected_rows > 0;
    }
}
