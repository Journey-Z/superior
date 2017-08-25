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
                            <i class="fa fa-dashboard"></i><a href="#">授权码管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> 授权码列表
                        </li>
                    </ol>
                </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="search-form">
                                    <div class="row">
                                        <div class="col-md-2 margin">
                                            <input type="text" class="form-control" name="id" value="" placeholder="授权码 ID">
                                        </div>
                                        <div class="col-md-2 margin">
                                            <input type="text" class="form-control" name="captcha" value="" placeholder="授权码">
                                        </div>
                                        <div class="col-sm-2 margin">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="start_at" class="form-control"
                                                       value="{{old('start_at')}}"
                                                       placeholder="有效期开始时间">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 margin">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="end_at" class="form-control"
                                                       value="{{old('end_at')}}"
                                                       placeholder="有效期结束时间">
                                            </div>
                                        </div>
                                        <div class="col-md-2 margin">
                                            <select class="select2 form-control" name="status">
                                                <option value=''>授权码状态</option>
                                                @foreach(\App\Models\Captcha::$status as $statusKey => $status)
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
                                            <button type="button" class="btn btn-danger btn-block" onclick="javascript:window.location.href='{{URL::route("captcha_list")}}'"><i class="fa fa-refresh"></i> 重置 </button>
                                        </div>
                                        <div class="col-md-2 margin">
                                            <a href="{{route('generate_captcha')}}" class="btn btn-success btn-block"><i class="fa fa-plus"></i> 生成授权码 </a>
                                        </div>
                                    </div>
                                </form>

                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-lg-12">
                                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr style="background-color: #f9f9f9;border-bottom:2px solid #DDDDDD;">
                                                            <th>授权码 ID</th>
                                                            <th>授权码</th>
                                                            <th>有效期开始时间</th>
                                                            <th>有效期结束时间</th>
                                                            <th>状态</th>
                                                            <th>创建时间</th>
                                                            {{--<th>操作</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($captcha as $key => $value)
                                                            <tr>
                                                                <td>
                                                                    {{$value->id}}
                                                                </td>
                                                                <td><a href="{{url('admin/generate/captcha?captcha_id='.$value->id)}}">{{$value->captcha}}</a></td>
                                                                <td>{{\App\Models\Captcha::changeTimeToLocal($value->start_at)}}</td>
                                                                <td>{{\App\Models\Captcha::changeTimeToLocal($value->end_at)}}</td>
                                                                <td>
                                                                    {{\App\Models\Captcha::displayStatus($value->status)}}
                                                                </td>
                                                                <td>{{\App\Models\Captcha::changeTimeToLocal($value->created_at)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    {{$captcha->appends(Request::all())->links()}}
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
        $('input[name=start_at]').daterangepicker();
        var start_at = "{{old('start_at')}}";
        if(!start_at){
            $('input[name=start_at]').val("");
        }

        $('input[name=end_at]').daterangepicker();
        var end_at = "{{old('end_at')}}";
        if(!end_at){
            $('input[name=end_at]').val("");
        }
    </script>

@endsection