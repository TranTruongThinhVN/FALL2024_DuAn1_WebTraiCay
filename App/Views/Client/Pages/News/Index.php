<?php

namespace App\Views\Client\Pages\News;

use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="main-container main-news">
            <div class="news-container">
                <div class="news-header">
                    <h1>Tin Tức</h1>
                    <p>Cập nhật những tin tức mới nhất về trái cây và thực phẩm sạch.</p>
                </div>

                <div class="news-layout">
                    <!-- Khối bên trái -->
                    <div class="news-content">
                        <div class="news-item" onclick="location.href='/news-detail'">
                            <a href="/news-detail"> <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Tin tức 1" class="news-thumbnail"></a>
                            <div class="news-details">
                                <h2 class="news-title">Cách chọn trái cây chín và chất lượng</h2>
                                <p class="news-date">20/04/2024</p>
                                <p class="news-excerpt">Cung cấp các mẹo chọn trái cây chín và chất lượng tại chợ, bao gồm màu sắc, độ cứng và mùi hương. Điều này sẽ đặc biệt hữu ích cho những ai không biết cách đánh giá độ tươi ngon của trái cây</p>
                                <a href="#" class="read-more">Xem thêm</a>
                            </div>
                        </div>
                        <div class="news-item" onclick="location.href='/news-detail'">
                            <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Tin tức 1" class="news-thumbnail">
                            <div class="news-details">
                                <h2 class="news-title">Xu hướng và cải tiến trong ngành trái cây</h2>
                                <p class="news-date">20/04/2024</p>
                                <p class="news-excerpt">Đưa tin về các xu hướng trong ngành trái cây như trái cây hữu cơ, trái cây nhập khẩu và các cách thưởng thức trái cây mới (ví dụ: trái cây sấy lạnh). Bạn cũng có thể đề cập đến các giống trái cây mới đang được giới thiệu</p>
                                <a href="#" class="read-more">Xem thêm</a>
                            </div>
                        </div>
                        <div class="news-item" onclick="location.href='/news-detail'">
                            <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Tin tức 1" class="news-thumbnail">
                            <div class="news-details">
                                <h2 class="news-title">Lợi ích của chế độ ăn dựa trên thực vật và vai trò của trái cây</h2>
                                <p class="news-date">20/04/2024</p>
                                <p class="news-excerpt">Thảo luận về vai trò của trái cây trong chế độ ăn dựa trên thực vật và các dưỡng chất mà chúng cung cấp. Giải thích tầm quan trọng của trái cây trong chế độ ăn cân đối và lợi ích cho sức khỏe tổng thể</p>
                                <a href="#" class="read-more">Xem thêm</a>
                            </div>
                        </div>
                        <div class="pagination" onclick="location.href='/news-detail'">
                            <div class="page-item active">1</div>
                            <div class="page-item">2</div>
                            <div class="dots">...</div>
                            <div class="page-item">8</div>
                        </div>


                    </div>


                    <!-- Khối bên phải -->
                    <aside class="news-sidebar">
                        <div class="news-categories">
                            <h3>Danh Mục Blog</h3>
                            <ul>
                                <li><a href="#">Tin Tức Nam An (59)</a></li>
                                <li><a href="#">Tin Khuyến Mãi (106)</a></li>
                                <li><a href="#">Tin Tuyển Dụng (3)</a></li>
                                <li><a href="#">Kiến Thức Sản Phẩm (128)</a></li>
                                <li><a href="#">Công Thức Nấu Ăn (26)</a></li>
                            </ul>
                        </div>

                        <div class="featured-news">
                            <h3>Bài Viết Mới Nhất</h3>
                            <div class="featured-item">
                                <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Bài viết mới nhất 1">
                                <div>
                                    <a href="#">Vi Sao Cả Thế Giới Phát Cuồng PARMIGIANO...</a>
                                    <p>Tháng 10 30, 2024</p>
                                </div>
                            </div>
                            <div class="featured-item">
                                <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Bài viết mới nhất 2">
                                <div>
                                    <a href="#">Khám Phá Bí Mật Của 'Vua Phô Mai' Pháp...</a>
                                    <p>Tháng 10 11, 2024</p>
                                </div>
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </div>

<?php

    }
}
?>