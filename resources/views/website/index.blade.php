<!-- header and footer -->
@extends('website.layouts.default')
@section('content')

<!-- banner -->
<link href="{{asset('assets/css/index.css')}}" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{{asset('assets/js/slick.min.js')}}"></script>
<div class="banner slider single-item">
	<div>
		<div class="banner-content">
			<strong>MITIOC</strong>
			<p>为您提供高效便捷的行业标准化服务</p>
			<span>零售产品生产、材质材料开发及应用、质量保证</span>
		</div>
		<img src="{{asset('assets/images/index_banner1.png')}}" />
	</div>
	<div>
		<div class="banner-content">
			<strong>MITIOC</strong>
			<p>为您提供高效便捷的行业标准化服务</p>
			<span>零售产品生产、材质材料开发及应用、质量保证</span>
		</div>
		<img src="{{asset('assets/images/index_banner2.png')}}" />
	</div>
	<div>
		<div class="banner-content">
			<strong>MITIOC</strong>
			<p>为您提供高效便捷的行业标准化服务</p>
			<span>零售产品生产、材质材料开发及应用、质量保证</span>
		</div>
		<img src="{{asset('assets/images/index_banner3.png')}}" />
	</div>
</div>

<!-- 我们的优势 -->
<div class="advantage">
	<div class="title">
		<h1>我们的优势</h1>
	</div>
	<div class="detail clearfix">
		<div class="list">
			<img src="{{asset('assets/images/advantage1.png')}}" />
			<strong>产品包装制造</strong>
			<p>我们提供高效的产品生产管理与行业标准化的服务，为您的业务拓展及零售产品生产提供坚实的后盾。</p>
		</div>
		<div class="list">
			<img src="{{asset('assets/images/advantage2.png')}}" />
			<strong>跨行业资源整合</strong>
			<p>生产所用到的材料来自于我们多年来的技术及资源的沉淀，不同的材料与应用；木材、锡、皮革、PU、塑料等。</p>
		</div>
		<div class="list">
			<img src="{{asset('assets/images/advantage3.png')}}" />
			<strong>新材料研究与开发</strong>
			<p>为缩短商品的生产时间，我们为您提供产品的快速打样业务，更快速更便捷，同时保证质量，节约成本。</p>
		</div>
		<div class="list">
			<img src="{{asset('assets/images/advantage4.png')}}" />
			<strong>严格的产品质量控制</strong>
			<p>结合第三方的质量生产控制与生产方内部的实验及严格测试，保证了产品从开发到上市的所有环节都不出错。</p>
		</div>
		<div class="list">
			<img src="{{asset('assets/images/advantage5.png')}}" />
			<strong>创新与互动零售方式</strong>
			<p>多年来的经验，我们意识到创新的零售理念可以更多的传达出品牌的信息，从而进一步加强团队及产品的表现。</p>
		</div>
	</div>
</div>

<!-- 广告 -->
<div class="advertised">
	<div class="detail">
		<h3>一站式包装解决方案提供商</h3>
		<p>市场营销　技术创新　富有创造性　团队组织</p>
	</div>
	<img src="{{asset('assets/images/advertised.png')}}" />
</div>

<!-- 发展历程 -->
<div class="course">
	<img src="{{asset('assets/images/course-img.png')}}" />
	<h1>我们的发展历程</h1>
	<p>MIT成立于1995年，在零售行业拥有20多年的生产经营；我们是最有规模及最具效率的包装先驱，我们能够整合可变的资源和材料构成合理的解决方案。</p>		
</div>		

<!-- 产品 -->
<div class="index-products clearfix">
	<a href="#" class="list left">
		<img class="left" src="{{asset('assets/images/products.png')}}" />
		<span class="right">
			<strong>更快速</strong>
			拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。
		</span>
	</a>
	<a href="#" class="list left">
		<img class="left" src="{{asset('assets/images/products.png')}}" />
		<span class="right">
			<strong>更快速</strong>
			拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。
		</span>
	</a>
	<a href="#" class="list left">
		<img class="right" src="{{asset('assets/images/products.png')}}" />
		<span class="left">
			<strong>更快速</strong>
			拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。
		</span>
	</a>
	<a href="#" class="list left">
		<img class="right" src="{{asset('assets/images/products.png')}}" />
		<span class="left">
			<strong>更快速</strong>
			拼团的火爆大概是从2015年开始，但是在2016年势头较猛，红遍大江南北。17继续向更加深入的次级城市蔓延。
		</span>
	</a>
</div>	


<!-- 我们的合作伙伴 -->
<div class="cooperation">
	<div class="title">
		<h1>我们的合作伙伴</h1>
	</div>
	<div class="slider cooperation-item">
		<div><img src="{{asset('assets/images/cooperation1.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation2.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation3.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation4.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation5.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation6.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation7.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation8.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation9.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation10.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation11.png')}}" /></div>
		<div><img src="{{asset('assets/images/cooperation12.png')}}" /></div>
	</div>
	
	

</div>		


<script type="text/javascript">
	$('.single-item').slick({
	    dots: true,
	    autoplay:true,
	    autoplaySpeed:3000,
	    arrows:false
    });

    $('.cooperation-item').slick({
	    lazyLoad: 'ondemand',
  		slidesToShow: 6,
  		slidesToScroll: 1
    });

    // 
    $(window).scroll(function(){
	    var winH = $(window).height(),
	    	scrollH = $(window).scrollTop();

	    // 广告 
	    var Advertised = $('.advertised').offset().top;
	    // 优势
	    var Advantage = $('.advantage').offset().top;
	    // 历程
	    var Course = $('.course').offset().top;
	    //产品
	    var Products = $('.index-products').offset().top;

    	if(Advertised < (scrollH + winH) - Advertised/3){
    		$('.advertised').addClass('show')
    	}else{
    		// $('.advertised').removeClass('show')
    	}

    	if(Advantage < (scrollH + winH) - Advertised/3){
    		$('.advantage').addClass('show')
    	}else{
    		// $('.advantage').removeClass('show')
    	}

    	if(Course < (scrollH + winH) - Course/3){
    		$('.course').addClass('show')
    	}else{
    		// $('.course').removeClass('show')
    	}

    	if(Products < (scrollH + winH) - Products/6){
    		$('.index-products').addClass('show')
    	}else{
    		// $('.index-products').removeClass('show')
    	}
    })
</script>
@endsection