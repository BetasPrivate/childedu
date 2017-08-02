<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
        <meta name="format-detection" content="telephone=no" />
        <link rel="stylesheet" href="/css/common.css" type="text/css" />
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/html2canvas.js"></script>
        <script src="/js/canvas2image.js"></script>
        <title><?php echo $result['punch_type_name'];?></title>
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
                width: 90%;
                margin: 0 auto;
                margin-top: 0.8rem;
                margin-bottom: 1.75rem;
            }
            /*7.25start*/
            
            body>img {
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
                height:9.2rem;
                overflow: scroll;
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
            /*7.10 end*/
        </style>
    </head>
    <!-- <button onclick="test()">test</button> -->
    <!-- <a href="#" id="download">下载图片</a> -->
    <p id="saveImg" style="display: none;">长按保存图片到相册</p>
    <body>
        <img src="<?php echo $result['bg_img_url'];?>" />
        <section class="home1">
            <img class="whole_img" src="" id='whole_img' style="display: none;" />
        </section>
        <!-- <button onclick="uploadImage()">上传图片</button> -->
        <!-- <button onclick="selectImage()">选择图片</button> -->
        <!-- <input type="text" id="testUrl"> -->
        <section class="home1" id="canvasImg">
            <header>
                <!-- <img src="/img/ten_header_pic.jpg" /> -->
                <img src="<?php echo $result['url'];?>" id='punch_img'/>
            </header>
            <section class="logo clearfix">
                <img src="/img/logo.png" />
                <p>最好的爱是陪伴</p>
            </section>
            <section class="main">
                <h2 id='punch_text'>
                    <p><?php echo $result['punch_text'];?></p>
                </h2>
                <h4 class="clearfix">
                    <img src="<?php echo $result['qr_scene_url'];?>" class="code" id="qrScenePic"/>
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
        <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <!--7.25start-->
        <script>
            $(document).ready(function() {
                var oimghei = $(".main h4>img").height();
                console.log(oimghei);
                var ohei = (oimghei - 7) / 2;
                console.log(ohei);
                $(".main h4 ul li img").height(ohei);
            })
        </script>
        <!--7.25end-->
        <script type="text/javascript">
            var localUrl;
            var serverUrl;
            function test(){
                // $("#container").css("backgroundImage","url(/img/ten_body_bg.jpg)"); 
                // document.body.background.image = '/img/ten_body_bg.jpg';
                $("#canvasImg").css("background-image","url(<?php echo $result['bg_img_url'];?>)");
                // html2canvas($('#canvasImg'), {
                html2canvas(document.body, {
                    onrendered: function(canvas) {  
                        //把截取到的图片替换到a标签的路径下载  
                        localUrl = canvas.toDataURL();

                        saveImgToServer(localUrl);
                        //下载下来的图片名字  
                        // $("#download").attr('download','share.png');
                        // document.body.appendChild(canvas);
                        $("#canvasImg").css('display','none');
                        $("#saveImg").css("display","block");
                    }
                });
            }

            // function selectImage() {
            //     wx.chooseImage({

            //         count: 1, // 默认9

            //         sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有

            //         sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有

            //         success: function (res) {

            //             var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            //             localUrl = localIds[0];
            //             alert(JSON.stringify(res));
            //         }

            //     });
            // }
            // function uploadImage()  {
            //     wx.uploadImage({

            //         localId: localUrl, // 需要上传的图片的本地ID，由chooseImage接口获得

            //         isShowProgressTips: 1, // 默认为1，显示进度提示

            //         success: function (res) {

            //             var serverId = res.serverId; // 返回图片的服务器端ID
            //             saveImgToServer(serverId);

            //         },
            //          fail: function (res) {
            //           alert(JSON.stringify(res));
            //         }

            //     });
            // }

            function saveImgToServer(localUrl) {
                var data = {
                    base_code:localUrl,
                    punch_id:<?php echo $result['punch_id'];?>
                };
                $.ajax({
                    'url': '/punch/uploadImage',
                    'method':'POST',
                    'dataType':'json',
                    'data': data,
                    success:function(res) {
                        serverUrl = res.img_url;
                        $("#whole_img").attr("src", serverUrl);
                        $("#whole_img").css('display', 'block');
                        getReadyToShare(serverUrl);
                    },
                    error:function(res) {

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
            wx.checkJsApi({
                jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
                success: function(res) {
                    console.log(res);
                }
            });
            wx.ready(function(){
                test();
            });

            function getReadyToShare(serverUrl) {
                // 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
                wx.onMenuShareTimeline({

                    title: <?php echo "'".AuthComponent::user('username').'的打卡记录'."'";?>, // 分享标题

                    link:<?php echo "'".$result['share_link']."'";?>,

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

                    link:<?php echo "'".$result['share_link']."'";?>,

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
                    punchId:<?php echo $result['punch_id'];?>,
                    punchType:<?php echo $result['punch_type'];?>,
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
