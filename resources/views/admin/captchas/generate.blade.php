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
                            <i class="fa fa-dashboard"></i><a href="#">授权码管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> {{$title}}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form class="form-horizontal" method="post" id="captcha_form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="captcha" class="col-sm-2 control-label">授权码</label>
                            <div class="col-sm-10">
                                <input type="hidden" value="{{$captcha_id}}" name="id">
                                <input type="text" class="form-control" id="captcha" name="captcha" placeholder="授权码" value="{{$captcha ? $captcha->captcha : ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="captcha" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <p>可手动输入授权码，留空即自动生成授权码</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="daterange" class="col-sm-2 control-label">有效期</label>
                            <div class="col-sm-10 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="daterange" class="form-control" @if($captcha_id) value="" @else value="" @endif  placeholder="有效期"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="captcha_status" class="col-sm-2 control-label">是否有效</label>
                            <div class="col-sm-10">
                                <select id="captcha_status" class="form-control" name="captcha_status">
                                    <option value="">请选择</option>
                                    @foreach(\App\Models\Captcha::$status as $statusKey => $status)
                                        <option value='{{$statusKey}}' @if(isset($captcha) && $statusKey == $captcha->status) selected @endif>{{$status}}</option>
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
        //时间日期控件
        //时间日期控件
        $('input[name=daterange]').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
        });

        //提交表单新建活动
        $("#submit").on('click', function () {
            var data = $("#captcha_form").serialize();
            $.ajax({
                method: "post",
                url: "{{route('captcha.generate')}}",
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
                        $(location).prop('href', '/admin/generate/captcha?captcha_id='+data.id)
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