<!-- header and footer -->
@extends('website.layouts.default')
@section('content')
	<link href="{{asset('assets/css/about.css')}}" type="text/css" rel="stylesheet" />
	<!-- about banner -->
	<div class="about-banner">
		<img src="{{asset('assets/images/about-bn.png')}}">
	</div>

	<!-- about-content -->
	<div class="about-content">
		<div class="detail clearfix">
			<img class="right" src="{{asset('assets/images/about-content1.png')}}">
			<div>
				<h1>我们的目标</h1>
				<strong>一切皆有可能</strong>
				<p>我们在这里寻求机会，并通过不同的材料与资源整合来了解不同商品的生产过程；我们永远不会放弃、并保持对新事物的好奇心，不断尝试，直到攻克难关；不断的解决问题并创新。</p>
<p>为了制作独特的包装，我们不断扩展业务与客户，同时也希望大客户的业务加入进来。</p>
			</div>
		</div>
		<div class="detail clearfix">
			<img class="left" src="{{asset('assets/images/about-content2.png')}}">
			<div>
				<h1>第一印象的重要性</h1>
				<strong>产品的包装长久以来一直是第一个吸引消费者注意的品牌大使。</strong>
				<p>良好的产品包装设计跟合适的材质搭配使用是可以传达产品的特质及灵魂，同时也会进一步的营造出产品的故事。一个高质量，高质感的产品对品牌及产品的影响度可想而知。这些不仅仅是我们的工作，同时也是我们作为一个包装行业的从业人员价值的体现。</p>
			</div>
		</div>
	</div>

	<!-- mitioc -->
	<div class="about-mitioc">
		<div class="about-mitioc-logo">
		<img width="217" src="{{asset('assets/images/about-logo.png')}}">
		</div>
		<ul class="clearfix">
		    <li><img src="{{asset('assets/images/about-mitioc1.png')}}"></li>
		    <li><img src="{{asset('assets/images/about-mitioc2.png')}}"></li>
		    <li><img src="{{asset('assets/images/about-mitioc3.png')}}"></li>
		    <li><img src="{{asset('assets/images/about-mitioc4.png')}}"></li>
		    <li><img src="{{asset('assets/images/about-mitioc5.png')}}"></li>
		</ul>
		<p class="en"><span>一站式包装</span>解决方案提供者</p>
		<p class="ch"><span>A-ONE-STOP PACKAING</span>SOLUTION PROVIDER</p>
	</div>

	<!-- 我们的工厂 -->
	<div class="about-factory">
		<h3>我们的工厂</h3>
		<div class="factory-video-list">
			<div class="video-detail">
				
				<video controls="controls" autoplay="autoplay">
				  	<source src="{{asset('assets/video/LEATHER.mp4')}}" type="video/mp4" />
					Your browser does not support the video tag.
				</video>

			</div>
		</div>
	</div>


@endsection