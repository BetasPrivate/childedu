<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<title>打卡首页</title>
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
		<link rel="stylesheet" href="/css/accompany_read.css" type="text/css" />
	</head>
	<body>
		<section class="home">
			<header>
				<div id="imagePreview"></div>
				<input id="imageInput" type="file" name="myPhoto" onclick="checkLogIn()" onchange="loadImageFile();" />
			</header>
			<section class="main">
				<h4 class="clearfix">
					<span>选择打卡类型</span>
					<select name="sign_type" id="punch_type" onclick="checkLogIn()">
						<option value="1">陪伴阅读打卡</option>
						<option value="2">活动打卡</option>
						<option value="3">课堂打卡</option>
						<option value="4">助教打卡</option>
					</select>
				</h4>
				<h3>
					<textarea placeholder="请留下你的陪护感言" id="inner_feeling" onclick="checkLogIn()"></textarea>
				</h3>
				<h5>
					<button onclick="punch()">提交打卡</button>
				</h5>
			</section>
		</section>
		<script src="/js/jquery-3.2.1.min.js"></script>
		<script src="/js/accompany_read.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				reset();
				window.onresize=function(){
					reset();
				}
				function reset(){
					var bei=338/638;
					$("#imagePreview").height($("#imagePreview").width()*bei);
					$("#imageInput").height($("#imagePreview").height());
					$(".main h3 textarea").height($(".main h3 textarea").width()*(210/576));
				}
			})

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
			var a= document.getElementById('imagePreview');
			function punch() {
				checkLogIn();
				var data = {
					punch_type: $('#punch_type').val(),
					punch_text: $('#inner_feeling').val(),
				};
				$.ajax({
					'url': '/punch/submitPunchRequest',
					'method': 'POST',
					'dataType': 'json',
					'data': data,
					success:function(response) {
						if (response.status == 1) {
							var postData = {
								url: a.firstChild.src,
								punch_id: response.id,
								punch_text: $('#inner_feeling').val(),
								qr_scene_url: response.qr_scene_url,
								punch_type: response.punch_type,
							};
							var mapForm = document.createElement("form");
						    mapForm.method = "POST"; // or "post" if appropriate
						    mapForm.action = "/punch/punchImg";
						    var mapInput = document.createElement("input");
						    mapInput.type = "hidden";
						    mapInput.name = "urlAndPunchIdAndText";
						    mapInput.value = JSON.stringify(postData);
						    mapForm.appendChild(mapInput);
						    document.body.appendChild(mapForm);
						    mapForm.submit();
						}
					},
					error:function(response) {
						console.log('error');
					}
				})
			}
		</script>
	</body>
</html>
