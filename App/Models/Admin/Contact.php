<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class Contact extends BaseModel
{
    protected $table = 'contacts';
    protected $id = 'id';

    // Lấy tất cả liên hệ
    public function getAllContacts($search = null)
    {
        try {
            $sql = "SELECT * FROM $this->table";
            if ($search) {
                $sql .= " WHERE name LIKE ? OR email LIKE ? OR phone LIKE ?";
                $conn = $this->_conn->MySQLi();
                $stmt = $conn->prepare($sql);
                $searchTerm = '%' . $search . '%';
                $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);
                $stmt->execute();
                return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            } else {
                return $this->getAll();
            }
        } catch (\Throwable $th) {
            error_log('Error fetching contacts: ' . $th->getMessage());
            return [];
        }
    }

    // Lấy một liên hệ cụ thể
    public function getOneContact($id)
    {
        return $this->getOne($id);
    }
    public function updateContactStatus($id, $status)
    {
        $data = ['status' => $status];
        return $this->update($id, $data);
    }

    // Xóa liên hệ
    public function deleteContact($id)
    {
        return $this->delete($id);
    }
    // 

}
