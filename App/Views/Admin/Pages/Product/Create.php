<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Form Basic</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Library
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm sản phẩm</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Tên</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" placeholder="First Name Here" fdprocessedid="rs4hm">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-end control-label col-form-label">Xuất sứ</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="lname" placeholder="Password Here" fdprocessedid="dmoxof">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email1" class="col-sm-3 text-end control-label col-form-label">Giá</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email1" placeholder="Company Name Here" fdprocessedid="ftndq7">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Danh mục</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cono1" placeholder="Contact No Here" fdprocessedid="br8lkd">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Sản phẩm nổi bật</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cono1" placeholder="Contact No Here" fdprocessedid="br8lkd">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group d-flex flex-column justify-content align-items-center">
                                        <div class="ql-toolbar ql-snow" style="width: 600px;"><span class="ql-formats"><span class="ql-header ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-0"><svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-0"><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="3"></span><span tabindex="0" role="button" class="ql-picker-item"></span></span></span><select class="ql-header" style="display: none;">
                                                    <option value="1"></option>
                                                    <option value="2"></option>
                                                    <option value="3"></option>
                                                    <option selected="selected"></option>
                                                </select></span><span class="ql-formats"><button type="button" class="ql-bold" fdprocessedid="sm8sst"><svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path>
                                                        <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path>
                                                    </svg></button><button type="button" class="ql-italic" fdprocessedid="jb5gakp"><svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line>
                                                    </svg></button><button type="button" class="ql-underline" fdprocessedid="ejmzq3"><svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect>
                                                    </svg></button><button type="button" class="ql-link" fdprocessedid="wqu0wl"><svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line>
                                                        <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path>
                                                        <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path>
                                                    </svg></button></span><span class="ql-formats"><button type="button" class="ql-list" value="ordered" fdprocessedid="er683a"><svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line>
                                                        <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path>
                                                        <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path>
                                                        <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path>
                                                    </svg></button><button type="button" class="ql-list" value="bullet" fdprocessedid="lyy3qw"><svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line>
                                                    </svg></button></span><span class="ql-formats"><button type="button" class="ql-clean" fdprocessedid="exvy5m"><svg class="" viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="5" x2="13" y1="3" y2="3"></line>
                                                        <line class="ql-stroke" x1="6" x2="9.35" y1="12" y2="3"></line>
                                                        <line class="ql-stroke" x1="11" x2="15" y1="11" y2="15"></line>
                                                        <line class="ql-stroke" x1="15" x2="11" y1="11" y2="15"></line>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="7" x="2" y="14"></rect>
                                                    </svg></button></span></div>
                                        <div id="editor" style="height: 100px; width: 600px" class="ql-container ql-snow">
                                            <div class="ql-editor" data-gramm="false" contenteditable="true">
                                                <p>Hello World!</p>
                                                <p>Some initial <strong>bold</strong> text</p>
                                                <p><br></p>
                                            </div>
                                            <div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>
                                            <div class="ql-tooltip ql-hidden"><a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a class="ql-action"></a><a class="ql-remove"></a></div>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">File Upload</label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="validatedCustomFile" required="">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <div class="invalid-feedback">
                                                Example invalid custom file feedback
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-success" fdprocessedid="z06sel">
                                            Thêm
                                        </button>
                                        <button type="button" class="btn btn-danger" fdprocessedid="z06sel">
                                            Làm lại 
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div> 
            </div> 
        </div>
<?php

    }
}

?>