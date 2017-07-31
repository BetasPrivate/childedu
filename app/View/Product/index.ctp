<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="css/common.css" type="text/css" />
		<link rel="stylesheet" href="css/mui.min.css">
		<title>玩子小铺</title>
		<style>
			@font-face {
				font-family:"DFPHannotateW5-GB";
				src: url("font/DFPHannotateW5-GB.ttf");
			}
			body {
				max-width: 750px;
				min-width: 320px;
				margin:0 auto;
				font-family: "DFPHannotateW5-GB";
			}
			dl,dd,dt {
				margin:0;
				padding:0;
				list-style: none;
			}
			.home {
				width:100%;
			}
			/*轮播图*/
			header img {
				width:100%;
				display: block;
			}
			.mui-slider-indicator .mui-indicator {
				background:rgba(0,0,0,0);
				border:solid 1px #f39223;
				height:0.25rem;
				width:0.25rem;
			}
			.mui-slider  .mui-slider-indicator .mui-indicator.mui-active {
				background:#f39223;
			}
			.main {
				position:relative;
			}
			.main dl dd {
				width:50%;
				float: left;
				line-height: 2.2rem;
				color:333333;
				font-size:0.8rem;
				background-color: #cdcdcd;
				text-align: center;
				font-family: "微软雅黑";
			}
			.main dl dd.selected {
				background-color: #f59121;
				color:#ffffff;
			}
			.main ul {
				width:95%;
				position:absolute;
				top:2.2rem;
				left:2.5%;
				display:none;
			}
			.main ul.active {
				display: block;
			}
			.main ul i {
				position:absolute;
				background-color: #d7d7d7;
				width:1px;
				height:100%;
				top:0;
				left:50%;
			}
			.main ul li {
				box-sizing: border-box;
				width:50%;
				padding-left:0.2rem;
				float: left;
				border-bottom: 1px solid #d7d7d7;
			}
			.main ul li img {
				width:96.5%;
				margin-top:0.5rem;
				display: block;
			}
			.main ul li h2 {
				font-size:0.8rem;
				line-height:2.5rem;
				margin-bottom: 0.5rem;
				color:#333;
			}
			.main ul li h2 em {
				float: left;
				width:60%;
				height:2.5rem;
				white-space:nowrap; 
				overflow: hidden;
				text-overflow:ellipsis;
			}
			.main ul li h2 span {
				font-size:0.6rem;
				color:#8f591b;
				float: right;
				margin-right:0.3rem;
			}
			.main ul li h3 a {
				display: block;
				width:77%;
				margin:0 auto 0.8rem;
				height:1.225rem;	
			}
			.main ul li h3 a.gift_enter {
				background: url(img/eleven_btn_button_1.jpg);
				background-size: 100%;
				-webkit-background-size: 100%;
			}
			.main ul li h3 a.lesson_enter {
				background: url(img/eleven_pic_button_2.jpg);
				background-size: 100%;
				-webkit-background-size: 100%;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<!--轮播图-->
			<!--<header>
				<img src="img/eleven_header_pic.jpg" />
			</header>-->
			<header id="slider" class="mui-slider" >
				<div class="mui-slider-group mui-slider-loop">
					<!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="#">
							<img src='<?php echo $result["products"]["front_page_products"][2]["Product"]["pic_url1"];?>'>
						</a>
					</div>
					<?php foreach($result['products']['front_page_products'] as $key => $product):?>
					<!-- 第一张 -->
					<div class="mui-slider-item">
						<a href="/product/detail">
							<img src='<?php echo $product["Product"]["pic_url1"];?>'>
						</a>
					</div>
					<?php endforeach;?>
					<!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="/product/detail">
							<img src='<?php echo $result["products"]["front_page_products"][0]["Product"]["pic_url1"];?>'>
						</a>
					</div>
				</div>
				<div class="mui-slider-indicator">
					<div class="mui-indicator mui-active"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
				</div>
			</header>
			<!--选项卡-->
			<section class="main">
				<dl class="clearfix">
					<dd class="gift_button selected">玩子礼物</dd>
					<dd class="lesson_button">在线课程</dd>
				</dl>
				<ul class="clearfix gift active">
					<?php if(sizeof($result['products']['real_products']) == 0):?>
						<h3>此类目下暂无商品</h3>
					<?php endif;?>
					<i></i>
					<?php foreach($result['products']['real_products'] as $key => $product):?>
					<li>
						<img src='<?php echo $product["Product"]["pic_url1"];?>'/>
						<h2 class="clearfix"><em><?php echo $product['Product']['name'];?></em><span><?php echo $product["Product"]["price"];?>丸子币</span></h2>
						<h3>
							<a href="/product/detail/<?php echo $product['Product']['id'];?>" class="gift_enter"></a>
						</h3>
					</li>
					<?php endforeach;?>
				</ul>
				<ul class="clearfix lesson">
					<?php if(sizeof($result['products']['virtual_products']) == 0):?>
						<h3>此类目下暂无商品</h3>
					<?php endif;?>
					<i></i>
					<?php foreach($result['products']['virtual_products'] as $key => $product):?>
					<li>
						<img src="<?php echo $product['Product']['pic_url1'];?>" />
						<h2 class="clearfix"><em><?php echo $product['Product']['name'];?></em><span><?php echo $product['Product']['price'];?>丸子币</span></h2>
						<h3>
							<a href="/product/detail/<?php echo $product['Product']['id'];?>" class="lesson_enter"></a>
						</h3>
					</li>
					<?php endforeach;?>
				</ul>
			</section>
		</section>
		<script src="js/jquery-3.2.1.min.js"></script>
		<script>
			$(document).ready(function(){
				$(".main dl dd").click(function(){
					$(".main dl dd").removeClass("selected");
					$(".main ul").removeClass("active");
					$(this).addClass("selected");
					if($(".main dl dd.gift_button").hasClass("selected")){
						$(".main ul.gift").addClass("active");
					}
					if($(".main dl dd.lesson_button").hasClass("selected")){
						$(".main ul.lesson").addClass("active");
					}
				});
			})
		</script>
		<!--轮播-->
		<script src="js/mui.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			mui.init({
				swipeBack:true //启用右滑关闭功能
			});
			var slider = mui("#slider");
			slider.slider({
				interval: 5000//每隔5秒换一次图片
			});
		</script>
	</body>
</html>
