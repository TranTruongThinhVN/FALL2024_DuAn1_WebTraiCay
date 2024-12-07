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
    // hiển thị danh sách
    public static function index()
    {
        $productModel = new Product();

        // Pagination parameters
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        $itemsPerPage = 12;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Filtering logic
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
        $priceRange = isset($_GET['price_range']) && preg_match('/^\d+-\d+$/', $_GET['price_range'])
            ? explode('-', $_GET['price_range'])
            : null;
        $originFilter = isset($_GET['origin']) ? (array)$_GET['origin'] : [];

        // Sorting criteria
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

        // Fetch filtered, sorted, and paginated products
        $products = $productModel->getFilteredProducts($keyword, $priceRange, $originFilter, $orderBy, $direction, $offset, $itemsPerPage);
        $totalProducts = $productModel->getTotalFilteredProductCount($keyword, $priceRange, $originFilter);

        $totalPages = ceil($totalProducts / $itemsPerPage);

        // Fetch categories
        $categoryModel = new ClientCategory();
        $categories = $categoryModel->getAllCategoryByStatus();

        // Count products by status (if needed)
        $productCount = $productModel->countProductsByStatus('1');

        // Pass data to the view
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








    public static function detail($id)
    {
        $productModel = new Product();

        // Lấy sản phẩm từ bảng products
        $product = $productModel->getOneProductByStatus($id);

        if (!$product) {
            throw new \Exception('Sản phẩm không tồn tại.');
        }

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
        $commentData = $comment->getCommentProduct($id); // Sử dụng hàm này từ lớp Validations (isValid)

        $data = [
            'product' => $product,
            'variants' => $variants,
            'defaultSku' => $defaultSku, // Thêm defaultSku để sử dụng nếu cần
            'comments' => $commentData['comments'], // Bình luận đã phân trang
            'countComment' => $commentData['countComment'], // Tổng số bình luận
            'currentPage' => $commentData['currentPage'], // Trang hiện tại
            'totalPages' => $commentData['totalPages'], // Tổng số trang
            'countRating' => $commentData['countRating'],
            'countImages' => $commentData['countImages']
        ];

        Header::render();
        Detail::render($data);
        Footer::render();
    }
}
