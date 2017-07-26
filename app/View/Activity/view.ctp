<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<title><?php echo $activity['title'];?></title>
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
		<style>
			@font-face {
				font-family:"DFPHannotateW5-GB";
				src: url("/font/DFPHannotateW5-GB.ttf");
			}
			/*7.10start*/
			body {
				max-width: 750px;
				min-width: 320px;
				margin:0 auto;
				font-family: "DFPHannotateW5-GB";
				background-color: #FFFFFF;
			}
			.home {
				width:100%;
				margin:0 auto;
				background-color: #f2f2f2;
			}
			header {
				font-size:0.8rem;
				line-height:2.3rem;
				margin-bottom: 0.4rem;
				background-color: #FFFFFF;
			}
			header img {
				width:100%;
				display: block;
				border-bottom: solid 1px #f2f2f2;
			}
			header h2,header h3 {
				width:86%;
				margin:0 auto;
			}
			header h2 {
				font-size: 0.85rem;
				line-height: 1.65rem;
				color:#333333;
				margin-top: 0.48rem;
			}
			header h3 li {
				border-bottom:solid 1px #d7d7d7;
				height:2.18rem;
				line-height: 2.18rem;
				position: relative;
				padding-left: 13.5%;
				box-sizing: border-box;
				color:#666666;
			}
			header h3 li:last-child {
				border:none;
			}
			header h3 li i {
				background: url(/img/nine_ico.jpg);
				width: 0.85rem;
				height:1rem;
				position: absolute;
				top:0.58rem;
				left:4%;
				background-size: 100%,100%;
				background-position-y: 0;
			}
			header h3 li:nth-child(2) i {
				background-position-y: 2rem;
			}
			header h3 li:nth-child(3) i{
				background-position-y: 1rem;
			}
			header h3 li span {
				float: right;
				margin:0;
				padding:0;
				color:#999999;
			}
			.main {
				width:86%;
				padding:0 7%;
				margin:0 auto;
				background-color: #FFFFFF;
			}
			.main h2 {
				text-align: center;
				font-size: 0.8rem;
				color:#333333;
				height:1.65rem;
				border-bottom:solid 1px #cdcdcd;
				width:56.25%;
				margin:0 auto 1.3rem;
				position: relative;
			}
			.main h2 span {
				width:45%;
				line-height: 2.55rem;
				background-color: #FFFFFF;
				top:0.4rem;
				left:27.5%;
				position: absolute;
			}
			.main ul {
				padding-top:0.4rem;
				padding-bottom: 1.25rem;
				margin-bottom: 0.4rem;
			}
			.main ul li {
				font-size:0.7rem;
				line-height:1rem;
				color:#666666;
			}
			.home form {
				width:72%;
				padding:1.7rem 14% 0;
				background-color: #FFFFFF;
			}
			.home form input {
				height:1.9rem;
				width:100%;
				display: block;
				float: right;
				border: none;
				outline: none;
				box-sizing: border-box;
				background-color: #e8e8e8;
				font-family: "DFPHannotateW5-GB";
				font-size:0.7rem;
				text-indent: 4%;
				margin-bottom: 0.35rem;
			}
			.home form input:nth-child(2){
				margin-bottom: 1.1rem;
			}
			.home form button {
				width:78%;
				display: block;
				margin:1.1rem auto 0;
				height:1.6rem;
				border:none;
				border-radius: 0.8rem;
				box-sizing: border-box;
				outline: none;
				background-color: #ff9601;
				color:#FFFFFF;
				font-size: 0.9rem;
				font-family: "DFPHannotateW5-GB";
				margin-bottom: 1.5rem;
			}
			/*7.10end*/
		</style>
	</head>
	<body>
		<section class="home">
			<header>
				<img src="/<?php echo $activity['thumbnail_url'];?>" />
				<?php if ($activity['id'] != 1):?>
				<h2><?php echo $activity['title'];?></h2>
				<h3>
					<ul>
						<li>
							<i></i>时间<span><?php echo $activity['start_time'].'-'.$activity['end_time'];?></span>
						</li>
						<li>
							<i></i>地点<span><?php echo $activity['location'];?></span>
						</li>
						<li>
							<i></i>人数<span><?php echo $activity['people_limation'];?>人</span>
						</li>
					</ul>
				</h3>
				<?php endif;?>
			</header>
			<section class="main">
				<?php if ($activity['id'] != 1):?>
				<ul>
					<li>
						<?php echo $activity['description'];?>
					</li>
				</ul>
				<?php endif;?>
				<form action="/activity/submitActivityRegInfo" method="post">
					<input type="hidden" id="id" name="id" value="<?php echo $activity['id'];?>">
					<?php foreach($activity['fields'] as $name => $text):?>
					<input type="text" name="<?php echo $name;?>" id="<?php echo $name;?>" placeholder="<?php echo $text;?>" onclick="checkLogIn()" />
					<?php endforeach;?>
					<button onclick="submitActivityRegInfo()">提交</button>
				</form>
			</section>
		</section>
	</body>
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		<?php if (AuthComponent::user('id')):?>
        var isLogIn = true;
        <?php else:?>
        var isLogIn = false;
        <?php endif;?>
        function checkLogIn() {
            if (!isLogIn) {
                if (!confirm('系统检测到您尚未登录，现在登录？')) {
                    return;
                } else {
                    window.location.href = '/users/login';
                }
            }
        }

		function submitActivityRegInfo() {
			checkLogIn();
			var data = {
				user_name:('#user_name').val(),
				mobile_phone:('#mobile_phone').val(),
				address:('#address').val(),
				venue_id:('#venue_id').val(),
				child_name:('#child_name').val(),
				child_birth:('#child_birth').val(),
				id:'<?php echo $activity['id'];?>'
			};
			$.ajax({
				'url': '/activity/submitActivityRegInfo',
				'method': 'POST',
				'dataType': 'json',
				'data': data,
				success:function(response) {
					if (response.status == 1) {
						// var postData = {
						// 	url: a.firstChild.src,
						// 	punch_id: response.id,
						// 	punch_text: $('#inner_feeling').val(),
						// 	qr_scene_url: response.qr_scene_url,
						// 	punch_type: response.punch_type,
						// };
						// var mapForm = document.createElement("form");
					 //    mapForm.method = "POST"; // or "post" if appropriate
					 //    mapForm.action = "/punch/punchImg";
					 //    var mapInput = document.createElement("input");
					 //    mapInput.type = "hidden";
					 //    mapInput.name = "urlAndPunchIdAndText";
					 //    mapInput.value = JSON.stringify(postData);
					 //    mapForm.appendChild(mapInput);
					 //    document.body.appendChild(mapForm);
					 //    mapForm.submit();
					 window.location.href = '/registration/regSuccess';
					}
				},
				error:function(response) {
					console.log('error');
				}
			})
		}
	</script>
</html>
