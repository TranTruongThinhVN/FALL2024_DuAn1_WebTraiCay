<?php

namespace App\Views\Client\Pages\Introduce;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class Index extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="introduce-banner">
            <img src="https://theme.hstatic.net/1000282430/1001088848/14/breadcrumb_collection.jpg?v=1012" class="introduce-banner__image">
            <div class="introduce-banner__content">
                <h1>Welcome to Fruitify</h1>
                <p>Discover the freshest fruits directly from the farm to your table!</p>
            </div>
        </div>
        <main class="main-container">
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
            </section>
            <section class="philosophy">
                <h2 class="philosophy__title">Triết lý kinh doanh</h2>
                <div class="philosophy__items">
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <img src="https://images.pexels.com/photos/7643867/pexels-photo-7643867.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="philosophy__image">
                            <div class="philosophy__text-content">
                                Chất lượng hảo hạng: Tuyển chọn từ các nhà vườn có kỹ thuật canh tác tốt nhất (đạt tiêu chuẩn VietGAP, GlobalGAP, Hữu cơ). Mẫu mã đẹp, hương vị ngon - trái cây tại Morning Fruit luôn đáp ứng khẩu vị của những khách hàng sành ăn nhất.
                            </div>
                            <p class="philosophy__caption">Tầm nhìn thương hiệu</p>
                        </div>
                    </div>
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <img src="https://images.pexels.com/photos/1586973/pexels-photo-1586973.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Tầm nhìn thương hiệu" class="philosophy__image">
                            <div class="philosophy__text-content">
                                Đảm bảo nguồn gốc: Trái cây nội địa được tuyển chọn từ các nông trại từ Bắc chí Nam. Trái cây nhập khẩu chính ngạch, có giấy phép thông quan. Nói không với các sản phẩm không rõ xuất xứ.
                            </div>
                            <p class="philosophy__caption">Tầm nhìn thương hiệu</p>
                        </div>
                    </div>
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <img src="https://images.pexels.com/photos/7691694/pexels-photo-7691694.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="philosophy__image">
                            <div class="philosophy__text-content">
                                Giá cả cạnh tranh (so với phân khúc chất lượng): Nhờ rút bớt các khâu trung gian, làm việc trực tiếp với các nhà vườn, hợp tác xã tại các địa phương
                            </div>
                            <p class="philosophy__caption">Dịch vụ đặc biệt</p>
                        </div>
                    </div>
                    <div class="philosophy__item">
                        <div class="philosophy__item-inner">
                            <img src="https://images.pexels.com/photos/5256687/pexels-photo-5256687.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Cam kết tận tâm" class="philosophy__image">
                            <div class="philosophy__text-content">
                                Tại Morning Fruit, chúng tôi luôn có chính sách bảo hành linh động (tặng voucher giảm giá, bù hàng, hoàn tiền), cho các sản phẩm chưa đáp ứng kỳ vọng khách hàng.
                            </div>
                            <p class="philosophy__caption">Cam kết tận tâm</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script>
            document.querySelectorAll('.philosophy__item').forEach(item => {
                item.addEventListener('click', () => {
                    item.querySelector('.philosophy__item-inner').classList.toggle('flipped');
                });
            });
        </script>
<?php
    }
}
