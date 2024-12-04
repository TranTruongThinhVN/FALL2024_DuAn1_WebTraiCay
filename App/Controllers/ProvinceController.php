<?php

namespace App\Controllers;

use App\Models\ProvinceModel;

class ProvinceController
{
    protected $provinceModel;

    public function __construct()
    {
        $this->provinceModel = new ProvinceModel();
    }

    // Lấy danh sách tỉnh thành từ API và lưu vào cơ sở dữ liệu
    public function fetchProvinces()
    {
        // API lấy dữ liệu các tỉnh thành
        $provinceUrl = "https://open.oapi.vn/location/provinces?page=0&size=30";

        // Thực hiện gọi API để lấy dữ liệu tỉnh thành
        $data = file_get_contents($provinceUrl);
        if ($data === false) {
            return json_encode(['error' => 'Lỗi khi gọi API tỉnh thành']);
        }

        $provinces = json_decode($data, true)['data'];

        if (empty($provinces)) {
            return json_encode(['error' => 'Không có dữ liệu tỉnh thành']);
        }

        // Lưu dữ liệu vào cơ sở dữ liệu
        foreach ($provinces as $province) {
            $provinceData = [
                'id' => $province['id'],
                'name' => $province['name'],
                // Thêm các trường cần thiết khác từ API nếu có
            ];
            $this->provinceModel->insertProvince($provinceData);
        }

        return json_encode(['success' => 'Dữ liệu tỉnh thành đã được lưu']);
    }

    // Lấy danh sách quận/huyện của tỉnh thành
    public function fetchDistricts($provinceId)
    {
        // API lấy dữ liệu quận/huyện của tỉnh thành
        $districtUrl = "https://open.oapi.vn/location/districts/{$provinceId}?page=0&size=30";

        // Thực hiện gọi API để lấy dữ liệu quận/huyện
        $data = file_get_contents($districtUrl);
        if ($data === false) {
            return json_encode(['error' => 'Lỗi khi gọi API quận/huyện']);
        }

        $districts = json_decode($data, true)['data'];

        if (empty($districts)) {
            return json_encode(['error' => 'Không có dữ liệu quận/huyện']);
        }

        // Lưu dữ liệu vào cơ sở dữ liệu
        foreach ($districts as $district) {
            $districtData = [
                'id' => $district['id'],
                'name' => $district['name'],
                'province_id' => $provinceId, // Lưu ID của tỉnh thành để liên kết
            ];
            $this->provinceModel->insertDistrict($districtData);
        }

        return json_encode(['success' => 'Dữ liệu quận/huyện đã được lưu']);
    }

    // Lấy danh sách phường/xã của quận/huyện
    public function fetchWards($districtId)
    {
        // API lấy dữ liệu phường/xã của quận/huyện
        $wardUrl = "https://open.oapi.vn/location/wards/{$districtId}?page=0&size=30";

        // Thực hiện gọi API để lấy dữ liệu phường/xã
        $data = file_get_contents($wardUrl);
        if ($data === false) {
            return json_encode(['error' => 'Lỗi khi gọi API phường/xã']);
        }

        $wards = json_decode($data, true)['data'];

        if (empty($wards)) {
            return json_encode(['error' => 'Không có dữ liệu phường/xã']);
        }

        // Lưu dữ liệu vào cơ sở dữ liệu
        foreach ($wards as $ward) {
            $wardData = [
                'id' => $ward['id'],
                'name' => $ward['name'],
                'district_id' => $districtId, // Lưu ID của quận/huyện để liên kết
            ];
            $this->provinceModel->insertWard($wardData);
        }

        return json_encode(['success' => 'Dữ liệu phường/xã đã được lưu']);
    }

    // Lấy tất cả quận/huyện từ cơ sở dữ liệu
    public function getAllDistricts()
    {
        $districts = $this->provinceModel->getAllDistrict();
        return json_encode(['districts' => $districts]);
    }
}
