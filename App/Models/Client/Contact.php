<?php

namespace App\Models\Client;

use App\Models\BaseModel;

class Contact extends BaseModel
{
    protected $table = 'contacts';
    protected $id = 'id';

    public function createContact($data)
    {
        return $this->create($data);
    }
    public function saveContact($data)
    {
        return $this->create($data); // Dùng BaseModel để thêm mới
    }

    public function getAllContacts()
    {
        return $this->getAll(); // Lấy tất cả liên hệ
    }

    public function markAsProcessed($id)
    {
        return $this->update($id, ['status' => 1]); // Đánh dấu liên hệ đã xử lý
    }
}
