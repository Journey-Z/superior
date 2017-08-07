<!-- header and footer -->
@extends('website.layouts.default')
@section('content')
	<link href="{{asset('assets/css/strengths.css')}}" type="text/css" rel="stylesheet" />
	<!-- about banner -->
	<div class="strengths-banner">
		<div class="detail">
			<h1>一站式包装解决方案提供商</h1>
			<p>市场营销　技术创新　富有创造性　团队组织</p>
		</div>
		<img src="{{asset('assets/images/strengths-bn.png')}}">
	</div>

	<!-- products -->
	<div class="products-list clearfix">
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro1.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro2.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro3.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro4.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro5.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro6.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro7.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro8.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro9.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro10.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro11.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro12.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro13.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro14.png')}}">
			<strong>文字</strong>
		</div>
		<div class="img">
			<img src="{{asset('assets/images/strengths-pro15.png')}}">
			<strong>文字</strong>
		</div>
	</div>

	<!-- 我们的能力 -->
	<div class="ability">
		<div class="title">
			<h1>我们的能力</h1>
		</div>
		<div class="ability-list clearfix">
			<div class="detail">
				<img src="{{asset('assets/images/ability1.png')}}">
				<strong>产品包装制造</strong>
				<p>提供高效的产品生产管理与行业标准化的服务。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/ability2.png')}}">
				<strong>跨行业资源整合</strong>
				<p>不同的材料与应用；木材、锡、皮革、PU、塑料等。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/ability3.png')}}">
				<strong>新材料研究与开发</strong>
				<p>快速打样，更快速更便捷，同时保证质量，节约成本。</p>
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/ability4.png')}}">
				<strong>严格的产品质量控制</strong>
				<p>第三方的质量生产控制与生产内部的实验及严格测试。</p>
			</div>
			<div class="clearfix">
				
			</div>
			<div class="detail">
				<img src="{{asset('assets/images/ability5.png')}}">
				<strong>创新与互动零售方式</strong>
				<p>创新的零售理念传达品牌的信息，加强产品的表现。</p>
			</div>
		</div>
	</div>

	<!-- 广告 -->
	<div class="strengths-think">
		<h1>THINK GLOBALLY  EXECUTE LOCALLY</h1>
		<div class="think-list clearfix">
			<div class="detail">
				BRAND CREATIVITY  
			</div>
			<div class="detail">
				MARKET RESOURCES / MATERIALS  
			</div>
			<div class="detail">
				UNIQUE PACKAGING   
			</div>
		</div>
		<p>We integrated the brand creativity into product packaging design by leveraging different materials to transfer a standard packaging into a unique brand ambassador, which help express brand message and proactively engage with targets.</p>
	</div>

	<!-- 包装一体化 -->
	<div class="packing-unity">
		<div class="title">
			<h1>包装一体化</h1>
		</div>
		<ul class="clearfix">
		    <li>
		    	<img src="{{asset('assets/images/packing-unity1.png')}}" />
	    		<div class="detail">
	    			<h1>NFC</h1>
		    		<P>感应下产品，就可以快速的出现我们的网站或是产品视频及图片，展现跟多可能。</P>
	    		</div>
		    </li>
		    <li>
		    	<img src="{{asset('assets/images/packing-unity2.png')}}" />
	    		<div class="detail">
	    			<h1>人脸识别</h1>
		    		<P>通过人脸来识别客户，建立自己的数据库，根据这些信息企业可制定更精致的营销活动。</P>
		    	</div>
		    </li>
		    <li>
		    	<img src="{{asset('assets/images/packing-unity3.png')}}" />
		    	<div class="detail">
	    			<h1>二维码</h1>
		    		<P>扫一扫产品，可以出现我们的产品信息，可以引导用户关注公司微博、微信等各平台宣传的渠道。</P>
		    	</div>
		    </li>
		    <li>
		    	<img src="{{asset('assets/images/packing-unity4.png')}}" />
		    	<div class="detail">
	    			<h1>AR</h1>
		    		<P>扫一扫产品，或者所有印有产品LOGO及特征海报、贴纸等可以出现产品的宣传动画、视频、产品手册。</P>
		   	 	</div>
		    </li>
		    <li>
		    	<img src="{{asset('assets/images/packing-unity5.png')}}" />
		    	<div class="detail">
	    			<h1>3D快速建模</h1>
		    		<P>二维的商品展示无法带来线下购物所具有的直观、立体的产品体验，三维物品有更强的带入感。</P>
		    	</div>
		    </li>
		</ul>
		<div class="unity-img">
	    	<img src="{{asset('assets/images/process-img.png')}}" />
		</div>
	</div>
@endsection