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
                            <i class="fa fa-dashboard"></i><a href="#">Slides管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> Slides列表
                        </li>
                    </ol>
                </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="search-form">
                                    <div class="row">
                                        <div class="col-md-2 margin">
                                            <input type="text" class="form-control" name="id" value="" placeholder="Slide ID">
                                        </div>
                                        <div class="col-md-2 margin">
                                            <input type="text" class="form-control" name="name" value="" placeholder="Slide名称">
                                        </div>
                                        <div class="col-sm-2 margin">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="daterange" class="form-control"
                                                       value="{{old('daterange')}}"
                                                       placeholder="创建时间">
                                            </div>
                                        </div>
                                        <div class="col-md-2 margin">
                                            <select class="select2 form-control" name="status">
                                                <option value=''>Slide状态</option>
                                                @foreach(\App\Models\Slide::$status as $statusKey => $status)
                                                    <option value='{{$statusKey}}'>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-sm-1 margin" >
                                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> 查询 </button>
                                        </div>
                                        <div class="col-md-1 margin">
                                            <button type="button" class="btn btn-danger btn-block" onclick="javascript:window.location.href='{{URL::route("slide_list")}}'"><i class="fa fa-refresh"></i> 重置 </button>
                                        </div>
                                        <div class="col-md-2 margin">
                                            <a href="{{route('create_slide')}}" class="btn btn-success btn-block"><i class="fa fa-plus"></i> 新建Slide </a>
                                        </div>
                                    </div>
                                </form>

                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-lg-12 text-center">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table class="table table-bordered table-hover">
                                                                <thead>
                                                                <tr style="background-color: #f9f9f9;border-bottom:2px solid #DDDDDD;">
                                                                    <th>Slide ID</th>
                                                                    <th>名称</th>
                                                                    <th>图片</th>
                                                                    <th>状态</th>
                                                                    <th>创建时间</th>
                                                                    <th>操作</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($slides as $slide)
                                                                    <tr>
                                                                        <td>
                                                                            {{$slide->id}}
                                                                        </td>
                                                                        <td><a target="_blank" href="#">{{$slide->name}}</a></td>
                                                                        <td style="padding:15px;">
                                                                            <a class="fancybox" rel="gallery" href="{{$slide->image}}"
                                                                               title="{{$slide->name}}">
                                                                                <img src="{{$slide->image}}/64x64" alt="" class="product-img"
                                                                                     style="height:80px;">
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            {{\App\Models\Slide::displayStatus($slide->status)}}
                                                                        </td>
                                                                        <td>{{$slide->created_at}}</td>
                                                                        <td>
                                                                            <a target="_blank" href="#" class="btn btn-primary btn-circle">
                                                                                <i class="fa fa-edit"></i>&nbsp;详情
                                                                            </a>
                                                                            <p>
                                                                                <a target="_blank" href="#" class="btn btn-warning btn-circle" style="margin-top: 5px">
                                                                                    <i class="fa fa-plus-square-o"></i>&nbsp;&nbsp;选品
                                                                                </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 text-right">
                                                            {{$slides->appends(Request::all())->links()}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        $('input[name=daterange]').daterangepicker();
        var daterange = "{{old('daterange')}}";
        if(!daterange){
            $('input[name=daterange]').val("");
        }
    </script>

@endsection