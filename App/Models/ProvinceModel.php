<?php

namespace App\Models;

use App\Models\BaseModel;

class ProvinceModel extends BaseModel
{
    protected $table;

    public function insertProvince($data)
    {
        $this->table = 'provinces';
        return $this->create($data);
    }

    public function insertDistrict($data)
    {
        $this->table = 'districts';
        return $this->create($data);
    }

    public function insertWard($data)
    {
        // Sử dụng PDO để thêm dữ liệu vào bảng wards
        $sql = 'INSERT INTO wards (id, name, district_id) VALUES (?, ?, ?)';
        $conn = $this->_conn->Pdo(); // Sử dụng PDO để kết nối database
        $stmt = $conn->prepare($sql);

        // Binding tham số và thực thi câu lệnh SQL
        $stmt->bindParam(1, $data['id'], \PDO::PARAM_INT);
        $stmt->bindParam(2, $data['name'], \PDO::PARAM_STR);
        $stmt->bindParam(3, $data['district_id'], \PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getAllDistrict()
    {
        $this->table = 'districts';
        return $this->getAll();
    }
}
