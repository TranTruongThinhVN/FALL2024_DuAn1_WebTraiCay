<?php

namespace App\Validations;

use App\Models\Admin\Discount;

class DiscountValidation
{
    public static function create(): bool
    {
        $is_valid = true;
        $_SESSION['errors'] = []; // Khởi tạo mảng lỗi

        // Kiểm tra mã giảm giá
        if (!isset($_POST['code']) || trim($_POST['code']) === '') {
            $_SESSION['errors']['code'] = 'Mã giảm giá không được để trống.';
            $is_valid = false;
        } else {
            $code = trim($_POST['code']);
            if (strlen($code) < 5 || strlen($code) > 15) {
                $_SESSION['errors']['code'] = 'Mã giảm giá phải từ 5 đến 15 ký tự.';
                $is_valid = false;
            }
            if (!preg_match('/^[A-Za-z0-9_-]+$/', $code)) {
                $_SESSION['errors']['code'] = 'Mã giảm giá chỉ được chứa chữ cái, số, gạch ngang (-) và gạch dưới (_).';
                $is_valid = false;
            }

            // Kiểm tra trùng lặp mã giảm giá
            $discountModel = new Discount();
            if ($discountModel->getDiscountByCode($code)) {
                $_SESSION['errors']['code'] = 'Mã giảm giá đã tồn tại, vui lòng nhập mã khác.';
                $is_valid = false;
            }
        }

        // Kiểm tra loại giảm giá
        if (!isset($_POST['discount_type']) || !in_array($_POST['discount_type'], ['1', '2'])) {
            $_SESSION['errors']['discount_type'] = 'Loại giảm giá không hợp lệ.';
            $is_valid = false;
        }

        // Kiểm tra giá trị giảm
        if (!isset($_POST['discount_value']) || trim($_POST['discount_value']) === '') {
            $_SESSION['errors']['discount_value'] = 'Giá trị giảm không được để trống.';
            $is_valid = false;
        } else {
            $discount_value = str_replace(['.', ' VNĐ', '%'], '', $_POST['discount_value']);
            if ($_POST['discount_type'] === '1') {
                // Giảm theo %
                $discount_value = intval($discount_value); // Loại bỏ ký tự % và chuyển thành số nguyên
                if ($discount_value <= 0 || $discount_value > 100) {
                    $_SESSION['errors']['discount_value'] = 'Giá trị phần trăm phải lớn hơn 0 và không vượt quá 100%.';
                    $is_valid = false;
                } else {
                    $_POST['discount_value'] = $discount_value; // Chỉ lưu giá trị số
                }
            } else {
                // Giảm số tiền
                $discount_value = floatval(str_replace(['.', ' VNĐ'], '', $discount_value)); // Loại bỏ định dạng VNĐ
                if ($discount_value <= 0) {
                    $_SESSION['errors']['discount_value'] = 'Giá trị tiền phải lớn hơn 0.';
                    $is_valid = false;
                } else {
                    $_POST['discount_value'] = $discount_value; // Chỉ lưu giá trị số
                }
            }
        }

        // Kiểm tra giá trị đơn tối thiểu
        if (!isset($_POST['min_order_value']) || trim($_POST['min_order_value']) === '') {
            $_SESSION['errors']['min_order_value'] = 'Giá trị đơn tối thiểu không được để trống.';
            $is_valid = false;
        } else {
            // Loại bỏ các ký tự không phải số, như dấu chấm, dấu phẩy, và "VNĐ"
            $min_order_value = str_replace(['.', ',', ' VNĐ'], '', $_POST['min_order_value']);

            // Kiểm tra xem có phải là số hợp lệ không
            if (!is_numeric($min_order_value) || floatval($min_order_value) <= 0) {
                $_SESSION['errors']['min_order_value'] = 'Giá trị đơn tối thiểu phải là số lớn hơn 0.';
                $is_valid = false;
            } else {
                // Nếu hợp lệ, chuyển giá trị thành kiểu số thực (float) và gán lại vào $_POST để lưu
                $_POST['min_order_value'] = floatval($min_order_value);
            }
        }


        // Kiểm tra ngày bắt đầu
        if (!isset($_POST['start_date']) || trim($_POST['start_date']) === '') {
            $_SESSION['errors']['start_date'] = 'Ngày bắt đầu không được để trống.';
            $is_valid = false;
        } elseif (!strtotime($_POST['start_date'])) {
            $_SESSION['errors']['start_date'] = 'Ngày bắt đầu không hợp lệ.';
            $is_valid = false;
        }

        // Kiểm tra ngày kết thúc
        if (!isset($_POST['end_date']) || trim($_POST['end_date']) === '') {
            $_SESSION['errors']['end_date'] = 'Ngày kết thúc không được để trống.';
            $is_valid = false;
        } elseif (!strtotime($_POST['end_date'])) {
            $_SESSION['errors']['end_date'] = 'Ngày kết thúc không hợp lệ.';
            $is_valid = false;
        }

        // Kiểm tra logic ngày bắt đầu < ngày kết thúc
        if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
            $startDate = strtotime($_POST['start_date']);
            $endDate = strtotime($_POST['end_date']);
            if ($startDate >= $endDate) {
                $_SESSION['errors']['end_date'] = 'Ngày kết thúc phải sau ngày bắt đầu.';
                $is_valid = false;
            }
        }

        // Kiểm tra trạng thái
        if (!isset($_POST['status']) || !in_array($_POST['status'], ['1', '0'])) {
            $_SESSION['errors']['status'] = 'Trạng thái không hợp lệ.';
            $is_valid = false;
        }

        return $is_valid;
    }

    public static function edit($id): bool
    {
        $is_valid = true;
        $_SESSION['errors'] = []; // Khởi tạo mảng lỗi

        // Kiểm tra mã giảm giá
        // Kiểm tra mã giảm giá
        if (!isset($_POST['code']) || trim($_POST['code']) === '') {
            $_SESSION['errors']['code'] = 'Mã giảm giá không được để trống.';
            $is_valid = false;
        } else {
            $code = trim($_POST['code']);
            if (strlen($code) < 5 || strlen($code) > 15) {
                $_SESSION['errors']['code'] = 'Mã giảm giá phải từ 5 đến 15 ký tự.';
                $is_valid = false;
            }
            if (!preg_match('/^[A-Za-z0-9_-]+$/', $code)) {
                $_SESSION['errors']['code'] = 'Mã giảm giá chỉ được chứa chữ cái, số, gạch ngang (-) và gạch dưới (_).';
                $is_valid = false;
            }

            // Kiểm tra trùng lặp mã giảm giá, ngoại trừ mã hiện tại
            $discountModel = new Discount();
            $existingDiscount = $discountModel->getDiscountByCode($code);

            // Loại trừ mã hiện tại khi kiểm tra
            if ($existingDiscount && $existingDiscount['id'] != $id) {
                $_SESSION['errors']['code'] = 'Mã giảm giá đã tồn tại, vui lòng nhập mã khác.';
                $is_valid = false;
            }
        }

        // Kiểm tra loại giảm giá
        if (!isset($_POST['discount_type']) || !in_array($_POST['discount_type'], ['1', '2'])) {
            $_SESSION['errors']['discount_type'] = 'Loại giảm giá không hợp lệ.';
            $is_valid = false;
        }

        // Kiểm tra giá trị giảm
        if (!isset($_POST['discount_value']) || trim($_POST['discount_value']) === '') {
            $_SESSION['errors']['discount_value'] = 'Giá trị giảm không được để trống.';
            $is_valid = false;
        } else {
            $discount_value = str_replace(['.', ' VNĐ', '%'], '', $_POST['discount_value']);
            if ($_POST['discount_type'] === '1') {
                // Giảm theo %
                $discount_value = intval($discount_value); // Loại bỏ ký tự % và chuyển thành số nguyên
                if ($discount_value <= 0 || $discount_value > 100) {
                    $_SESSION['errors']['discount_value'] = 'Giá trị phần trăm phải lớn hơn 0 và không vượt quá 100%.';
                    $is_valid = false;
                } else {
                    $_POST['discount_value'] = $discount_value; // Chỉ lưu giá trị số
                }
            } else {
                // Giảm số tiền
                $discount_value = floatval(str_replace(['.', ' VNĐ'], '', $discount_value)); // Loại bỏ định dạng VNĐ
                if ($discount_value <= 0) {
                    $_SESSION['errors']['discount_value'] = 'Giá trị tiền phải lớn hơn 0.';
                    $is_valid = false;
                } else {
                    $_POST['discount_value'] = $discount_value; // Chỉ lưu giá trị số
                }
            }
        }

        // Kiểm tra giá trị đơn tối thiểu
        if (!isset($_POST['min_order_value']) || trim($_POST['min_order_value']) === '') {
            $_SESSION['errors']['min_order_value'] = 'Giá trị đơn tối thiểu không được để trống.';
            $is_valid = false;
        } else {
            // Loại bỏ các ký tự không phải số, như dấu chấm, dấu phẩy, và "VNĐ"
            $min_order_value = str_replace(['.', ',', ' VNĐ'], '', $_POST['min_order_value']);

            // Kiểm tra xem có phải là số hợp lệ không
            if (!is_numeric($min_order_value) || floatval($min_order_value) <= 0) {
                $_SESSION['errors']['min_order_value'] = 'Giá trị đơn tối thiểu phải là số lớn hơn 0.';
                $is_valid = false;
            } else {
                // Nếu hợp lệ, chuyển giá trị thành kiểu số thực (float) và gán lại vào $_POST để lưu
                $_POST['min_order_value'] = floatval($min_order_value);
            }
        }


        // Kiểm tra ngày bắt đầu
        if (!isset($_POST['start_date']) || trim($_POST['start_date']) === '') {
            $_SESSION['errors']['start_date'] = 'Ngày bắt đầu không được để trống.';
            $is_valid = false;
        } elseif (!strtotime($_POST['start_date'])) {
            $_SESSION['errors']['start_date'] = 'Ngày bắt đầu không hợp lệ.';
            $is_valid = false;
        }

        // Kiểm tra ngày kết thúc
        if (!isset($_POST['end_date']) || trim($_POST['end_date']) === '') {
            $_SESSION['errors']['end_date'] = 'Ngày kết thúc không được để trống.';
            $is_valid = false;
        } elseif (!strtotime($_POST['end_date'])) {
            $_SESSION['errors']['end_date'] = 'Ngày kết thúc không hợp lệ.';
            $is_valid = false;
        }

        // Kiểm tra logic ngày bắt đầu < ngày kết thúc
        if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
            $startDate = strtotime($_POST['start_date']);
            $endDate = strtotime($_POST['end_date']);
            if ($startDate >= $endDate) {
                $_SESSION['errors']['end_date'] = 'Ngày kết thúc phải sau ngày bắt đầu.';
                $is_valid = false;
            }
        }

        // Kiểm tra trạng thái
        if (!isset($_POST['status']) || !in_array($_POST['status'], ['1', '0'])) {
            $_SESSION['errors']['status'] = 'Trạng thái không hợp lệ.';
            $is_valid = false;
        }

        return $is_valid;
    }
}
