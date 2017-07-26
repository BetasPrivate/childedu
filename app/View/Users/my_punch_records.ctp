<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
		<title>打卡记录</title>
		<style>
			body {
				max-width: 750px;
				min-width: 320px;
				margin:0 auto;
			}
			.home {
				width:90%;
				margin:0 auto;
			}
			.home ul li {
				line-height:2.2rem;
				color:#333;
				font-size:0.7rem;
				padding-right:3%;
				border-bottom: solid 1px #d7d7d7;
			}
			.home ul li span {
				float:right;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<ul>
				<?php foreach ($punchRecords as $punchRecord): ?>
				<li>
					<br><?php echo $punchRecord['punch_text'];?><span><?php echo $punchRecord['total_point'];?>积分</span><br><span>日期<?php echo substr($punchRecord['PunchRecord']['created'], 0, 10);?></span>
				</li>
				<?php endforeach;?>
			</ul>
		</section>
	</body>
</html>
