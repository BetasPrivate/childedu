<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<title>公益活动</title>
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
				width:90%;
				margin:0 auto;
			}
			header {
				font-size:0.8rem;
				line-height:2.3rem;
				margin-top:0.5rem;
			}
			header img {
				width:100%;
			}
			.main ul {
				padding-top:0.4rem;
				margin-bottom: 2.2rem;
			}
			.main ul li {
				font-size:0.7rem;
				line-height:1rem;
				color:#666666;
			}
			.main form h2,.main form h3 {
				height:2.5rem;
				font-size:0.7rem;
				line-height:2rem;
				color:#8f591b;
			}
			.main form h3 {
				margin-bottom: 1rem;
			}
			.main form input {
				height:2rem;
				width:90%;
				float: right;
				border: none;
				outline: none;
				box-sizing: border-box;
				background-color: #e8e8e8;
				border-radius: 0.5rem;
				font-family: "DFPHannotateW5-GB";
				font-size:0.7rem;
				text-indent: 0.5rem;
			}
			.main form button {
				background:url(/img/nine_button_bg.jpg);
				width:100%;
				height:2.7rem;
				background-size: 100%;
				-webkit-background-size: 100%;
				-moz-background-size: 100%;
				border:none;
				box-sizing: border-box;
				outline: none;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<header>
				<h2>有福童享</h2>
				<img src="/img/nine_pic_one.jpg" />
			</header>
			<section class="main">
				<ul>
					<li>
						·仍有困难儿童需要别人帮助补齐多种证明才能有户口；
					</li>
					<li>
						·需要别人帮助完成各种申请手续才能享受低保和其他福利；
					</li>
					<li>
						·需要多一份关注才能过得像正常孩子，需要更多的治疗才能康复；
					</li>
				</ul>
				<form action="/activity/respondToWelfareReg" method="post">
					<h2>姓名<input type="text" name="user" id="user" onclick="checkLogIn()" /></h2>
					<h3>手机<input type="tel" name="tel" id="mobile" onclick="checkLogIn()" /></h3>
					<button onclick="respondToWelfareReg()"></button>
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

		function respondToWelfareReg() {
			checkLogIn();
			var data = {
				user: $('#user').val(),
				mobile: $('#mobile').val(),
			};
			$.ajax({
				'url': '',
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
