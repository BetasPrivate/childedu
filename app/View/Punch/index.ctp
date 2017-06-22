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
				<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
			</header>
			<section class="main">
				<h2>输入此刻你的感受</h2>
				<h3>
					<textarea id="inner_feeling"></textarea>
				</h3>
				<h4 class="clearfix">
					<span>选择打卡类型</span>
					<select name="sign_type" id="punch_type">
						<option value="1">陪伴阅读打卡</option>
						<option value="2">活动打卡</option>
						<option value="3">课堂打卡</option>
						<option value="4">助教打卡</option>
					</select>
				</h4>
				<h5>
					<button onclick="punch()"></button>
				</h5>
			</section>
		</section>
		<script src="/js/jquery-3.2.1.min.js"></script>
		<script src="/js/accompany_read.js"></script>
		<script type="text/javascript">
			var a= document.getElementById('imagePreview');
			function punch() {
				var data = {
					url: a.firstChild.src
				};
				$.ajax({
					'url': '/punch/submitPunchRequest',
					'method': 'POST',
					'dataType': 'json',
					'data': data,
					success:function(response) {
						if (response.status == 1) {
							var mapForm = document.createElement("form");
						    mapForm.method = "POST"; // or "post" if appropriate
						    mapForm.action = "/punch/punchImg";
						    var mapInput = document.createElement("input");
						    mapInput.type = "hidden";
						    mapInput.name = "url";
						    mapInput.value = a.firstChild.src;
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
