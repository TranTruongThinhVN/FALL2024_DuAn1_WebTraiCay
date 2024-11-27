<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Models\Admin\Product;
use App\Validations\ProductValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Detail_product;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Edit_product;
use App\Views\Admin\Pages\Product\Index;
use App\Views\Admin\Pages\Product\Product as ProductAdmin;
use App\Views\Client\Pages\News\Detail;

class ProductController
{


    // hiển thị danh sách
    public static function index()
    {
        $keyword = $_GET['search'] ?? ''; // Từ khóa tìm kiếm
        $category_id = $_GET['category_id'] ?? ''; // Lọc theo danh mục
        $status = $_GET['status'] ?? ''; // Lọc theo trạng thái

        $productModel = new Product();
        $limit = 10; // Số sản phẩm mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        // Áp dụng bộ lọc
        $products = $productModel->getFilteredProducts($keyword, $category_id, $status, $limit, $offset);
        $totalProducts = $productModel->countFilteredProducts($keyword, $category_id, $status);
        $totalPages = ceil($totalProducts / $limit);

        $categories = (new Category())->getAllCategory(); // Lấy danh mục

        // Gửi dữ liệu tới View
        $data = [
            'products' => $products,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'keyword' => $keyword,
            'categories' => $categories, // Danh sách danh mục
            'selectedCategory' => $category_id,
            'selectedStatus' => $status,
        ];

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        ProductAdmin::render($data); // Truyền dữ liệu vào View
        Footer::render();
    }






    // hiển thị giao diện form thêm
    public static function create()
    {
        $category = new Category();
        $data = $category->getAllCategory();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render($data);
        Footer::render();
    }


    // xử lý chức năng thêm
    public static function store()
    {
        $is_valid = ProductValidation::create();

        if (!$is_valid) {
            $_SESSION['old'] = $_POST;
            // NotificationHelper::error('create', 'Thêm sản phẩm thất bại');
            header('location: /admin/add-product');
            exit;
        }

        $image = ProductValidation::uploadImage('image');
        if (!$image) {
            echo 'Lỗi khi tải lên ảnh chính.';
            exit;
        }

        $thumbnails = ProductValidation::uploadThumbnails('thumbnails');

        if (empty($thumbnails)) {
            NotificationHelper::error('create', 'Không thể tải lên ảnh thumbnails');
            header('location: /admin/add-product');
            exit;
        }

        $thumbnailsJson = json_encode($thumbnails);

        $product = new Product();
        $data = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'is_featured' => $_POST['is_featured'],
            'discount_price' => $_POST['discount_price'],
            'category_id' => $_POST['category_id'],
            'description' => $_POST['description'], // Dữ liệu từ CKEditor
            'image' => $image,
            'quantity' => $_POST['quantity'],
            'thumbnails' => $thumbnailsJson,
            'status' => 1,
        ];

        $productId = $product->createProduct($data);
        if ($productId) {
            NotificationHelper::success('create', 'Thêm sản phẩm thành công');
            header('location: /admin/add-product');
            exit;
        } else {
            NotificationHelper::error('create', 'Thêm sản phẩm thất bại');
            header('location:/admin/add-product');
            exit;
        }
    }




    // hiển thị chi tiết8
    // hiển thị chi tiết sản phẩm
    public static function show(int $id)
    {
        $product = new Product();
        $data_product = $product->getOneProduct($id);
        if (!$data_product) {
            NotificationHelper::error('show', 'Không tìm thấy sản phẩm');
            header('location: /admin/products');
            exit;
        }

        $data = [
            'product' => $data_product
        ];

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Detail_product::render($data);
        Footer::render();
    }



    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        $productModel = new Product();
        $product = $productModel->getOneProduct($id);

        if (!$product) {
            NotificationHelper::error('edit', 'Không thể xem sản phẩm này');
            header('location: /admin/products');
            exit;
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategory();

        $data = [
            'product' => $product,
            'categories' => $categories,
        ];

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit_product::render($data);
        Footer::render();
    }


    // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        var_dump($_FILES['thumbnails']);
        $_POST['id'] = $id;
        $is_valid = ProductValidation::edit();

        // if (!$is_valid) {
        //     // NotificationHelper::error('update', 'Cập nhật sản phẩm thất bại');
        //     echo 'ngu';
        //     var_dump($is_valid);
        //     // header("location: /admin/products/$id");
        //     exit;
        // }
        if (!$is_valid) {
            error_log("Validation failed: " . print_r($_SESSION['errors'], true));
        }


        $name = $_POST['name'];
        // kiểm tra tên loại có tồn tại chưa => ko được trùng tên
        $product = new Product();
        $is_exist = $product->getOneProductByName($name);

        if ($is_exist) {
            if ($is_exist['id'] != $id) {
                NotificationHelper::error('update', 'Tên sản phẩm đã tồn tại');
                header("location: /admin/products/$id");
                exit;
            }
        }

        // thực hiện cập nhật
        $data = [
            'name' => $name,

            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'is_featured' => $_POST['is_featured'],
            'category_id' => $_POST['category_id'],
            'status' => $_POST['status'],
            'description' => $_POST['description'],
        ];

        // Xử lý upload ảnh chính nếu có
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = ProductValidation::uploadImage('image');
            if ($image) {
                $data['image'] = $image;
                // Xóa ảnh cũ nếu cần
            } else {
                $_SESSION['errors']['image'] = 'Lỗi khi tải lên ảnh chính';
                $_SESSION['old'] = $_POST;
                header("Location: /admin/products/$id/edit");
                exit;
            }
        }

        // Xử lý upload thumbnails
        $productData = $product->getOneProduct($id);
        $old_thumbnails = json_decode($productData['thumbnails'], true) ?? [];

        if (isset($_FILES['thumbnails'])) {
            foreach ($_FILES['thumbnails']['name'] as $index => $fileName) {
                if (!empty($fileName)) {
                    $uploadedThumbnail = ProductValidation::uploadThumbnails('thumbnails', $index);
                    if ($uploadedThumbnail) {
                        // Thay thế thumbnail cũ tại vị trí này
                        $oldThumbnail = $old_thumbnails[$index] ?? null;
                        $old_thumbnails[$index] = $uploadedThumbnail;

                        // Tùy chọn: Xóa thumbnail cũ nếu cần
                        // if ($oldThumbnail) {
                        //     $oldThumbnailPath = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/thumbnails/' . $oldThumbnail;
                        //     if (file_exists($oldThumbnailPath)) {
                        //         unlink($oldThumbnailPath);
                        //     }
                        // }
                    } else {
                        $_SESSION['errors']['thumbnails'] = 'Lỗi khi tải lên thumbnails tại vị trí ' . ($index + 1);
                        header("Location: /admin/products/$id/edit");
                        exit;
                    }
                }
            }
            // Cập nhật trường thumbnails với danh sách mới
            $data['thumbnails'] = json_encode($old_thumbnails);
        }

        // var_dump($product);
        $result = $product->updateProduct($id, $data);

        if ($result) {
            NotificationHelper::success('update', 'Cập nhật sản phẩm thành công');
            header('location: /admin/products');
            exit;
        } else {
            NotificationHelper::error('update', 'Cập nhật sản phẩm thất bại');
            header("location: /admin/products/$id");
            exit;
        }
    }


    // thực hiện xoá
    public static function delete(int $id)
    {
        $product = new Product();
        $result = $product->deleteProduct($id);
        if ($result) {
            NotificationHelper::success("delete", "Xóa sản phẩm thành công");
        } else {
            NotificationHelper::error("delete", "Xóa sản phẩm thất bại");
        }
        header("location: /admin/product");
    }
    public function uploadImageCkeditor()
    {
        if (isset($_FILES['upload'])) {
            $file = $_FILES['upload'];
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/ckeditor/'; // Đường dẫn upload
            echo $uploadDir;

            // Tạo tên file an toàn
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);

            // Tạo thư mục nếu chưa tồn tại
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Upload file
            if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
                $url = '/public/uploads/ckeditor/' . $fileName; // Đường dẫn URL ảnh
                // Trả JSON về cho CKEditor
                echo json_encode([
                    'uploaded' => true,
                    'url' => $url
                ]);
            } else {
                echo json_encode([
                    'uploaded' => false,
                    'error' => ['message' => 'Không thể tải lên tệp.']
                ]);
            }
        } else {
            echo json_encode([
                'uploaded' => false,
                'error' => ['message' => 'Không có file nào được tải lên.']
            ]);
        }
    }
    public static function deleteThumbnail()
    {
        // Đọc dữ liệu từ body (JSON)
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || !isset($data['thumbnail'], $data['index'], $data['product_id'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
            return;
        }

        $thumbnail = $data['thumbnail'];
        $index = $data['index'];
        $productId = $data['product_id'];

        // Lấy sản phẩm từ database
        $productModel = new Product();
        $product = $productModel->getOneProduct($productId);

        if (!$product) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
            return;
        }

        // Xử lý xóa thumbnail
        $thumbnails = json_decode($product['thumbnails'], true);
        if (isset($thumbnails[$index])) {
            // Xóa file thumbnail trên server
            $thumbnailPath = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/thumbnails/' . $thumbnails[$index];
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            // Loại bỏ thumbnail khỏi danh sách
            unset($thumbnails[$index]);

            // Cập nhật database
            $productModel->updateProduct($productId, [
                'thumbnails' => json_encode(array_values($thumbnails)) // Reset lại chỉ số
            ]);

            echo json_encode(['success' => true, 'message' => 'Xóa thành công']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Thumbnail không tồn tại']);
        }
    }
}
