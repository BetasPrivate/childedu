<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>礼物详情</title>
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
		<link rel="stylesheet" href="/css/mui.min.css">
		<style>
			@font-face {
				font-family:"DFPHannotateW5-GB";
				src: url("/font/DFPHannotateW5-GB.ttf");
			}
			body {
				max-width: 750px;
				min-width: 320px;
				margin:0 auto;
				/*font-family: "DFPHannotateW5-GB";*/
				background-color: #f2f2f2;
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
			/*上半部*/
			.top {
				width:100%;
				border-top: solid 1px #d7d7d7;
				margin-bottom: 0.5rem;
				background-color: #ffffff;
			}
			.top h2 {
				width:90%;
				padding:0 5%;
				font-size: 0.8rem;
				line-height:1rem;
				margin-top:0.5rem;
				color:#333333;
			}
			.top h3 {
				width:90%;
				padding:0 5%;
				line-height:2.5rem;
				color:#f65304;
			}
			.top h3 span {
				font-size:1.4rem;
				font-weight: bold;
			}
			.top h3 em {
				font-size: 0.8rem;
			}
			.top h3 i {
				font-size: 0.6rem;
				color:#999999;
				text-decoration: line-through;
				padding-left: 0.5rem;
			}
			.top h4 {
				width:90%;
				padding:0 5%;
				margin-top:0.4rem;
				line-height: 1.7rem;
			}
			.top h4 span {
				font-size: 0.65rem;
				color:#999999;
				width:50%;
				float: left;
			}
			.top h4 em {
				font-size: 0.65rem;
				color:#333333;
			}
			.top h5 {
				padding:0 5%;
				line-height:2.4rem;
				font-size: 0.65rem;
				color:#333333;
				border: solid 1px #d7d7d7;
				position:relative;
			}
			.top h5 i {
				height:0.6rem;
				width:0.3rem;
				background: url(/img/gd_right_arrow.jpg);
				background-size: 100%;
				-weblit-background-size: 100%;
				position:absolute;
				right:5%;
				top:0.9rem;
			}
			/*选项卡*/
			.main {
				background-color: #FFFFFF;
				position: relative;
			}
			.main dl dd {
				width:50%;
				height:2.15rem;
				float: left;
				text-align: center;
				font-size: 0.9rem;
				color:#999999;
				line-height:2.15rem;
				border-top: solid 1px #d7d7d7;
				border-bottom: solid 1px #d7d7d7;
				box-sizing: border-box;
			}
			.main dl dd.active {
				color:#f49120;
				font-family: "DFPHannotateW5-GB";
			}
			.main section {
				position: absolute;
				top:2.15rem;
				width:100%;
				padding:0 5%;
				background-color: #FFFFFF;
			}
			/*图文详情*/
			.main section.details {
				display:block;
			}
			.main section.details i {
				width:50%;
				height:0.2rem;
				position:absolute;
				top:0;
				left:0;
				background-color: #f49120;
			}
			.main section.details img {
				width:100%;
				margin:0.9rem auto 0.8rem;
				display:block;
			}
			.main section.details ul {
				width:100%;
				margin:0 auto;
			}
			.main section.details ul li {
				width:31%;
				padding:0 1%;
				float:left;
			}
			.main section.details ul li img {
				width:44%;
				margin:0 auto 0.2rem;
				display: block;
			}
			.main section.details ul li h2 {
				text-align: center;
				font-size: 0.7rem;
				line-height: 1.2rem;
				font-weight: bold;
			}
			.main section.details ul li h3 {
				font-size: 0.6rem;
				line-height: 1rem;
			}
			/*产品参数*/
			.main section.parameter {
				display:none;
			}
			.main section.parameter ul li {
				line-height:2.5rem;
				font-size: 0.65rem;
				border-bottom: solid 1px #d7d7d7;
			}
			.main section.parameter ul li.last-item {
				border-bottom: none;
			}
			.main section.parameter ul li span {
				color:#999999;
				width:28%;
				float: left;
			}
			.main section.parameter ul li em {
				color:#333333;
				width:72%;
				float: left;
			}
			.main section.parameter i {
				width:50%;
				height:0.2rem;
				position:absolute;
				top:0;
				right:0;
				background-color: #f49120;
			}
			.h8 {
				height:0.2rem;
				background: linear-gradient(#e8e8e8,#fff);
				position:absolute;
				width:100%;
				bottom:3.75rem;
				left:0;
			}
			.h150 {
				height:3.75rem;
			}
			.btn {
				position: fixed;
				left:0;
				bottom:0;
				height:3.75rem;
				width:100%;
				background-color:rgba(255,255,255,0.66);
			}
			/*7.10start*/
			.btn a {
				width:56.2%;
				margin:1.1rem auto;
				display: block;
			}
			.btn img {
				width:100%;
				display: block;
			}
			/*7.10end*/
			/*弹窗*/
			.tips {
				position: fixed;
				z-index: 999;
				bottom:0;
				left:0;
				background-color: #FFFFFF;
				width:100%;
			/*7.10start*/
				bottom:-22rem;
			/*7.10end*/
			}
			.tips h2 {
				padding-left: 40%;
				height:6rem;
			}
			.tips h2 img {
				position: absolute;
				width:32%;
				left:2.5%;
				top:-0.9rem;
				border-radius: 0.3rem;
				-weblit-border-radius: 0.3rem;
			}
			.tips h2 span {
				color:#f65304;
				font-size: 0.8rem;
				line-height: 2.3rem;
			}
			.tips h2 em {
				color:#333333;
				font-size: 0.8rem;
			}
			.tips h3 {
				font-size: 0.9rem;
				font-family:"DFPHannotateW5-GB";
				padding-left: 4%;
				line-height: 1.9rem;
			}
			.tips h4 {
				margin-bottom: 1.4rem;
			}
			.tips h4 dl dd {
				width:4rem;
				height:1.25rem;
				float:left;
				text-align: center;
				line-height: 1.25rem;
				background-color: #f5f5f5;
				color:#333333;
				border-radius: 0.4rem;
				-webkit-border-radius: 0.4rem;
				margin-left:4%;
				font-size: 0.6rem;
			}
			.tips h4 dl dd.selected {
				background-color: #f49120;
				color:#FFFFFF;
			}
			.tips h5 {
				font-size: 0.9rem;
				line-height: 1.8rem;
				font-family:"DFPHannotateW5-GB";
				padding-left: 4%;
				padding-bottom: 2.3rem;
				border-bottom:solid 1px #d7d7d7;
				position: relative;
			}
			.tips h5 p {
				position: absolute;
				width:7rem;
				height:1.7rem;
				top:0;
				right:5%;
			}
			.tips h5 p i {
				height:1.7rem;
				width:2.2rem;
				background: url(/img/gd_tips_two.jpg);
				background-size: 100%;
				-webkit-background-size: 100%;
				float:left;
			}
			.tips h5 p em {
				height:1.7rem;
				width:2.2rem;
				background: url(/img/gd_tips_three.jpg);
				background-size: 100%;
				-webkit-background-size: 100%;
				float:left;
			}
			.tips h5 p input {
				width:2.6rem;
				height:1.7rem;
				margin:0;
				padding:0;
				border:none;
				outline: none;
				box-sizing: border-box;
				float:left;
				font-size: 0.7rem;
				color:#333333;
				text-align: center;
			}
			/*7.10start*/
			.tips h6 a {
				display: block;
				width:56.2%;
				margin:0 auto;
			}
			.tips h6 {
				height:3.75rem;
				padding-top: 1.1rem;
				box-sizing: border-box;
				background-color:rgba(255,255,255,0.66);
			}
			.tips img {
				width:100%;
				display: block;
			}
			/*7.10end*/
			.zhezhaoceng {
				width:100%;
				height:100%;
				background: rgba(0,0,0,0.4);
				z-index: 99;
				position: fixed;
				top:0;
				left:0;
				display:none;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<!--轮播-->
			<header id="slider" class="mui-slider" >
				<div class="mui-slider-group mui-slider-loop">
					<!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="#">
							<img src="<?php echo '/'.$product['Product']['pic_url_arr'][0];?>">
						</a>
					</div>
					<!-- 第一张 -->
					<?php foreach ($product['Product']['pic_url_arr'] as $url):?>
					<div class="mui-slider-item">
						<a href="#">
							<img src="<?php echo '/'.$url;?>">
						</a>
					</div>
					<?php endforeach;?>
					<!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="#">
							<img src="<?php echo '/'.$product['Product']['pic_url_arr'][2];?>">
						</a>
					</div>
				</div>
				<div class="mui-slider-indicator">
					<div class="mui-indicator mui-active"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
				</div>
			</header>
			<!--详情-->
			<section class="top">
				<h2>
					<?php echo $product['Product']['name'];?>
				</h2>
				<h3>
					<span><?php echo $product['Product']['price'];?></span>
					<em>玩子币</em>
					<!-- <i>¥189</i> -->
				</h3>
				<h4>
					<!-- <span>快递：0.00</span> -->
					<em>库存：<?php echo $product['Product']['price'];?></em>
				</h4>
				<h5>
					<span>选择数量</span>
					<i></i>
				</h5>
			</section>
			<!--选项卡-->
			<section class="main">
				<dl class="clearfix">
					<dd class="details_btn">图文详情</dd>
					<dd class="parameter_btn">产品参数</dd>
				</dl>
				<section class="details">
					<i></i>
					<?php foreach($product['Product']['pic_url_arr'] as $picUrl):?>
						<?php if(!empty($picUrl)):?>
							<img src="<?php echo '/'.$picUrl;?>" />
						<?php endif;?>
					<?php endforeach;?>
					<h3><?php echo $product['Product']['description'];?></h3>
					<ul class="clearfix">
						<!-- <li>
							<img src="/img/gd_pic_one.jpg" />
							<h2>智能玩伴</h2>
							<h3>
								融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了
							</h3>
						</li>
						<li>
							<img src="/img/gd_pic_two.jpg" />
							<h2>听故事涨知识</h2>
							<h3>
								融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了
							</h3>
						</li>
						<li>
							<img src="/img/gd_pic_three.jpg" />
							<h2>匠心设计</h2>
							<h3>
								融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了凯叔融合了
							</h3>
						</li> -->
					</ul>
					<div class="h150"></div>
				</section>
				<section class="parameter">
					<i></i>
					<ul>
						<li class="clearfix">
							<span>规格</span>
							<em><?php echo $product['Product']['sku_type'];?></em>
						</li>
						<!-- <li class="clearfix">
							<span>型号</span>
							<em>MK520</em>
						</li>
						<li class="clearfix">
							<span>类型</span>
							<em>指纹式</em>
						</li>
						<li class="clearfix">
							<span>颜色分类</span>
							<em>MK520官方标配（不送U盘） 升级版MK560标配 （不送U盘） MK520+送专用U盘+质保3年 MK520 + 送8G盘 + 质保3年 升级版MK560+专用U盘+质保3年 升级版MK560 + 8G盘 + 质保3年</em>
						</li>
						<li class="clearfix last-item">
							<span>售后服务</span>
							<em>三包</em>
						</li> -->
					</ul>
					<div class="h8"></div>
					<div class="h150"></div>
				</section>
			</section>
			<!--立即兑换-->
			<section class="btn">
				<a href="#" onclick="submitProduct()">
					<img src="/img/gd_pic_btn.png" />
				</a>
			</section>
			<!--弹窗-->
			<section class="zhezhaoceng"></section>
			<section class="tips">
				<h2>
					<img src="/<?php echo $product['Product']['pic_url1'];?>" />
					<span><?php echo $product['Product']['price'];?>丸子币</span><br />
					<em>库存<i><?php echo $product['Product']['stock'];?></i>件</em>
				</h2>
				<!-- <h3>
					规格
				</h3>
				<h4>
					<dl class="clearfix">
						<dd class="selected">礼盒装</dd>
						<dd>升级版</dd>
					</dl>
				</h4> -->
				<h5>
					购买数量
					<p><i></i><input type="tel" name="num" value="1" id="quantity" readonly="readonly"/><em></em></p>
				</h5>
				<h6>
					<a href="#" onclick="submitProduct()">
						<img src="/img/gd_pic_btn.png" />
					</a>
				</h6>
			</section>
		</section>
		<script type="text/javascript" src="/js/jquery-3.2.1.min.js" ></script>
		<script>
			function submitProduct(){
				var quantity = $('#quantity').val();
				if (!confirm('确认兑换 '+quantity+' 件 '+'<?php echo $product['Product']['name'];?>'+'?')) {
					return;
				}
				var data = {
					quantity:quantity,
					id:'<?php echo $product['Product']['id'];?>',
				}
				var url = '/product/purchaseProduct';
				$.ajax({
					url:url,
					type:'POST',
					dataType:'json',
					data:data,
					success:function(res){
						if (res.status == 1) {
							alert('兑换成功');
						} else {
							alert(res.msg);
						}
					},
					error:function(res) {

					}
				});
			}

			function test(){
				$(".tips").animate({bottom:"-22rem"},300,function(){
					//7.10end
					$(".zhezhaoceng").css({display:"none"});
				});
			}

			$(document).ready(function(){
				//选项卡tab
				//声明当前选项卡变量
				change(0);
				function change(item){
					if(item==0){
						$(".main dl dd").removeClass("active");
						$(".main section").css({display:"none"});
						$(".main dl dd.details_btn").addClass("active");
						$(".main section.details").css({display:"block"});
					}else  if(item==1){
						$(".main dl dd").removeClass("active");
						$(".main section").css({display:"none"});
						$(".main dl dd.parameter_btn").addClass("active");
						$(".main section.parameter").css({display:"block"});
					}
				}
				$(".main dl dd.details_btn").click(function(){change(0);});
				$(".main dl dd.parameter_btn").click(function(){change(1);});
				
				//点击选择规格弹出框
				$(".top h5").click(function(){
					$(".zhezhaoceng").css({display:"block"});
					$(".tips").animate({bottom:"0"},500);
				})
				$(".zhezhaoceng").click(function(){
					$(".tips").animate({bottom:"-22rem"},300,function(){
					//7.10end
						$(".zhezhaoceng").css({display:"none"});
					});
				})
			})
			
			
			//点击切换弹窗中的升级版和礼盒版
			$(".tips h4 dd").click(function(){
				$(".tips h4 dd").removeClass("selected");
				$(this).addClass("selected");
			})
			
			//点击加减选中数量
			var onum=$(".tips h5 input").val();
			//点击减号每次减一个
			$(".tips h5 i").click(function(){
				onum--;
				if(onum<=1){onum=1;}
				$(".tips h5 input").val(onum);
			})
			//点击加号每次加一个
			$(".tips h5 em").click(function(){
				onum++;
				var onew=$(".tips h2 i").html();
				if(onum>=onew){onum=onew;}
				$(".tips h5 input").val(onum);
			})
		</script>
		<!--轮播-->
		<script src="/js/mui.min.js"></script>
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
