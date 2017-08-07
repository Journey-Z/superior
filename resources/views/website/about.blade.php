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
		<h3><span>我们的工厂</span></h3>
		<div class="factory-video-list clearfix">
			<div class="video-detail">
				<a href="javascript:;"><img src="{{asset('assets/images/play-icon.png')}}"></a>
				<img src="{{asset('assets/images/video-img.png')}}">
				<strong>皮具工厂</strong>
				<p>通过ISO9001 2000 2007年更新ISO9001 2000 2010年更新ISO9001 2008 占地面积11200平方英尺，拥有500名员工。</p>
			</div>
			<div class="video-detail">
				<a href="javascript:;"><img src="{{asset('assets/images/play-icon.png')}}"></a>
				<img src="{{asset('assets/images/video-img.png')}}">
				<strong>纸制品工厂</strong>
				<p>完成SEDEX 4-Pillar inspection通过ISO9001:2008。获得NQA认证(BRC全球标准) 德国进口线罗兰700电脑六色机。</p>
			</div>
			<div class="video-detail">
				<a href="javascript:;"><img src="{{asset('assets/images/play-icon.png')}}"></a>
				<img src="{{asset('assets/images/video-img.png')}}">
				<strong>木制品工厂</strong>
				<p>成立于2001年。 有4000平方米的面 积。 120名熟练工人。</p>
			</div>
			<div class="video-detail">
				<a href="javascript:;"><img src="{{asset('assets/images/play-icon.png')}}"></a>
				<img src="{{asset('assets/images/video-img.png')}}">
				<strong>马口铁工厂</strong>
				<p>成立于1993年。占地面积15000 多平方米。拥有2500名工人。机械设备 1000台.ISO9001:2000国 际质量体系认证。</p>
			</div>
			<div class="video-detail">
				<a href="javascript:;"><img src="{{asset('assets/images/play-icon.png')}}"></a>
				<img src="{{asset('assets/images/video-img.png')}}">
				<strong>塑料包装工厂</strong>
				<p>
自1989年以来公司面积:20000m² 仓库面积:3600m² 员工人数:1000多 名熟练员工 生产能力:每月 300X40HQ</p>
			</div>
		</div>
	</div>
	<div class="show-video">
		<div class="video-play-detail">
			<video autobuffer controls >
				<source src="{{asset('assets/video/LEATHER.mp4')}}">
			</video>
		</div>
		<div class="video-play-detail">
			<video autobuffer controls id="au-video">
				<source src="{{asset('assets/video/PAPER-PRODUCTION-VIDEO-REEL.mp4')}}">
			</video>
		</div>
		<div class="video-play-detail">
			<video autobuffer controls id="au-video">
				<source src="{{asset('assets/video/PLASTICS.mp4')}}">
			</video>
		</div>
		<div class="video-play-detail">
			<video autobuffer controls id="au-video">
				<source src="{{asset('assets/video/TIN.mp4')}}">
			</video>
		</div>
		<div class="video-play-detail">
			<video autobuffer controls id="au-video">
				<source src="{{asset('assets/video/WOODWARE.mp4')}}">
			</video>
		</div>
	</div>


	<!-- 我们的视频 -->
	<div class="about-my-video">
		<div class="title"><h1>我们的视频</h1></div>
		<div class="video-detail">
			<div id="video-btn"></div>
			<video autobuffer controls id="au-video">
				<source src="{{asset('assets/video/LEATHER.mp4')}}">
			</video>
		</div>
		
	</div>

	<script type="text/javascript">
		
		var AbVideoBtn = document.getElementById('video-btn');
		var the = true;
		AbVideoBtn.onclick = function (){
			videoPlay()
		}

		function videoPlay(){
			var AbVideo = document.getElementById('au-video');
			if(the){
				AbVideo.play()
			}else{
				AbVideo.pause()
			}
			the = !the
		}

		var videoListBtn = $('.factory-video-list a');
		videoListBtn.click(function(){
			var this_Index = $(this).parent().index();
			$(".show-video").fadeIn();
			console.log(this_Index)
			$('.video-play-detail').eq(this_Index).show();
		})

	</script>

@endsection