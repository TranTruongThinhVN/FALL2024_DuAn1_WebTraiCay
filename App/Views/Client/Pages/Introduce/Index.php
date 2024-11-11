<?php

namespace App\Views\Client\Pages\Introduce;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class index extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="banner-introduce">
            <img src="https://images.unsplash.com/photo-1490761408590-95e292cf8d21?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 1" class="slide__image">
        </div>



        <section class="brand-introduction">
            <div class="main-container">
                <div class="content">
                    <div class="image-container">
                        <img src="https://images.pexels.com/photos/89778/strawberries-frisch-ripe-sweet-89778.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Trái cây tươi ngon">
                    </div>
                    <div class="text-content">
                        <h2>TỪ NHỮNG TRÁI NGỌT, CHÚNG TÔI TẠO RA NIỀM ĐAM MÊ</h2>
                        <p>
                            Trải qua nhiều năm gắn bó với ngành nông sản, chúng tôi tự hào mang đến cho bạn những trái cây tươi ngon nhất. Các sản phẩm của chúng tôi không chỉ được chọn lọc từ những vườn cây đạt chuẩn mà còn được trồng trọt, chăm sóc và bảo quản theo quy trình nghiêm ngặt. Chúng tôi cam kết mang đến cho bạn và gia đình những trái cây tươi ngon, bổ dưỡng và an toàn cho sức khỏe.
                        </p>
                        <p>
                            Chúng tôi tin rằng mỗi quả trái cây đều là một món quà quý giá từ thiên nhiên, chứa đựng sự tươi mát và những giá trị dinh dưỡng thiết yếu. Từ những giống cây truyền thống cho đến những giống cây ngoại nhập đặc sắc, mỗi sản phẩm đều trải qua quy trình kiểm định chất lượng khắt khe để đảm bảo rằng chỉ những quả tươi ngon nhất mới được giao đến tay khách hàng. Với chúng tôi, trái cây không chỉ là thực phẩm mà còn là một phần của lối sống lành mạnh và cân bằng.
                        </p>
                        <button class="cta-button">Khám phá ngay</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="brand-introduction">
            <div class="main-container">
                <div class="content reverse">
                    <div class="text-content">
                        <h2>CHẤT LƯỢNG TỪ TÂM, GIÁ TRỊ CHO SỨC KHỎE</h2>
                        <p>
                            Morning Fruit là đơn vị bán lẻ và phân phối các sản phẩm trái cây tươi chất lượng cao, từ các nhà vườn trong nước và nhập khẩu. Sứ mệnh của chúng tôi, là đem nông sản – từ những vườn chất lượng nhất – đến bàn ăn của mỗi gia đình Việt. Trái cây mẫu mã phải đẹp, ăn phải ngon, sạch, phải giàu dinh dưỡng nhờ canh tác theo chuẩn an toàn.</p>
                        <p>
                            Hãy đến với chúng tôi để trải nghiệm những sản phẩm trái cây sạch, được trồng trọt và bảo quản một cách khoa học. Mỗi trái cây không chỉ là thực phẩm mà còn là sự chăm sóc sức khỏe cho bạn và gia đình. Chúng tôi tin rằng sức khỏe là tài sản quý giá nhất, và chúng tôi cam kết mang đến những giá trị tốt đẹp từ thiên nhiên cho cuộc sống của bạn.
                        </p>
                        <button class="cta-button">Khám phá thêm</button>
                    </div>
                    <div class="image-container">
                        <img src="https://images.pexels.com/photos/672101/pexels-photo-672101.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Trái cây chất lượng">
                    </div>
                </div>
            </div>
        </section>
        <section class="why-choose">
            <div class="main-container">
                <h2 class="why-choose__title">Tại sao bạn nên chọn cửa hàng của <span class="why-choose__highlight">Savor House</span></h2>
                <div class="why-choose__items">
                    <div class="why-choose__item">
                        <i class="why-choose__icon fas fa-truck"></i>
                        <h3 class="why-choose__item-title">Giao hàng nhanh chóng</h3>
                        <p class="why-choose__item-description">Giao hàng từ 30-40 phút kể từ lúc đặt hàng</p>
                    </div>
                    <div class="why-choose__item">
                        <i class="why-choose__icon fas fa-award"></i>
                        <h3 class="why-choose__item-title">Sản phẩm chất lượng</h3>
                        <p class="why-choose__item-description">Sản phẩm uy tín, chất lượng đến từ nhà Savor House</p>
                    </div>
                    <div class="why-choose__item">
                        <i class="why-choose__icon fas fa-phone"></i>
                        <h3 class="why-choose__item-title">Hỗ trợ nhiệt tình</h3>
                        <p class="why-choose__item-description">Hỗ trợ và lắng nghe ý kiến khách hàng</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="philosophy">
            <div class="main-container">
                <h2 class="philosophy__title">Triết lý kinh doanh</h2>
                <div class="philosophy__items">
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <div class="philosophy__image">
                                <img data-v-3bbce9b0="" src="https://website.hdlcdns.com/website/image/ed47fa792a92413183769f2f4ef4cbad-600-360.png" border="0" class="img100">
                                <p class="philosophy__caption">Khái niệm thương hiệu</p>
                            </div>
                            <div class="philosophy__text-content">
                                <h3>Khái niệm thương hiệu</h3>
                                <p>Thông qua các sản phẩm được lựa chọn cẩn thận và dịch vụ đổi mới, chúng tôi tạo ra khoảng thời gian thưởng thức món ăn vui vẻ và mang đến văn hóa ẩm thực lâu dài mạnh cho những người yêu thích ẩm thực trên toàn thế giới.</p>
                            </div>
                        </div>
                    </div>
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <div class="philosophy__image">
                                <img src="https://images.pexels.com/photos/7643867/pexels-photo-7643867.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Image 1">
                                <p class="philosophy__caption">Tầm nhìn thương hiệu</p>
                            </div>
                            <div class="philosophy__text-content">
                                <h3>Tầm nhìn thương hiệu</h3>
                                <p>Giao tiếp là điều cần thiết giữa con người với nhau, và món lẩu từ Trung Quốc là một bữa ăn mang tính xã hội tự nhiên. Haidilao cam kết cho phép nhiều người mở rộng trái tim và ăn uống vui vẻ tại bàn ăn.</p>
                            </div>
                        </div>
                    </div>
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <div class="philosophy__image">
                                <img data-v-3bbce9b0="" src="https://website.hdlcdns.com/website/image/4014a49397e0455781021c9a9f6e0736-600-360.png" border="0" class="img100">
                                <p class="philosophy__caption">Dịch vụ đặc biệt</p>
                            </div>
                            <div class="philosophy__text-content">
                                <h3>Dịch vụ đặc biệt</h3>
                                <p>Chúng tôi cam kết mang đến dịch vụ đặc biệt, tạo nên trải nghiệm đáng nhớ cho khách hàng thông qua sự chu đáo và nhiệt tình của đội ngũ nhân viên.</p>
                            </div>
                        </div>
                    </div>
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <div class="philosophy__image">
                                <img data-v-3bbce9b0="" src="https://website.hdlcdns.com/website/image/23b726523994467bb032da1b8eb2887a-600-360.jpg" border="0" class="img100">
                                <p class="philosophy__caption">Cam kết tận tâm</p>
                            </div>
                            <div class="philosophy__text-content">
                                <h3>Cam kết tận tâm</h3>
                                <p>Tại Morning Fruit, chúng tôi luôn có chính sách bảo hành linh động như tặng voucher giảm giá, bù hàng, hoàn tiền, cho các sản phẩm chưa đáp ứng kỳ vọng khách hàng.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat the .philosophy__item div for each card -->
                </div>
            </div>
        </section>


<?php
    }
}
?>
<script>
    document.querySelectorAll('.philosophy__item').forEach(item => {
        item.addEventListener('click', () => {
            item.querySelector('.philosophy__item-inner').classList.toggle('flipped');
        });
    });
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide() {
        slides.forEach((slide, index) => {
            slide.classList.remove('slide-active');
            if (index === currentSlide) {
                slide.classList.add('slide-active');
            }
        });
        currentSlide = (currentSlide + 1) % slides.length;
    }

    // Đổi ảnh sau mỗi 3 giây
    setInterval(showSlide, 3000);
</script>