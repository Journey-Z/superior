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
                            <i class="fa fa-dashboard"></i><a href="#">分类管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> {{$title}}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form class="form-horizontal" method="post" id="category_form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if($category_names)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">叶子类目结构</label>
                            <div class="col-sm-10">
                                <span>{{$category_names}}</span>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">中文名称</label>
                            <div class="col-sm-10">
                                <input type="hidden" value="{{$category_id}}" name="id">
                                <input type="hidden" value="{{$parent_id ?: 0}}" name="parent_id">
                                <input type="text" class="form-control" id="name" name="name" placeholder="中文名称" value="{{$category ? $category->name : ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="eng_name" class="col-sm-2 control-label">英文名称</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="eng_name" placeholder="" name="eng_name" style="margin-left:0px;width: calc(100% - 0px);" >{{$category ? $category->eng_name : ''}}</textarea>
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

        //提交表单新建活动
        $("#submit").on('click', function () {
            var data = $("#category_form").serialize();
            $.ajax({
                method: "post",
                url: "{{route('category.createOrUpdate')}}",
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
                        $(location).prop('href', '/admin/create/category?category_id='+data.id)
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