<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" /> -->
        <meta id="client" name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
        <meta name="format-detection" content="telephone=no" />
        <title>打卡首页</title>
        <link rel="stylesheet" href="/css/common.css" type="text/css" />
        <link rel="stylesheet" href="/css/accompany_read.css?2" type="text/css" />
		<script src="/js/accompany_read.js?1"></script>
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/resize.js"></script>
        <script src="/js/html2canvas.js"></script>
        <style>
        @font-face {
                font-family: "DFPHannotateW5-GB";
                src: url("/font/DFPHannotateW5-GB.ttf");
            }
            body {
                max-width: 750px;
                min-width: 320px;
                margin: 0 auto;
                font-family: "DFPHannotateW5-GB";
            }
            /*8.6改动start*/
            .sign {
                position:fixed;width:100%;height:100%;top:0;left:0;z-index: 1001;
            }
            .record {
                opacity:0;position:fixed;width:100%;height:100%;top:0;left:0;z-index: 0;
            }
            /*8.6改动end*/
            .record .home {
                width: 90%;
                padding:0 5%;
            }
            .record .show {
                padding-top:1rem;
            }
            .record>img {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: -1;/*8.6改动*/
            }
            /*8.6改动start*/
            .record #whole_img {
                position: fixed;
                width: 100%;
                top: 0;
                left: 0;
                z-index: 100;/*8.6改动*/
            }
            /*8.6改动end*/
            .record header {
                height:10.05rem;
                padding-top:0.925rem;
            }
            .record header p {
                line-height: 2rem;
                font-size: 0.65rem;
                line-height: 2rem;
                color: #999999;
            }
            
            .record header img {
                max-width: 100%;
                max-height:10.05rem;
                margin:0 auto;
                display: block;
            }
            
            .record .logo img {
                width: 28%;
                margin-top: 1.05rem;
                margin-left: 11.3%;
                margin-bottom: 1.15rem;
                float: left;
                display: block;
            }
            
            .record .logo p {
                font-size: 0.9rem;
                color: #ed2f90;
                line-height: 3.2rem;
                margin-left: 6.8%;
                float: left;
            }
            
            .record .main h2 {
                background: url("/img/main_bg.png") no-repeat;
                background-size: 100%,100%;
                -webkit-background-size: 100%,100%;
                margin-bottom: 1.4rem;
                width:15.9rem;
                height:5.85rem;
                margin:0 auto;
                margin-bottom:2.6rem;
            }
            
            .record .main h2 p {
                line-height: 1.2rem;
                font-size: 0.7rem;
                padding: 1.15rem 6.2%;
                box-sizing: border-box;
            }
            .record .main h4 img {
                width: 25%;
                height: 4.125rem;
                float: left;
            }
            
            .record .main h4 ul {
                width: 75%;
                float: left;
                box-sizing: border-box;
            }
            
            .record .main h4 ul li {
                float: left;
                width: 25%;
                height:2rem;
                padding-left: 0.1rem;
                box-sizing: border-box;
            }
            .record .main h4 ul li img {
                width:100%;
                height: 2rem;
                border: solid 1px #d9d9d9;
                box-sizing: border-box;
            }
            .record .main h4 ul li:nth-child(5),
            .record .main h4 ul li:nth-child(6),
            .record .main h4 ul li:nth-child(7),
            .record .main h4 ul li:nth-child(8) {
                margin-top: 0.1rem;
            }
            
            .record .main h4 ul li img {
                display: block;
                width: 100%;
            }
            .record .main {
                margin-bottom: 2rem;
            }
            .record .home {
                margin-bottom: 1rem;
            }
            /*8.6改动start*/
            .record #press {
                text-align: center;
                font-size: 0.65rem;
                color:#999999;
                line-height: 2.05rem;
                margin-bottom:0.55rem;
                width:100%;
                position:fixed;
                left:0;
                z-index:1000;/*8.6改动*/
                opacity: 0;
            }
            canvas {
                display: block;
                width:100%;
            }
            @keyframes rotate{
                from{transform: rotate(0);}
                to{transform: rotate(360deg);}
            }
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
            /*loading end*/

            /*7.10 end*/
        </style>
    </head>
    <!-- <button onclick="test()">test</button> -->
    <!-- <a href="#" id="download">下载图片</a> -->
    <body>
        <section class="sign">
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
                        <textarea placeholder="请留下你的陪护感言" id="inner_feeling" onclick="checkLogIn()" maxlength="50"></textarea>
                    </h3>
                    <h5>
                        <button onclick="punch()">提交打卡</button>
                    </h5>
                </section>
            </section>
        </section>
        <section class="record" id="record">
            <img class="whole_img" src="" id='whole_img'/>
            <h3 id="press">长按保存图片到相册</h3>
            <img src="<?php echo $result['bg_img_url'];?>" id='punch_bg'/>
            <!-- <button onclick="uploadImage()">上传图片</button> -->
            <!-- <button onclick="selectImage()">选择图片</button> -->
            <!-- <input type="text" id="testUrl"> -->
            <section class="home" id="canvasImg">
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
        </section>
        <section class="loading" style="display: none;">
            <img src="/img/loading.png" />
        </section>
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
                // $("#imgPre").hide();
                // var url = $('#imagePreview img').attr('src');
                $(".record .home header img").attr("src",$(".sign .home header img").attr("src"));
                $(".record .main h2 p").html($(".sign textarea").val());
                $(".sign").hide();
                $(".record").css("opacity",1);
                $("#press").css("opacity",0);
                $('#canvasImg').show();
                // var url = $('#imageInput').val();
                // $('#punch_img').attr('src', url);
                $("#canvasImg").css("background-image","url(<?php echo $result['bg_img_url'];?>)");
                // $("header img").addClass("show");

                var length = $("#canvasImg img").length;
                var imgLoad = 0;

                $("#canvasImg img").one("load", function() {
                    setTimeout(function(){
                            takeScreenshot();
                        //  html2canvas($('#canvasImg'), {
                        // // html2canvas(document.body, {
                        //     onrendered: function(canvas) {
                        //         //把截取到的图片替换到a标签的路径下载  
                        //         localUrl = canvas.toDataURL();
                        //         if (!hasUpLoad) {
                        //             saveImgToServer(localUrl);
                        //         }
                        //         $("#canvasImg").hide();
                        //         $("#saveImg").css("display","block");
                        //     }
                        // });
                    }, 3000);
				}).each(function() {
				  	if(this.complete) {
				  		++imgLoad;
				  		if (imgLoad == length) {
				  			$(this).load();
				  		}
				  	}
				});

            }

            function takeScreenshot() {
                if (hasUpLoad) {
                    return;
                }
                var owidth=Number(document.documentElement.clientWidth);
                var oheight=Number(document.documentElement.clientHeight);

                var canvas = document.createElement("canvas");
                canvas.width = owidth * 2;
                canvas.height = oheight * 2;
                canvas.style.width = owidth + "px";
                canvas.style.height = oheight + "px";
                var context = canvas.getContext("2d");

                var cenX=($('#record').offset().left)*2;
                var cenY=($('#record').offset().top)*2;
                context.translate(-cenX,-cenY);
                       
                context.scale(2,2);

                html2canvas($("#record"), {
                    onrendered: function(canvas) {
                        document.body.appendChild(canvas);
                        $("#press").css({opacity:1});
                        // localUrl = canvas.toDataURL("image/jpg",1.0);
                        localUrl = canvas.toDataURL();
                        saveImgToServer(localUrl);
                        $("#whole_img").attr("src", localUrl);
                        $("#canvasImg .home").hide();
                        $("canvas").hide();
                    },
                    width: owidth,
                    height: oheight,
                });
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
        
				window.onresize=function(){
					reset();
				}
				function reset(){
					var bei=338/638;
					$("#imagePreview").height($("#imagePreview").width()*bei);
					$("#imageInput").height($("#imagePreview").height());
					$(".main h3 textarea").height($(".main h3 textarea").width()*(210/576));
				}

                var ohei1=$(".record .home header").innerHeight();
                var ohei2=$(".record .home .logo").height();
                var ohei3=$(".record .home .main h2").innerHeight();
                var ohei=ohei1+ohei2+ohei3;
                console.log(ohei1,ohei2,ohei3);
                $("#press").css({top:ohei});
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
