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
                            <i class="fa fa-dashboard"></i><a href="#">商品管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> {{$title}}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form class="form-horizontal" method="post" id="product_form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="product_name" class="col-sm-2 control-label">商品名称</label>
                            <div class="col-sm-10">
                                <input type="hidden" value="{{$product_id}}" name="id">
                                <input type="text" class="form-control" id="product_name" name="name" placeholder="商品名称" value="{{$product ? $product->name : ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_cn" class="col-sm-2 control-label">中文描述</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="product_cn" placeholder="" name="cn_desc" style="margin-left:0px;width: calc(100% - 0px);" >{{$product ? $product->cn_description : ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_eng" class="col-sm-2 control-label">英文描述</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="product_eng" placeholder="" name="eng_desc" style="margin-left:0px;width: calc(100% - 0px);" >{{$product ? $product->eng_description : ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"><span class="required">* &nbsp;</span>海报上传: </label>
                            <div class="col-sm-10 release-input">
                                <input type="hidden" id="product_image" name="banner" value="{{$product ? $product->image : ''}}">
                                <ul class="addimg-ul">
                                    @if($product)

                                        <li class="exist_img">
                                            <div class="add-img product_icon">
                                                <img src="{{$product ? $product->image : ''}}" alt="">
                                                <i class="fa fa-trash-o product-delete-property" onclick="delPicture()"></i>
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            <div class="add-img product_icon">
                                                <input type="file" class="upload_img add-img-file" name="img_file"><i class="fa fa-image"></i>添加图片
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_status" class="col-sm-2 control-label">是否有效</label>
                            <div class="col-sm-10">
                                <select id="product_status" class="form-control" name="product_status">
                                    <option value="">请选择</option>
                                    @foreach(\App\Models\Product::$status as $statusKey => $status)
                                        <option value='{{$statusKey}}' @if(isset($product) && $statusKey == $product->status) selected @endif>{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-lg btn-primary" id="submit">保存</button>
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
            var url = '/admin/product/upload';
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
                        $("#product_image").val(data.img_url);
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
            $('#product_image').val('');
        }

        //提交表单新建活动
        $("#submit").on('click', function () {
            var data = $("#product_form").serialize();
            $.ajax({
                method: "post",
                url: "{{route('product.createOrUpdate')}}",
                data: data,
                beforeSend: function () {
                    // 禁用按钮防止重复提交
                    $("#submit").html('<i class="fa fa-spin fa-refresh"></i>正在提交...');
                    $("#submit").attr({ disabled: "disabled" });
                },
                success: function (data) {
                    if (data.status) {
                        toastr.success('保存成功!');
                        $("#submit").removeAttr("disabled");
                        $(location).prop('href', '/admin/create/product?product_id='+data.id)
                    } else {
                        $("#submit").removeAttr("disabled");
                        $("#submit").html("确认并保存");
                        toastr.warning(data.msg, "保存失败");
                        return false;
                    }
                },
                error: function (data) {
                    var json=eval("("+data.responseText+")");
                    $("#submit").removeAttr("disabled");
                    $("#submit").html("确认并保存");
                    toastr.warning(json.error, "缺少必要信息，请重试!");
                },
                complete: function (data) {
                    $("#submit").html('<i class="fa fa-check"></i>保存');
                }
            });
            return false;
        });
    </script>
@endsection