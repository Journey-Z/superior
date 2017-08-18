@extends('admin.layouts.default')
@section('content')
    <link href="{{asset('assets/css/base-file.css')}}" rel="stylesheet">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        {{$title}}
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i><a href="#">Slides管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> {{$title}}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="slide_name" class="col-sm-2 control-label">Slide名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="slide_name" name="name" placeholder="Slide名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"><span class="required">* &nbsp;</span>海报上传: </label>
                            <div class="col-sm-10 release-input">
                                <input type="hidden" id="slide_image" name="banner" value="">
                                <ul class="addimg-ul">
                                        <li>
                                            <div class="add-img product_icon">
                                                <input type="file" class="upload_img add-img-file" name="img_file"><i class="fa fa-image"></i>添加图片
                                            </div>
                                        </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset ("/assets/js/jquery.form.js") }}"></script>
    <script type="text/javascript">
        //上传图片
        $('.addimg-ul').delegate('.upload_img', 'change', function(){
            var _this = $(this);
            var addimg = $(this).parent().parent().parent(".addimg-ul");
            //生成的图片div包裹节点
            var addimgHtml = '';
            var img_name = _this.attr("name");
            var url = '/admin/slide/upload';
            _this.wrap("<form id="+img_name+" action="+url+" method='post' enctype='multipart/form-data'></form>");
            $("#"+img_name).ajaxSubmit({
                dataType:  'json',
                data: {
                    "_token": "{{Session::token()}}",
                    "img_name": img_name
                },
                beforeSend: function() {
                    _this.parent().append('<i class="fa fa-image"></i>正在上传...')
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    console.log('进度'+percentComplete);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        toastr.success('图片上传成功');
                        addimg.find('li:last').remove();
                        //生成商品主图
                        addimgHtml += generateProductMainPicture(data.img_url);
                        addimg.append(addimgHtml);
                        $("#slide_image").val(data.img_url);
                        addimgHtml = '';
                    } else {
                        toastr.warning(data.errMsg, "图片上传失败");

                    }
                },
                error:function(xhr){
                    toastr.warning(xhr.responseText, "图片上传失败");
                }
            });
        });
        //上传图片成功后显示图片
        var generateProductMainPicture = function(img_url){
            return '<li class="exist_img">'
                + '<div class="add-img product_icon">'
                + '<img src="'+ img_url +'" alt=""><i class="fa fa-trash-o product-delete-property" onclick="delPicture()"></i>'
                + '</div>'
                + '</li>'
        }

        function delPicture(){
            var html = '<input type="file" class="upload_img add-img-file" name="img_file"><i class="fa fa-image"></i>添加图片';
            $('div[class="add-img product_icon"]').html(html);
            $('#slide_image').val('');
        }
    </script>
@endsection