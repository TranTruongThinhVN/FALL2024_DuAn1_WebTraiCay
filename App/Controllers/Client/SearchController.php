<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Client\Product;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Store\Store;

class SearchController
{
    // hiển thị danh sách
    public function search()
    {
        // Get the search query from the URL
        $query = $_GET['query'] ?? '';

        // Return an empty response if no query is provided
        if (empty($query)) {
            echo json_encode([]);
            return;
        }

        // Fetch matching products from the database
        $productModel = new Product();
        $results = $productModel->searchProducts($query);

        // Format the results for the frontend
        $formattedResults = array_map(function ($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'image' => APP_URL . '/public/uploads/products/' . $product['image'], // Ensure this is correct
                'price' => number_format($product['discount_price'] ?: $product['price']) . '₫',
                'discount_price' => $product['discount_price'] ? number_format($product['price']) . '₫' : null,
            ];
        }, $results);


        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($formattedResults);
    }
}
