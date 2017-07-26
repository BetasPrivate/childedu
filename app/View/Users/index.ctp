<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
		<title>会员中心</title>
		<style>
			@font-face {
				font-family:"DFPHannotateW5-GB";
				src: url("/font/DFPHannotateW5-GB.ttf");
			}
			body {
				max-width: 750px;
				min-width: 320px;
				margin:0 auto;
				font-family: "DFPHannotateW5-GB";
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
			header {
				position: relative;
			}
			header img.header_bg {
				width:100%;
				display: block;
			}
			header img.user_name {
				display: block;
				height:76.5%;
				width:21%;
				position:absolute;
				top:9.2%;
				left:38.9%;
				border-radius: 50%;
				-weblit-border-radius: 50%;
				border: 0.1rem solid #8e591c;
			}
			.main h2 {
				font-size:1rem;
				line-height:2.5rem;
				text-align: center;
				background-color:#fff;
				font-family: "微软雅黑";
				margin-bottom: 0.5rem;;
			}
			.main h3 {
				font-size:0.8rem;
				background-color:#fff;
			}
			.main h3 ul li {
				width:90%;
				margin:0 auto;
				line-height:2.2rem;
				border-bottom: solid 1px #d7d7d7;
				text-indent: 1.8rem;
			}
			.main h3 ul li a {
				display:block;
				color:#351f05;
				position:relative;
			}
			.main h3 ul li i {
				height:0.9rem;
				width:0.95rem;
				position:absolute;
				left:0;
				top:0.65rem;
				background:url(/img/person_center_icon.jpg);
				background-size: 100%,4.5rem;
				-webkit-background-size: 100%,4.5rem;
			}
			.main h3 ul li i.i_1 {
				background-position-y: 0;	
			}
			.main h3 ul li i.i_2 {
				background-position-y: -0.9rem;	
			}
			.main h3 ul li i.i_3 {
				background-position-y: -1.8rem;	
			}
			.main h3 ul li i.i_4 {
				background-position-y: -2.7rem;	
			}
			.main h3 ul li i.i_5 {
				background-position-y: -3.6rem;	
			}
			/*7.10start  person_center_icon.kpg图片改了，名字没改*/
			.main h3 ul li i.i_6 {
				background-position-y: -4.5rem;	
			}
			.main h3 ul li:nth-child(6){
				border-bottom: 0;
			}
			/*7.10end*/
			.main h4 {
				padding-top:2.5rem;
			}
			.main h4 img {
				width:50%;
				display:block;
				margin:0 auto;
			}
			/*7.26*/
			.main {
				margin-bottom: 30px;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<header>
				<img src="/img/person_center_header.jpg" class="header_bg">
				<img src="<?php echo $headUrl;?>" class="user_name">
			</header>
			<section class="main">
				<h2><?php echo AuthComponent::user('username');?></h2>
				<h3>
					<ul>
						<li>
							<a href="/users/myPoints">
								<i class="i_1"></i>我的积分
							</a>
						</li>
						<li>
							<a href="#">
								<i class="i_2"></i>我的兑换
							</a>
						</li>
						<li>
							<a href="/users/myPunchRecords">
								<i class="i_3"></i>我的打卡记录
							</a>
						</li>
						<li>
							<a href="/users/myAddress">
								<i class="i_4"></i>我的地址
							</a>
						</li>
						<li>
							<a href="/users/personalCode">
								<i class="i_5"></i>我的核销二维码
							</a>
						</li>
						<li>
							<a href="/users/logout">
								<i class="i_6"></i>退出登录
							</a>
						</li>
					</ul>
				</h3>
				<h4>
					<img src="/img/person_center_pic.jpg" />
				</h4>
			</section>
		</section>
	</body>
</html>
