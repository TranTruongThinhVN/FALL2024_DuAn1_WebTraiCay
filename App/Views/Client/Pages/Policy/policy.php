<?php

namespace App\Views\Client\Pages\Policy;

use App\Views\BaseView;


class policy  extends BaseView
{
    public static function render($data = null)
    {
?>

<div class="main-container">
<div class="breadcrumb-nav">
    <a href="/" class="breadcrumb-link">Trang chủ</a> 
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Chính sách ưu đãi</span>
</div>

<div class="policy-page">
    <div class="sidebar">
        <h2>Danh mục chính sách</h2>
        <ul>
            <li><a href="#faq" data-section="faq">Câu hỏi thường gặp</a></li>
            <li><a href="#about" data-section="about">Giới thiệu về Trái Cây Tươi</a></li>
            <li><a href="#return-policy" data-section="return-policy">Chính sách đổi trả</a></li>
            <li><a href="#shipping-policy" data-section="shipping-policy">Chính sách vận chuyển</a></li>
            <li><a href="#privacy-policy" data-section="privacy-policy">Chính sách bảo mật</a></li>
            <li><a href="#loyalty-policy" data-section="loyalty-policy">Chính sách thành viên</a></li>
            <li><a href="#promotion-policy" data-section="promotion-policy">Chính sách khuyến mãi</a></li>
            <li><a href="#contact-us" data-section="contact-us">Liên hệ</a></li>
        </ul>
    </div>
    <div class="content">
    <h1 class="page-title">Chính Sách Ưu Đãi</h1>

    <!-- FAQ Section -->
    <section id="faq" class="section-content active">
        <h2 class="section-title">1. Câu hỏi thường gặp</h2>
        <div class="faq-item">  
            <p class="question"><strong>Q:</strong> Sản phẩm trái cây có được kiểm tra an toàn thực phẩm không?</p>
            <p class="answer"><strong>A:</strong> Có, tất cả các sản phẩm của chúng tôi đều được kiểm tra và có giấy chứng nhận an toàn thực phẩm từ các cơ quan chức năng.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Tôi có thể đặt hàng trực tuyến không?</p>
            <p class="answer"><strong>A:</strong> Có, bạn có thể đặt hàng trực tuyến thông qua website của chúng tôi một cách nhanh chóng và tiện lợi.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Phương thức thanh toán như thế nào?</p>
            <p class="answer"><strong>A:</strong> Chúng tôi chấp nhận thanh toán bằng tiền mặt khi nhận hàng (COD), chuyển khoản ngân hàng và thanh toán trực tuyến qua thẻ tín dụng hoặc ví điện tử.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Tôi có thể hủy đơn hàng sau khi đã đặt không?</p>
            <p class="answer"><strong>A:</strong> Bạn có thể hủy đơn hàng trước khi chúng tôi tiến hành giao hàng bằng cách liên hệ với bộ phận chăm sóc khách hàng.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Trái cây có được bảo quản lạnh khi giao hàng không?</p>
            <p class="answer"><strong>A:</strong> Có, chúng tôi sử dụng phương tiện vận chuyển có hệ thống bảo quản lạnh để đảm bảo trái cây luôn tươi ngon khi đến tay bạn.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Tôi có thể đặt hàng số lượng lớn cho sự kiện không?</p>
            <p class="answer"><strong>A:</strong> Chúng tôi cung cấp dịch vụ đặt hàng số lượng lớn cho các sự kiện và tiệc cưới. Vui lòng liên hệ với chúng tôi để biết thêm chi tiết.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Chính sách ưu đãi cho khách hàng mới là gì?</p>
            <p class="answer"><strong>A:</strong> Khách hàng mới sẽ nhận được mã giảm giá 10% cho đơn hàng đầu tiên khi đăng ký tài khoản trên website của chúng tôi.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Làm thế nào để tôi trở thành thành viên thân thiết?</p>
            <p class="answer"><strong>A:</strong> Bạn chỉ cần tạo tài khoản và mua sắm thường xuyên để tích lũy điểm và nâng cấp hạng thành viên, nhận nhiều ưu đãi hấp dẫn.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Nếu tôi không hài lòng với chất lượng sản phẩm thì phải làm sao?</p>
            <p class="answer"><strong>A:</strong> Bạn có thể liên hệ với chúng tôi trong vòng 24 giờ để yêu cầu đổi trả hoặc hoàn tiền. Chúng tôi luôn sẵn lòng hỗ trợ bạn.</p>
        </div>
        <div class="faq-item">
            <p class="question"><strong>Q:</strong> Thời gian làm việc của cửa hàng là khi nào?</p>
            <p class="answer"><strong>A:</strong> Cửa hàng hoạt động từ 8:00 sáng đến 9:00 tối, từ thứ Hai đến Chủ Nhật.</p>
        </div>
        
    </section>

    <!-- About Section -->
    <section id="about" class="section-content">
        <h2 class="section-title">2. Giới thiệu về Trái Cây Tươi</h2>
        <p class="section-text">Trái Cây Tươi là thương hiệu cam kết mang đến các sản phẩm trái cây sạch và tươi ngon. Chúng tôi hợp tác với các nông trại đạt tiêu chuẩn và có quy trình kiểm soát chất lượng nghiêm ngặt, đảm bảo sản phẩm luôn an toàn và bổ dưỡng cho sức khỏe người tiêu dùng.</p>
        <p class="section-text">Chúng tôi không chỉ tập trung vào chất lượng sản phẩm mà còn đặc biệt chú trọng đến trải nghiệm của khách hàng. Đội ngũ nhân viên nhiệt tình, chuyên nghiệp và dịch vụ giao hàng nhanh chóng sẽ giúp bạn có những trải nghiệm mua sắm tuyệt vời nhất.</p>
    </section>

    <!-- Return Policy Section -->
    <section id="return-policy" class="section-content">
        <h2 class="section-title">3. Chính sách đổi trả</h2>
        <p class="section-text">Chúng tôi cam kết đảm bảo sự hài lòng của khách hàng. Các trường hợp áp dụng đổi trả:</p>
        <ul class="policy-list">
            <li class="policy-item">Sản phẩm hỏng do quá trình vận chuyển.</li>
            <li class="policy-item">Sản phẩm không đúng loại hoặc chất lượng như mô tả.</li>
            <li class="policy-item">Sản phẩm hết hạn sử dụng khi giao hàng.</li>
        </ul>
        <p class="section-text">Khách hàng vui lòng liên hệ với chúng tôi trong vòng 24 giờ sau khi nhận hàng để yêu cầu đổi trả, kèm theo hình ảnh sản phẩm làm bằng chứng. Chúng tôi luôn sẵn sàng hỗ trợ bạn một cách nhanh chóng.</p>
    </section>

    <!-- Shipping Policy Section -->
    <section id="shipping-policy" class="section-content">
        <h2 class="section-title">4. Chính sách vận chuyển</h2>
        <p class="section-text">Chúng tôi cung cấp dịch vụ giao hàng nhanh với các chi tiết sau:</p>
        <ul class="policy-list">
            <li class="policy-item">Miễn phí giao hàng cho các đơn hàng từ 500,000 VNĐ trở lên trong nội thành TP.HCM.</li>
            <li class="policy-item">Phí giao hàng cho các đơn dưới 500,000 VNĐ là 30,000 VNĐ.</li>
            <li class="policy-item">Thời gian giao hàng từ 1-3 giờ trong ngày (chỉ áp dụng trong khu vực nội thành).</li>
        </ul>
        <p class="section-text">Đối với các đơn hàng ngoài TP.HCM, thời gian giao hàng từ 1-3 ngày làm việc, và phí giao hàng sẽ được tính dựa trên khoảng cách.</p>
    </section>

    <!-- Privacy Policy Section -->
    <section id="privacy-policy" class="section-content">
        <h2 class="section-title">5. Chính sách bảo mật</h2>
        <p class="section-text">Trái Cây Tươi cam kết bảo vệ quyền riêng tư của khách hàng. Các thông tin thu thập sẽ được bảo mật và chỉ sử dụng cho mục đích cải thiện chất lượng dịch vụ:</p>
        <ul class="policy-list">
            <li class="policy-item">Thông tin của khách hàng không được chia sẻ với bên thứ ba nếu không có sự đồng ý của khách hàng.</li>
            <li class="policy-item">Dữ liệu cá nhân của khách hàng được lưu trữ an toàn và bảo mật.</li>
            <li class="policy-item">Khách hàng có quyền yêu cầu chỉnh sửa hoặc xóa dữ liệu cá nhân khỏi hệ thống của chúng tôi. Khách hàng có quyền yêu cầu chỉnh sửa hoặc xóa dữ liệu cá nhân khỏi hệ thống của chúng tôi.Khách hàng có quyền yêu cầu chỉnh sửa hoặc xóa dữ liệu cá nhân khỏi hệ thống của chúng tôi.</li>
        </ul>
    </section>

    <!-- Loyalty Policy Section -->
    <section id="loyalty-policy" class="section-content">
        <h2 class="section-title">6. Chính sách thành viên</h2>
        <p class="section-text">Chúng tôi có các ưu đãi đặc biệt dành riêng cho khách hàng thành viên:</p>
        <ul class="policy-list">
            <li class="policy-item">Khách hàng có thể tích lũy điểm qua mỗi đơn hàng và nhận ưu đãi khi đạt đến các mốc nhất định.</li>
            <li class="policy-item">Các ưu đãi đặc biệt vào dịp sinh nhật và các ngày lễ.</li>
            <li class="policy-item">Ưu tiên được thông báo sớm về các sản phẩm mới và các chương trình khuyến mãi.</li>
        </ul>
    </section>

    <!-- Promotion Policy Section -->
    <section id="promotion-policy" class="section-content">
        <h2 class="section-title">7. Chính sách khuyến mãi</h2>
        <p class="section-text">Chúng tôi thường xuyên triển khai các chương trình khuyến mãi hấp dẫn dành cho khách hàng:</p>
        <ul class="policy-list">
            <li class="policy-item">Giảm giá theo mùa cho các loại trái cây đặc biệt.</li>
            <li class="policy-item">Khuyến mãi "Mua 1 tặng 1" vào các dịp lễ đặc biệt.</li>
            <li class="policy-item">Cung cấp mã giảm giá cho khách hàng mới và khách hàng thân thiết.</li>
            <li class="policy-item">Giảm giá theo mùa cho các loại trái cây đặc biệt.</li>
            <li class="policy-item">Khuyến mãi "Mua 1 tặng 1" vào các dịp lễ đặc biệt.</li>
            <li class="policy-item">Cung cấp mã giảm giá cho khách hàng mới và khách hàng thân thiết.</li>


            <li class="policy-item">Giảm giá theo mùa cho các loại trái cây đặc biệt.</li>
            <li class="policy-item">Khuyến mãi "Mua 1 tặng 1" vào các dịp lễ đặc biệt.</li>
            <li class="policy-item">Cung cấp mã giảm giá cho khách hàng mới và khách hàng thân thiết.</li>
            <li class="policy-item">Giảm giá theo mùa cho các loại trái cây đặc biệt.</li>
            <li class="policy-item">Khuyến mãi "Mua 1 tặng 1" vào các dịp lễ đặc biệt.</li>
            <li class="policy-item">Cung cấp mã giảm giá cho khách hàng mới và khách hàng thân thiết.</li>


            <li class="policy-item">Giảm giá theo mùa cho các loại trái cây đặc biệt.</li>
            <li class="policy-item">Khuyến mãi "Mua 1 tặng 1" vào các dịp lễ đặc biệt.</li>
            <li class="policy-item">Cung cấp mã giảm giá cho khách hàng mới và khách hàng thân thiết.</li>
            <li class="policy-item">Giảm giá theo mùa cho các loại trái cây đặc biệt.</li>
            <li class="policy-item">Khuyến mãi "Mua 1 tặng 1" vào các dịp lễ đặc biệt.</li>
            <li class="policy-item">Cung cấp mã giảm giá cho khách hàng mới và khách hàng thân thiết.</li>

            <li class="policy-item">Giảm giá theo mùa cho các loại trái cây đặc biệt.</li>
            <li class="policy-item">Khuyến mãi "Mua 1 tặng 1" vào các dịp lễ đặc biệt.</li>
            <li class="policy-item">Cung cấp mã giảm giá cho khách hàng mới và khách hàng thân thiết.</li>

            
        </ul>
        <p class="section-text">Quý khách có thể theo dõi trên website hoặc đăng ký nhận thông báo để không bỏ lỡ các ưu đãi mới nhất.</p>
    </section>

    <!-- Contact Section -->
    <section id="contact-us" class="section-content">
        <h2 class="section-title">8. Liên hệ</h2>
        <p class="section-text">Nếu quý khách có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua các kênh sau:</p>
        <ul class="contact-list">
            <li class="policy__contact-item">Hotline: 1800-1234 (miễn phí)</li>
            <li class="policy__contact-item">Email: support@traicaytuoi.vn</li>
            <li class="policy__contact-item">Địa chỉ: 123 Đường Trái Cây, Quận 1, TP.HCM</li>
        </ul>
        <p class="section-text">Chúng tôi luôn sẵn sàng hỗ trợ và giải đáp mọi thắc mắc của quý khách.</p>
    </section>
</div>

</div>

</div>



<script>
    
</script>
        <script src="<?= APP_URL ?>/public/assets/client/js/policy.js"></script>

<?php
    }
}
?>