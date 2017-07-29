<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MITIOC</title>
	<link href="{{asset('assets/images/mit.ico')}}" rel="shortcut icon" />
	<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
	<link href="{{asset('assets/css/default.css')}}" type="text/css" rel="stylesheet" />
</head>
<body>
	<!-- header -->
	@include('website.layouts.header')

	<!-- main -->
	@yield('content')

	<!-- footer -->
	@include('website.layouts.footer')
</body>
</html>