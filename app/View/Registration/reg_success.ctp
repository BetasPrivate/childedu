<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<title>报名成功</title>
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
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
			}
			.home {
				width:100%;
			}
			.home h2 {
				margin-top:3rem;
				line-height:2rem;
				font-size:1.4rem;
				color:#343434;
				text-indent: 20%;
				position: relative;
			}
			.home h2 img {
				position: absolute;
				left:6%;
				top:0;
				height:2rem;
				width:2.1rem;
			}
			.home h3 {
				padding-top:1.5rem;
				text-align: center;
				font-size: 0.9rem;
			}
			.home h3 span {
				color:#f3921f;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<h2>
				<img src="/img/four_pic_success.jpg" />恭喜您，报名成功！
			</h2>
			<h3>
				您将获得<span><?php echo $point;?></span>丸子币
			</h3>
		</section>
	</body>
</html>
