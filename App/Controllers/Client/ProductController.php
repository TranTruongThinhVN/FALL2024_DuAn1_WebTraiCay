<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Category;
use App\Models\Client\Cart;
use App\Models\Client\Category as ClientCategory;
use App\Models\Client\Product;
use App\Validations\CommentValidation;
use App\Views\Admin\Pages\Product\Details;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Detail;
use App\Views\Client\Pages\Product\Index;

class ProductController
{
    // Hiển thị danh sách sản phẩm
    public static function index()
    {
        $productModel = new Product();

        // Tham số phân trang
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        $itemsPerPage = 12;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Lọc sản phẩm
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
        $priceRange = isset($_GET['price_range']) && preg_match('/^\d+-\d+$/', $_GET['price_range'])
            ? explode('-', $_GET['price_range'])
            : null;
        $originFilter = isset($_GET['origin']) ? (array)$_GET['origin'] : [];

        // Sắp xếp sản phẩm
        $validSortOptions = ['default', 'price_asc', 'price_desc', 'name_asc', 'name_desc', 'newest', 'oldest'];
        $sort = isset($_GET['sort']) && in_array($_GET['sort'], $validSortOptions) ? $_GET['sort'] : 'default';

        $orderBy = 'id';
        $direction = 'ASC';

        switch ($sort) {
            case 'price_asc':
                $orderBy = 'price';
                $direction = 'ASC';
                break;
            case 'price_desc':
                $orderBy = 'price';
                $direction = 'DESC';
                break;
            case 'name_asc':
                $orderBy = 'name';
                $direction = 'ASC';
                break;
            case 'name_desc':
                $orderBy = 'name';
                $direction = 'DESC';
                break;
            case 'newest':
                $orderBy = 'created_at';
                $direction = 'DESC';
                break;
            case 'oldest':
                $orderBy = 'created_at';
                $direction = 'ASC';
                break;
        }

        // Lấy danh sách sản phẩm đã lọc, sắp xếp và phân trang
        $products = $productModel->getFilteredProducts($keyword, $priceRange, $originFilter, $orderBy, $direction, $offset, $itemsPerPage);
        $totalProducts = $productModel->getTotalFilteredProductCount($keyword, $priceRange, $originFilter);

        $totalPages = ceil($totalProducts / $itemsPerPage);

        // Lấy danh mục sản phẩm
        $categoryModel = new ClientCategory();
        $categories = $categoryModel->getAllCategoryByStatus();

        // Đếm sản phẩm theo trạng thái
        $productCount = $productModel->countProductsByStatus('1');

        // Truyền dữ liệu cho view
        $data = [
            'products' => $products,
            'categories' => $categories,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'currentSort' => $sort,
            'productCount' => $productCount,
            'priceRange' => $priceRange,
            'keyword' => $keyword,
        ];

        Header::render();
        Index::render($data);
        Footer::render();
    }

    // Hiển thị chi tiết sản phẩm
    public static function detail($id)
    {
        $productModel = new Product();

        // Lấy sản phẩm từ bảng products
        $product = $productModel->getOneProductByStatus($id);

        if (!$product) {
            throw new \Exception('Sản phẩm không tồn tại.');
        }

        // Mặc định giá trị cho biến thể và SKU mặc định
        $variants = [];
        $defaultSku = null;

        if ($product['type'] === 'variable') {
            // Lấy danh sách biến thể
            $variants = $productModel->getVariantsByProductId($id);

            // Lấy SKU mặc định
            $defaultSku = $productModel->getDefaultSkuByProductId($id);

            // Ghi đè giá và hình ảnh từ SKU mặc định nếu có
            if ($defaultSku) {
                $product['price'] = $defaultSku['price'];
                $product['discount_price'] = $defaultSku['discount_price'];
                $product['image'] = $defaultSku['image']; // Ghi đè ảnh chính bằng ảnh SKU
            }
        }

        // Lấy bình luận và phân trang cho sản phẩm từ phương thức getCommentProduct
        $comment = new CommentValidation();
        $commentData = $comment->getCommentProduct($id); // Đảm bảo hàm này luôn trả về một mảng

        // Mặc định giá trị nếu dữ liệu bình luận thiếu
        $comments = isset($commentData['comments']) ? $commentData['comments'] : [];
        $countComment = isset($commentData['countComment']) ? $commentData['countComment'] : 0;
        $currentPage = isset($commentData['currentPage']) ? $commentData['currentPage'] : 1;
        $totalPages = isset($commentData['totalPages']) ? $commentData['totalPages'] : 1;
        $countRating = isset($commentData['countRating']) ? $commentData['countRating'] : 0;
        $countImages = isset($commentData['countImages']) ? $commentData['countImages'] : 0;

        // Chuẩn bị dữ liệu truyền vào view
        $data = [
            'product' => $product,
            'variants' => $variants,
            'defaultSku' => $defaultSku, // Thêm defaultSku để sử dụng nếu cần
            'comments' => $comments, // Bình luận đã phân trang
            'countComment' => $countComment, // Tổng số bình luận
            'currentPage' => $currentPage, // Trang hiện tại
            'totalPages' => $totalPages, // Tổng số trang
            'countRating' => $countRating,
            'countImages' => $countImages
        ];

        Header::render();
        Detail::render($data);
        Footer::render();
    }
}
