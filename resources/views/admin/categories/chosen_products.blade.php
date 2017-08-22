@extends('admin.layouts.default')
@section('content')
    <style type="text/css">
        .wrapper{
            height:auto !important;
        }
        .margin{margin:10px 0;}
    </style>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
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
                            <i class="fa fa-desktop"></i> 已添加到该分类的商品
                        </li>
                    </ol>
                </div>
            </div>
            <section class="content">
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12">
                        <p>
                            <button type="button" class="btn btn-lg btn-success" id="delete_button">删除商品</button>
                            <input type="hidden" value="{{$category_id}}" name="category_id">
                        </p>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                <tr style="background-color: #f9f9f9;border-bottom:2px solid #DDDDDD;">
                                                    <th>
                                                        <input type="checkbox" class="check_all"/>
                                                        商品 ID
                                                    </th>
                                                    <th>名称</th>
                                                    <th>中文描述</th>
                                                    <th>英文描述</th>
                                                    <th>图片</th>
                                                    <th>状态</th>
                                                    <th>创建时间</th>
                                                    {{--<th>操作</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" class="table-checkbox" value="{{$product->id}}" />
                                                            {{$product->id}}
                                                        </td>
                                                        <td><a href="{{url('admin/create/product?product_id='.$product->id)}}">{{$product->name}}</a></td>
                                                        <td>{!! $product->cn_description !!}</td>
                                                        <td>{!! $product->eng_description !!}</td>
                                                        <td style="padding:15px;">
                                                            <a class="fancybox" rel="gallery" href="{{$product->image}}"
                                                               title="{{$product->name}}">
                                                                <img src="{{$product->image}}" alt="" class="product-img"
                                                                     style="height:80px;">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{\App\Models\Product::displayStatus($product->status)}}
                                                        </td>
                                                        <td>{{\App\Models\Product::changeTimeToLocal($product->created_at)}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            {{$products->appends(Request::all())->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('input[name=daterange]').daterangepicker();
        var daterange = "{{old('daterange')}}";
        if(!daterange){
            $('input[name=daterange]').val("");
        }

        $(document).on("click",".check_all",function(){
            $(".table-checkbox").each(function(){
                if($(this).is(":checked")){
                    $(this).prop("checked",false);
                } else {
                    $(this).prop("checked",true);
                }
            })
        });

        $("#delete_button").on("click", function () {
            var ids = [];
            $(".table-checkbox").each(function () {
                if ($(this).is(":checked")) {
                    var id = $(this).val();
                    ids.push(id);
                }
            });
            console.log(ids);
            if (ids.length <= 0) {
                toastr.warning("请选择至少一个商品进行添加");
                return false
            }
            var data = {
                '_token' : "{{ csrf_token() }}",
                'category_id' : "{{$category_id}}",
                'ids' : ids
            };
            $.ajax({
                method: "post",
                url: "{{route('category.delete_products')}}",
                data: data,
                beforeSend: function () {
                    // 禁用按钮防止重复提交
                    $("#delete_button").html('<i class="fa fa-spin fa-refresh"></i>正在提交...');
                    $("#delete_button").attr({ disabled: "disabled" });
                },
                success: function (data) {
                    if (data.status) {
                        toastr.success('保存成功!');
                        $("#delete_button").removeAttr("disabled");
                        $(location).prop('href', '/admin/category/choose_products?category_id='+data.id)
                    } else {
                        $("#delete_button").removeAttr("disabled");
                        $("#delete_button").html("删除商品");
                        toastr.warning(data.msg, "保存失败");
                        return false;
                    }
                }
            });
        });
    </script>

@endsection