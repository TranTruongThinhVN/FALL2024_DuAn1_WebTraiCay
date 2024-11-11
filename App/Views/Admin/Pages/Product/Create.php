<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm Sản Phẩm</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInput" placeholder="">
                            </div>
                            <div class="form-box" style="display:grid; grid-template-columns: 1fr 1fr ;gap: 20px;">
                                <div class="form-group">
                                    <label for="">Danh mục</label>
                                    <select class="form-control" name="" id="exampleInput">
                                        <option value="">Lựa chọn</option>
                                        <option value="">Cam</option>
                                        <option value="">Táo</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Xuất sứ</label>
                                    <select class="form-control " name="" id="exampleInput">
                                        <option value="">Lựa chọn</option>
                                        <option value="">Việt Nam</option>
                                        <option value="">Nhật bản</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-box" style="display:grid; grid-template-columns: 1fr 1fr ;gap: 20px;">
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Số lượng</label>
                                    <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Số lượng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1">Giá tiền</label>
                                    <input type="text" class="form-control" id="exampleInputCity1" placeholder="Giá tiền">
                                </div>
                            </div>
                            <div class="form-box" style="display:grid; grid-template-columns: 1fr 1fr ;gap: 20px;">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Ngày tạo</label>
                                    <input type="datetime-local" class="form-control" id="exampleTextarea1"></in>
                                </div>
                                <div class="form-group">
                                    <label>Chọn ảnh</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Tải lên</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box" style="display:grid; grid-template-columns: 1fr 1fr ;gap: 20px;">
                                <div class="form-group">
                                    <label for="">Thẻ tag</label>
                                    <select class="form-control " name="" id="exampleInput">
                                        <option value="">Lựa chọn</option>
                                        <option value="">#Nhập khẩu</option>
                                        <option value="">#Chất lượng</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <select class="form-control" name="tags" id="exampleInput">
                                        <option value="">Lựa chọn</option>
                                        <option value="#Nhập khẩu">Còn hàng</option>
                                        <option value="#Chất lượng">Hết hàng</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Mô tả</label>
                                <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                            <button class="btn btn-light">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

?>