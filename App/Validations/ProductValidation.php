<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Product;

class ProductValidation
{
    public static function create(): bool
    {
        $is_valid = true;
        $_SESSION['errors'] = [];

        if (!isset($_POST['name']) || trim($_POST['name']) === '') {
            $_SESSION['errors']['name'] = 'Không được để trống tên sản phẩm';
            $is_valid = false;
        } else {
            // Kiểm tra trùng tên sản phẩm
            $product = new Product();
            $existingProduct = $product->getOneProductByName($_POST['name']);
            if ($existingProduct) {
                $_SESSION['errors']['name'] = 'Tên sản phẩm đã tồn tại';
                $is_valid = false;
            }
        }

        if (!isset($_POST['price']) || trim($_POST['price']) === '') {
            $_SESSION['errors']['price'] = 'Không được để trống giá';
            $is_valid = false;
        } elseif (!is_numeric($_POST['price'])) {
            $_SESSION['errors']['price'] = 'Vui lòng nhập số';
            $is_valid = false;
        } elseif ((float)$_POST['price'] <= 0) {
            $_SESSION['errors']['price'] = 'Giá phải lớn hơn 0';
            $is_valid = false;
        }
        if (isset($_POST['discount_price']) && trim($_POST['discount_price']) !== '') {
            if (!is_numeric($_POST['discount_price'])) {
                $_SESSION['errors']['discount_price'] = 'Vui lòng nhập số';
                $is_valid = false;
            } else {
                $discount_price = (float)$_POST['discount_price'];
                if ($discount_price < 0) {
                    $_SESSION['errors']['discount_price'] = 'Giá giảm phải lớn hơn hoặc bằng 0';
                    $is_valid = false;
                } elseif (isset($_POST['price']) && is_numeric($_POST['price'])) {
                    $price = (float)$_POST['price'];
                    if ($discount_price > $price) {
                        $_SESSION['errors']['discount_price'] = 'Giá giảm không được lớn hơn giá';
                        $is_valid = false;
                    }
                }
            }
        }

        // Kiểm tra danh mục
        if (!isset($_POST['category_id']) || trim($_POST['category_id']) === '') {
            $_SESSION['errors']['category_id'] = 'Vui lòng chọn danh mục';
            $is_valid = false;
        }

        // Kiểm tra ảnh chính
        if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
            $_SESSION['errors']['image'] = 'Ảnh chính không được để trống';
            $is_valid = false;
        }

        if (!isset($_POST['status'])) {
            $_POST['status'] = 1; // Mặc định là "Còn hàng"
        }

        if (!isset($_POST['is_featured'])) {
            $_POST['is_featured'] = 0; // Mặc định là "Bình thường"
        }

        if (!isset($_POST['quantity']) || trim($_POST['quantity']) === '') {
            $_SESSION['errors']['quantity'] = 'Không được để trống số lượng';
            $is_valid = false;
        } elseif (!is_numeric($_POST['quantity']) || (int)$_POST['quantity'] < 0) {
            $_SESSION['errors']['quantity'] = 'Vui lòng nhập số lượng hợp lệ';
            $is_valid = false;
        }

        // Kiểm tra trạng thái


        // Kiểm tra nổi bật (is_featured)


        // if (!isset($_POST['description']) || trim($_POST['description']) === '') {
        //     $_SESSION['errors']['description'] = 'Mô tả không được để trống';
        //     $is_valid = false;
        // }

        return $is_valid;
    }

    public static function edit(): bool
    {
        $is_valid = true;
        if (!isset($_POST['name']) || trim($_POST['name']) === '') {
            $_SESSION['errors']['name'] = 'Không được để trống tên sản phẩm';
            $is_valid = false;
        } else {
            $product = new Product();
            $existingProduct = $product->getOneProductByName($_POST['name']);

            // Kiểm tra xem có phải đang chỉnh sửa sản phẩm không
            if (isset($_POST['id']) && $existingProduct && $existingProduct['id'] == $_POST['id']) {
                // Nếu đang chỉnh sửa, bỏ qua kiểm tra trùng lặp
            } else if ($existingProduct) {
                $_SESSION['errors']['name'] = 'Tên sản phẩm đã tồn tại';
                $is_valid = false;
            }
        }
        if (!isset($_POST['price']) || trim($_POST['price']) === '') {
            $_SESSION['errors']['price'] = 'Không được để trống giá';
            $is_valid = false;
        } elseif (!is_numeric($_POST['price'])) {
            $_SESSION['errors']['price'] = 'Vui lòng nhập số';
            $is_valid = false;
        } elseif ((float)$_POST['price'] <= 0) {
            $_SESSION['errors']['price'] = 'Giá phải lớn hơn 0';
            $is_valid = false;
        }
        if (isset($_POST['discount_price']) && trim($_POST['discount_price']) !== '') {
            if (!is_numeric($_POST['discount_price'])) {
                $_SESSION['errors']['discount_price'] = 'Vui lòng nhập số';
                $is_valid = false;
            } else {
                $discount_price = (float)$_POST['discount_price'];
                if ($discount_price < 0) {
                    $_SESSION['errors']['discount_price'] = 'Giá giảm phải lớn hơn hoặc bằng 0';
                    $is_valid = false;
                } elseif (isset($_POST['price']) && is_numeric($_POST['price'])) {
                    $price = (float)$_POST['price'];
                    if ($discount_price > $price) {
                        $_SESSION['errors']['discount_price'] = 'Giá giảm không được lớn hơn giá';
                        $is_valid = false;
                    }
                }
            }
        }

        // Kiểm tra danh mục
        if (!isset($_POST['category_id']) || trim($_POST['category_id']) === '') {
            $_SESSION['errors']['category_id'] = 'Vui lòng chọn danh mục';
            $is_valid = false;
        }

        // Kiểm tra ảnh chính
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
                $_SESSION['errors']['image'] = 'Ảnh chính không được để trống';
                $is_valid = false;
            }
        }

        // Kiểm tra thumbnails chỉ khi có upload mới
        if (isset($_FILES['thumbnails']) && !empty($_FILES['thumbnails']['name'][0])) {
            foreach ($_FILES['thumbnails']['name'] as $index => $name) {
                if ($_FILES['thumbnails']['error'][$index] !== UPLOAD_ERR_OK) {
                    $_SESSION['errors']['thumbnails'] = 'Lỗi khi tải lên thumbnails tại vị trí ' . ($index + 1);
                    $is_valid = false;
                    break;
                }

                $fileType = mime_content_type($_FILES['thumbnails']['tmp_name'][$index]);
                $allowedTypes = ['image/jpeg', 'image/png'];
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['errors']['thumbnails'] = 'Chỉ nhận file JPG, JPEG, PNG cho thumbnails tại vị trí ' . ($index + 1);
                    $is_valid = false;
                    break;
                }
            }
        }
        if (!isset($_POST['quantity']) || trim($_POST['quantity']) === '') {
            $_SESSION['errors']['quantity'] = 'Không được để trống số lượng';
            $is_valid = false;
        } elseif (!is_numeric($_POST['quantity']) || (int)$_POST['quantity'] < 0) {
            $_SESSION['errors']['quantity'] = 'Vui lòng nhập số lượng hợp lệ';
            $is_valid = false;
        }

        // Kiểm tra trạng thái
        if (!isset($_POST['status']) || ($_POST['status'] != '0' && $_POST['status'] != '1')) {
            $_SESSION['errors']['status'] = 'Vui lòng chọn trạng thái hợp lệ';
            $is_valid = false;
        }

        // Kiểm tra nổi bật (is_featured)
        if (!isset($_POST['is_featured']) || ($_POST['is_featured'] != '0' && $_POST['is_featured'] != '1')) {
            $_SESSION['errors']['is_featured'] = 'Vui lòng chọn giá trị hợp lệ cho mục nổi bật';
            $is_valid = false;
        }
        // return self::create();


        return $is_valid;
    }
    public static function uploadImage($field)
    {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] != 0) {
            return false;
        }

        $target_dir = 'public/uploads/products/';
        $file_type = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png'];

        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['errors'][$field] = 'Chỉ nhận file JPG, JPEG, PNG';
            return false;
        }

        $file_name = time() . '_' . uniqid() . '.' . $file_type;
        $target_file = $target_dir . $file_name;

        if (!move_uploaded_file($_FILES[$field]['tmp_name'], $target_file)) {
            $_SESSION['errors'][$field] = 'Không thể tải lên file';
            return false;
        }

        return $file_name;
    }
    public static function uploadThumbnails($inputName, $index = null)
    {
        $destinationDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/thumbnails/';

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0777, true);
        }

        // Nếu chỉ mục được cung cấp, xử lý thumbnail tại vị trí đó
        if ($index !== null) {
            $name = $_FILES[$inputName]['name'][$index];
            if (!empty($name)) {
                $fileTmpPath = $_FILES[$inputName]['tmp_name'][$index];
                $fileType = mime_content_type($fileTmpPath);
                $allowedTypes = ['image/jpeg', 'image/png'];

                // Kiểm tra lỗi upload
                if ($_FILES[$inputName]['error'][$index] !== UPLOAD_ERR_OK) {
                    $_SESSION['errors']['thumbnails'] = 'Lỗi tải lên file thumbnail tại vị trí ' . ($index + 1);
                    return false;
                }

                // Kiểm tra định dạng tệp tin
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['errors']['thumbnails'] = 'Chỉ nhận file JPG, JPEG, PNG cho thumbnails tại vị trí ' . ($index + 1);
                    return false;
                }

                // Tạo tên file an toàn
                $newFileName = uniqid() . '.' . pathinfo($name, PATHINFO_EXTENSION);
                $destination = $destinationDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destination)) {
                    return $newFileName;
                } else {
                    $_SESSION['errors']['thumbnails'] = 'Không thể tải lên thumbnails tại vị trí ' . ($index + 1);
                    return false;
                }
            }
        } else {
            // Xử lý tất cả các thumbnails nếu không truyền index
            $uploadedThumbnails = [];
            foreach ($_FILES[$inputName]['name'] as $index => $name) {
                if (!empty($name)) {
                    $fileTmpPath = $_FILES[$inputName]['tmp_name'][$index];
                    $fileType = mime_content_type($fileTmpPath);
                    $allowedTypes = ['image/jpeg', 'image/png'];

                    // Kiểm tra lỗi upload
                    if ($_FILES[$inputName]['error'][$index] !== UPLOAD_ERR_OK) {
                        $_SESSION['errors']['thumbnails'] = 'Lỗi tải lên file thumbnail tại vị trí ' . ($index + 1);
                        continue;
                    }

                    // Kiểm tra định dạng tệp tin
                    if (!in_array($fileType, $allowedTypes)) {
                        $_SESSION['errors']['thumbnails'] = 'Chỉ nhận file JPG, JPEG, PNG cho thumbnails tại vị trí ' . ($index + 1);
                        continue;
                    }

                    // Tạo tên file an toàn
                    $newFileName = uniqid() . '.' . pathinfo($name, PATHINFO_EXTENSION);
                    $destination = $destinationDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $destination)) {
                        $uploadedThumbnails[$index] = $newFileName;
                    } else {
                        $_SESSION['errors']['thumbnails'] = 'Không thể tải lên thumbnails tại vị trí ' . ($index + 1);
                    }
                }
            }

            return $uploadedThumbnails;
        }

        return false;
    }
}
