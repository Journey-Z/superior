<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mitioc Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('assets/css/sb-admin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('assets/css/plugins/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- bootstrap daterangepicker -->
    <link href="{{asset('/assets/plugins/adminlte/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />

    <link href="{{asset('/assets/plugins/adminlte/plugins/select2/select2.min.css')}}" rel="stylesheet" />

    <link href="{{asset('/assets/plugins/toastr/toastr.css')}}" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    @include('admin.layouts.navigation')

    @yield('content')
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/plugins/adminlte/plugins/daterangepicker/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/adminlte/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/adminlte/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<!-- Select2 -->
<script src="{{ asset ('/assets/plugins/adminlte/plugins/select2/select2.full.min.js')}}" type="text/javascript"></script>
<!-- toastr -->
<script src="{{ asset ('/assets/plugins/toastr/toastr.min.js')}}" type="text/javascript"></script>
<!-- fancybox start -->
<!-- Add mousewheel plugin (this is optional) -->
<script src="{{asset('/assets/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js')}}"></script>
<!-- Add fancyBox -->
<link rel="stylesheet" href="{{asset('/assets/plugins/fancybox/source/jquery.fancybox.css?v=2.1.5')}}" type="text/css" media="screen" />
<script src="{{asset('/assets/plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.5')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
@yield('scripts')
<script>
    $(function () {

        //Initialize Select2 Elements
        $(".select2").select2();

        //fancybox view image
        $(".fancybox").fancybox({
            openEffect	: 'none',
            closeEffect	: 'none'
        });

        //support ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var columns = {
            startDate: startDate,
            endDate: endDate,
            "autoApply": false,
            "opens": "center",
            autoUpdateInput: false, //set did not auto update input
            locale:{
                format: "YYYY-MM-DD",
                separator: ' - ',
                applyLabel: '{{trans('确定')}}',
                cancelLabel: '{{trans('取消')}}',
                weekLabel: 'W',
                customRangeLabel: '{{trans('自定义日期范围')}}',
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.monthsShort(),
                firstDay: moment.localeData().firstDayOfWeek()
            },
            ranges: {
                '今天': [moment(), moment()],
                '昨天': [moment().subtract(1, 'days'), moment().subtract(1,'days')],
                '过去7天': [moment().subtract(6, 'days'), moment()],
                '本月': [moment().startOf('month'), moment().endOf('month')]
            }
        };
        //Date range picker
        var start_at = $("input[name='start_at']"),
            end_at = $("input[name='end_at']"),
            daterange = $("input[name='date_range']"),daterange2 = $("input[name='date_range2']");
        var startDate = start_at.val(),endDate = end_at.val();
        @if(\Illuminate\Support\Facades\Input::get('date_range2'))
           daterange2.val("{{\Illuminate\Support\Facades\Input::get('date_range2')}}");
        @endif
        @if(\Illuminate\Support\Facades\Input::get('date_range'))
         daterange.val("{{\Illuminate\Support\Facades\Input::get('date_range')}}");
        @else
            startDate = start_at.data('default');
        endDate = end_at.data('default');
        @endif
        daterange.daterangepicker(columns).on('cancel.daterangepicker', function(ev, picker) {
            //$(this).val(''); //click cancel button
        }).on('apply.daterangepicker', function(ev, picker) {
            $(this).focus();
            $(this).val(picker.startDate.format(picker.locale.format)+picker.locale.separator+picker.endDate.format(picker.locale.format));
            $(this).blur();
            picker.hide();
        });
        daterange2.daterangepicker(columns).on('cancel.daterangepicker', function(ev, picker) {
            //$(this).val(''); //click cancel button
        }).on('apply.daterangepicker', function(ev, picker) {
            $(this).focus();
            $(this).val(picker.startDate.format(picker.locale.format)+picker.locale.separator+picker.endDate.format(picker.locale.format));
            $(this).blur();
            picker.hide();
        });
        /**单选日期***/
        $('#date_single').datepicker({
            format: 'yyyy-mm-dd',
            language:'ch',
            autoclose:true,
            pickDate: true,
            pickTime: false
        });
        //search form filter empty value
        $(".search-form").on("submit", function () {
            // disable empty inputs/selector
            $("input", $(this)).each(function () {
                if ($(this).val() == "") {
                    $(this).attr('disabled', "disabled");
                }
            });
            $("select", $(this)).each(function () {
                var selected = $("option:selected", $(this)).val();
                if (selected == "") {
                    $(this).attr("disabled", "disabled");
                }
            });
        });

        //Set toastr's option ,link https://github.com/CodeSeven/toastr
        toastr.options.timeOut = 2000; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 6000; // How long the toast will display after a user hovers over it
        toastr.options.progressBar = true;

        $('div.alert').delay(2500).slideUp(300);//toastr Voice
    });

</script>
</body>

</html>
