<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<title>打卡首页</title>
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
		<link rel="stylesheet" href="/css/accompany_read.css" type="text/css" />
		<script src="/js/html2canvas.js"></script>
		<script src="/js/jquery-3.2.1.min.js"></script>
		<style>
           @font-face {
                font-family:"DFPHannotateW5-GB";
                src: url("/font/DFPHannotateW5-GB.ttf");
            }
            body {
                max-width: 750px;
                min-width: 320px;
                margin: 0 auto;
                font-family: "DFPHannotateW5-GB";
            }
            
            .home1 {
                /*width: 90%;
                margin: 0 auto;
                margin-top: 0.8rem;
                margin-bottom: 1.75rem;*/
                width: 90%;
				/*margin: 0 auto;*/
				padding:0 5%;
            }
            /*7.25start*/
            
            #punch_bg {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: -1;
            }
            
            header p {
                line-height: 2rem;
                font-size: 0.65rem;
                line-height: 2rem;
                color: #999999;
            }

            header img {
                max-width: 100%;
                max-height:9rem;
                margin:0 auto;
                display: block;
            }
            
            .logo img {
                width: 28%;
                margin-top: 0.8rem;
                margin-left: 12%;
                margin-bottom: 1.75rem;
                float: left;
            }
            
            .logo p {
                font-size: 0.85rem;
                color: #ed2f90;
                line-height: 2.85rem;
                margin-left: 8%;
                float: left;
            }
            
            .main h2 {
                background: url(/img/main_bg.png) no-repeat;
                background-size: 100%;
                -webkit-background-size: 100%;
                margin-bottom: 1.4rem;
                min-height:9.2rem;
                /*overflow: scroll;*/
            }
            
            .main h2 p {
                line-height: 1.2rem;
                font-size: 0.7rem;
                padding: 1rem 7%;
            }
            
            .main h4 img {
                width: 25%;
                float: left;
            }
            
            .main h4 ul {
                width: 75%;
                float: left;
            }
            
            .main h4 ul li {
                float: left;
                width: 23%;
                margin-left: 2%;
                box-sizing: border-box;
            }
            .main h4 ul li img {
                border: solid 1px #d9d9d9;
            }
            .main h4 ul li:nth-child(5),
            .main h4 ul li:nth-child(6),
            .main h4 ul li:nth-child(7),
            .main h4 ul li:nth-child(8) {
                margin-top: 3px;
            }

            .home1 .main h4 li img {
				height:1.85rem;
			}
            
            .main h4 ul li img {
                display: block;
                width: 100%;
            }
            .main {
                margin-bottom: 2rem;
            }
            .whole_img {
                /*position: fixed;*/
                /*width: 80%;*/
                /*height: 80%;*/
                /*top: 30px;*/
                /*left: 10%;*/
                /*right: 10%;*/
                /*z-index: -1;*/
            }
            /*loading*/
			.loading {
				position: fixed;
				height:100%;
				width: 100%;
				top:0;
				left: 0;
				z-index: 10;
			}
			.loading img {
				width: 2rem;
				margin:80% auto 0;
				display: block;
				animation: rotate 0.8s infinite linear;
			}
			.show {
				padding-top:2rem;
			}
			@keyframes rotate{
				from{transform: rotate(0);}
				to{transform: rotate(360deg);}
			}
			/*loading end*/

            /*7.10 end*/
        </style>
	</head>
	<!-- <button onclick="test()">test</button> -->
    <!-- <a href="#" id="download">下载图片</a> -->
	<body>
		<p id="saveImg" style="display: none;line-height: 2rem;font-size: 0.65rem;line-height: 2rem;color: #999999;">长按保存图片到相册</p>
        <section class="home1">
            <img class="whole_img" src="" id='whole_img' style="display: none;" />
        </section>
        <!-- <button onclick="uploadImage()">上传图片</button> -->
        <!-- <button onclick="selectImage()">选择图片</button> -->
        <!-- <input type="text" id="testUrl"> -->
        <section class="home1" id="canvasImg" style="display: none;">
			<img src="<?php echo $result['bg_img_url'];?>" id='punch_bg'/>
            <header>
                <!-- <img src="/img/ten_header_pic.jpg" /> -->
                <img src="" id='punch_img'/>
            </header>
            <section class="logo clearfix">
                <img src="/img/logo.png" />
                <p>最好的爱是陪伴</p>
            </section>
            <section class="main">
                <h2 id='punch_text'>
                    <p></p>
                </h2>
                <h4 class="clearfix">
                    <img src="" class="code" id="qrScenePic"/>
                    <ul class="clearfix">
                        <?php foreach($result['imgs'] as $img):?>
                        <li>
                            <img src="<?php echo $img['PunchBgImg']['url'];?>" />
                        </li>
                        <?php endforeach;?>
                    </ul>
                </h4>
            </section>
        </section>
		<section class="home" id="imgPre">
			<header>
				<div id="imagePreview"></div>
				<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
			</header>
			<section class="main">
				<h4 class="clearfix">
					<span>选择打卡类型</span>
					<select name="sign_type" id="punch_type" onclick="checkLogIn()">
						<?php foreach($punchTypes as $punchType):?>
						<option value="<?php echo $punchType['PunchType']['id'];?>"><?php echo $punchType['PunchType']['name'];?></option>
						<?php endforeach;?>
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
		<section class="loading" style="display: none;">
			<img src="/img/loading.png" />
		</section>
		<script type="text/javascript">
			var size;
		</script>
		<script src="/js/accompany_read.js?1"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
		<script type="text/javascript">
			var localUrl;
            var serverUrl;
            var punchId;
            var punchType;
            var shareLink;
            var hasUpLoad = false;
            function test(){
                // $("#container").css("backgroundImage","url(/img/ten_body_bg.jpg)"); 
                // document.body.background.image = '/img/ten_body_bg.jpg';
                $("#imgPre").hide();
                var url = $('#imagePreview img').attr('src');
                // var url = $('#imageInput').val();
                $('#punch_img').attr('src', url);
                $("#canvasImg").css("background-image","url(<?php echo $result['bg_img_url'];?>)");
                $('#canvasImg').show();
                $("header img").addClass("show");

                var length = $("#canvasImg img").length;
                var imgLoad = 0;

                $("#canvasImg img").one("load", function() {
				  // do stuff
			        html2canvas($('#canvasImg'), {
	                // html2canvas(document.body, {
	                    onrendered: function(canvas) {  
	                        //把截取到的图片替换到a标签的路径下载  
	                        localUrl = canvas.toDataURL();
                            if (!hasUpLoad) {
	                           saveImgToServer(localUrl); 
                            }
	                        //下载下来的图片名字  
	                        // $("#download").attr('download','share.png');
	                        // document.body.appendChild(canvas);
	                        $("#canvasImg").css('display','none');
	                        // $("#whole_img").attr('src', localUrl);
	                        $("#saveImg").css("display","block");
	                    }
	                });
				}).each(function() {
				  	if(this.complete) {
				  		++imgLoad;
				  		if (imgLoad == length) {
				  			$(this).load();
				  		}
				  	}
				});

    //             $('#canvasImg').on("load", function() {
				//     // weave your magic here.
				// });

            }

            function saveImgToServer(localUrl) {
                var data = {
                    base_code:localUrl,
                    punch_id: punchId
                };
                hasUpLoad = true;
                $.ajax({
                    'url': '/punch/uploadImage',
                    'method':'POST',
                    'dataType':'json',
                    'data': data,
                    success:function(res) {
                        serverUrl = res.img_url;
                        $("#whole_img").attr("src", serverUrl);
                        $("#whole_img").css('display', 'block');
                        $(".loading").hide();
                        getReadyToShare(serverUrl, shareLink);
                    },
                    error:function(res) {

                    }
                })
            }


			$(document).ready(function(){
				reset();
				$('#canvasImg').hide();
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
			var b = document.getElementById('imageInput');
			function punch() {
				checkLogIn();
				var data = {
					punch_type: $('#punch_type').val(),
					punch_text: $('#inner_feeling').val(),
				};
				if (a.firstChild == undefined) {
					alert('无图无真相~');
					return;
				}
				if (data.punch_text == '') {
					alert('请输入心得');
					return;
				}
				$('.loading').show();
				$.ajax({
					'url': '/punch/submitPunchRequest',
					'method': 'POST',
					'dataType': 'json',
					'data': data,
					success:function(response) {
						if (response.status == 1) {
							punchId = response.id;
							punchType = response.punch_type;
							shareLink = response.share_link;
							$('#punch_text p').html(response.punch_text);
							$('#qrScenePic').attr('src', response.qr_scene_url);
							test();
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
						} else {
							$('.loading').hide();
							alert(response.msg);
						}
					},
					error:function(response) {
						console.log('error');
					}
				})
			}
		</script>
		<script type="text/javascript">
            wx.config({

                debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。

                appId: "<?php echo $result['appId'];?>", // 必填，公众号的唯一标识

                timestamp: <?php echo $result['timeStamp'];?>, // 必填，生成签名的时间戳

                nonceStr: "<?php echo $result['nonceStr'];?>", // 必填，生成签名的随机串

                signature: "<?php echo $result['signature'];?>",// 必填，签名，见附录1

                jsApiList: [
                    'onMenuShareTimeline', 
                    'onMenuShareAppMessage',
                    'uploadImage',
                    'chooseImage',
                ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });
            wx.ready(function(){
                wx.checkJsApi({
                    jsApiList: [
                        'chooseImage',
                        'onMenuShareTimeline',
                        'onMenuShareAppMessage',
                    ], // 需要检测的JS接口列表，所有JS接口列表见附录2,
                    success: function(res) {
                        console.log(res);
                    }
                });
                // test();
            });

            function getReadyToShare(serverUrl, shareLink) {
                // 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
                wx.onMenuShareTimeline({

                    title: <?php echo "'".AuthComponent::user('username').'的打卡记录'."'";?>, // 分享标题

                    link: shareLink,

                    imgUrl: serverUrl, // 分享图标
                    success: function (res) { 
                        responseToShareInWeixin();
                    },
                    cancel: function () { 

                        // 用户取消分享后执行的回调函数

                    }

                });

                // 获取“分享给朋友”按钮点击状态及自定义分享内容接口

                wx.onMenuShareAppMessage({

                    title: <?php echo "'".AuthComponent::user('username').'的打卡记录'."'";?>, // 分享标题

                    link: shareLink,

                    imgUrl: serverUrl, // 分享图标
                    success: function (res) { 
                        responseToShareInWeixin();
                    },
                    cancel: function () { 

                        // 用户取消分享后执行的回调函数

                    }

                });
            }

            function responseToShareInWeixin() {
                var data = {
                    punchId: punchId,
                    punchType: punchType,
                }
                $.ajax({
                    'url':'/punch/responseToShareInWeixin',
                    'method': 'POST',
                    'dataType':'json',
                    'data':data,
                    success:function(res) {

                    },
                    error:function(res) {

                    }
                })
            }
        </script>
	</body>
</html>
