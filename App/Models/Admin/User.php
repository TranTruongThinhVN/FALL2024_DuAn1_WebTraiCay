<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = 'users';
    protected $id = 'id';

    public function getAllUser()
    {
        return $this->getAll();
    }

    public function getOneUser($id)
    {
        return $this->getOne($id);
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
}
