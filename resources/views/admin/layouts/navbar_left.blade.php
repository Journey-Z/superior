<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="/admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> 验证码管理 <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="#"><i class="fa fa-fw fa-wrench"></i>生成验证码</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-table"></i>验证码列表</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('charts')}}"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
        </li>
        <li>
            <a href="{{route('tables')}}"><i class="fa fa-fw fa-table"></i> Tables</a>
        </li>
        <li>
            <a href="{{route('forms')}}"><i class="fa fa-fw fa-edit"></i> Forms</a>
        </li>
        <li>
            <a href="{{route('bootstrap-elements')}}"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
        </li>
        <li>
            <a href="{{route('bootstrap-grid')}}"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('blank-page')}}"><i class="fa fa-fw fa-file"></i> Blank Page</a>
        </li>
    </ul>
</div>



<!-- /.navbar-collapse -->
<!-- Bootstrap Core JavaScript -->
@section("scripts")
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
@endsection