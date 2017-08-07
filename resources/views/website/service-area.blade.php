<!-- header and footer -->
@extends('website.layouts.default')
@section('content')
	<link href="{{asset('assets/css/service.css')}}" type="text/css" rel="stylesheet" />
	
	<!-- service banner -->
	<div class="service-banner">
		<div class="detail">
			<p>We have customized the </p>
			<p>personalized service for you</p>
		</div>
		<img src="{{asset('assets/images/service-area-bn.png')}}">
	</div>
	
	<!-- 我们提供哪些服务 -->
	<div class="service-detail">
		<div class="title">
			<h1>我们可以提供的服务有哪些？</h1>
		</div>
		<div class="list clearfix">
			<div class="detail">
				<img src="{{asset('assets/images/service1.png')}}">
				<strong>产品设计</strong>
				<p>拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/service2.png')}}">
				<strong>产品设计</strong>
				<p>拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/service3.png')}}">
				<strong>产品设计</strong>
				<p>拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/service4.png')}}">
				<strong>产品设计</strong>
				<p>拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/service5.png')}}">
				<strong>产品设计</strong>
				<p>拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/service6.png')}}">
				<strong>产品设计</strong>
				<p>拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。</p>
			</div>
		</div>
	</div>

@endsection