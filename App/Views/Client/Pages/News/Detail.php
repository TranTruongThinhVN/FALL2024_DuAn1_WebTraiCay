<?php

namespace App\Views\Client\Pages\News;

use App\Views\BaseView;

class Detail extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="main-container">
            <article class="article-content">


                <article class="article-content">
                    <h2 class="article-title">NGHE NHÀ MÁCH NHỎ BÍ KÍP HEALTHY GỌN NHẸ, AI CŨNG ÁP DỤNG ĐƯỢC</h2>
                    <p class="article-date">Ngày đăng: 20/11/2024</p>
                    <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Main Image" class="main-image">

                    <p class="article-paragraph">Sống lành mạnh (healthy) đang là xu hướng được nhiều người trẻ ưa chuộng. Tuy nhiên, không đơn thuần là việc chăm chút đi theo các chế độ ăn uống hoặc tập luyện khắt khe, ngày nay healthy phải “easy” để vừa khỏe mạnh, vừa thoải mái tận hưởng mọi cuộc vui!</p>
                    <p class="article-paragraph">Tại Việt Nam, lối sống lành mạnh đang là xu hướng thịnh hành và ngày càng được nhiều người lựa chọn, nhất là giai đoạn hậu đại dịch. Theo một báo cáo của YouNet, ngay từ quý 03/2019, đã có tới hơn 600.000 cuộc thảo luận về chủ đề này trên các nền tảng mạng xã hội trong vòng 03 tháng. Đến nay, con số này đang không ngừng gia tăng với sự đón nhận tích cực từ người trẻ.</p>

                    <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Image 1" class="article-image">
                    <p class="caption">Caption for Image 1</p>

                    <p class="article-paragraph">Dạo quanh cộng đồng mạng, dễ dàng nhận thấy một đặc trưng thú vị trong lối sống healthy mà người trẻ ngày nay theo đuổi. Đó là yếu tố cân bằng giữa sự lành mạnh với những trải nghiệm sống thú vị đang chờ đợi các bạn – đặc biệt trong chuyện ăn uống. Theo đó, các bạn trẻ thường ưu tiên lựa chọn các món ăn bổ dưỡng nhưng phải tiện lợi, không quá rườm rà trong khâu chế biến. Đặc biệt, tuy đặt yếu tố dinh dưỡng lên hàng đầu nhưng cũng chú trọng việc thưởng thức, nuông chiều vị giác. Trớ trêu thay, đây cũng là lý do hàng đầu khiến nhiều bạn… “ngưng ngang” hành trình healthy của mình vì khó tìm ra lời giải ưng ý.</p>

                    <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Image 2" class="article-image">
                    <p class="caption">Caption for Image 2</p>

                    <p class="article-paragraph">Thấu hiểu được nỗi trăn trở này, với vai trò là bạn đồng hành thân thuộc của giới trẻ, vừa qua, The Coffee House đã giới thiệu bộ đôi Smoothie mát lành gồm Smoothie Phúc Bồn Tử Granola và Smoothie Xoài Nhiệt Đới Granola, thuộc Bộ sưu tập Đá Xay Frosty mới nhất. Đây hứa hẹn sẽ là câu trả lời hoàn hảo cho các bạn ưa chuộng lối sống healthy nhưng vẫn muốn tận hưởng trọn vẹn cuộc sống năng động.</p>
                </article>

                <!-- Social Sharing -->
                <div class="social-share">
                    <button>Chia sẻ Facebook</button>
                    <button>Chia sẻ Twitter</button>
                </div>

                <!-- Related Articles -->
                <div class="related-articles">
                    <div class="row-related-articles-title">
                        <h3>Bài viết mới nhất</h3>
                        <a href="">Xem tất cả</a>
                    </div>
                    <div class="articles-grid">
                        <div class="related-article">
                            <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Related Article 1">
                            <span class="tag">TIN TỨC</span>
                            <h4 class="news-related-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN</h4>
                            <p class="news-related-desc">Dẫu qua bao nhiêu lớp sống thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ...</p>
                            <a href="#" class="detail-link">CHI TIẾT <span>&#8250;</span></a>
                        </div>
                        <div class="related-article">
                            <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Related Article 1">
                            <span class="tag">TIN TỨC</span>
                            <h4 class="news-related-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN</h4>
                            <p class="news-related-desc">Dẫu qua bao nhiêu lớp sống thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ...</p>
                            <a href="#" class="detail-link">CHI TIẾT <span>&#8250;</span></a>
                        </div>
                        <div class="related-article">
                            <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Related Article 1">
                            <span class="tag">TIN TỨC</span>
                            <h4 class="news-related-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN</h4>
                            <p class="news-related-desc">Dẫu qua bao nhiêu lớp sống thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ...</p>
                            <a href="#" class="detail-link">CHI TIẾT <span>&#8250;</span></a>
                        </div>
                        <div class="related-article">
                            <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Related Article 1">
                            <span class="tag">TIN TỨC</span>
                            <h4 class="news-related-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN</h4>
                            <p class="news-related-desc">Dẫu qua bao nhiêu lớp sống thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ...</p>
                            <a href="#" class="detail-link">CHI TIẾT <span>&#8250;</span></a>
                        </div>
                        <div class="related-article">
                            <img src="<?= APP_URL ?>public/assets/client/images/news/6a-16760442790552121630131-36-0-676-1024-crop-1676044293762375610568.webp" alt="Related Article 1">
                            <span class="tag">TIN TỨC</span>
                            <h4 class="news-related-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN</h4>
                            <p class="news-related-desc">Dẫu qua bao nhiêu lớp sống thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ...</p>
                            <a href="#" class="detail-link">CHI TIẾT <span>&#8250;</span></a>
                        </div>

                    </div>
                </div>

        </div>
<?php

    }
}
?>