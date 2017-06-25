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
        <title>陪伴阅读打卡</title>
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
            body {
                width:100%;
                height:100%;
                background: url(/img/ten_body_bg.jpg) no-repeat;
                background-size:cover;
                background-position: center;
            }
            header img {
                width:100%;
                margin-top:1.4rem;
            }
            .main h2 {
                padding-top:0.2rem;
                line-height:1.4rem;
                font-size:0.7rem;
            }
            .main h3 {
                font-size:0.8rem;
                line-height: 4.35rem;
                margin-top:0.5rem;
                text-align: center;
                font-weight: bold;
            }
            .main h4 {
                position:relative;
            }
            .main h4 img.code {
                width:38%;
                display:block;
            }
            .main h4 ul {
                width:59%;
                position:absolute;
                bottom: 0;
                right:0;
            }
            .main h4 ul li {
                float: left;
                width:22%;
                margin-left:3%;
                margin-top:0.2rem;
            }
            .main h4 ul li img {
                display: block;
                width:100%;
            }
        </style>
    </head>
    <body>
        <!-- <a href="#" id="download">下载图片</a> -->
        <h3 onclick="saveImg()" id="save">长按保存图片到相册</h3>
        <img src="" id='whole_img' style="display: none;" />
        <!-- <button onclick="uploadImage()">上传图片</button> -->
        <!-- <button onclick="selectImage()">选择图片</button> -->
        <!-- <input type="text" id="testUrl"> -->
        <section class="home" id="container">
            <header>
                <!-- <img src="/img/ten_header_pic.jpg" /> -->
                <img src="<?php echo $result['url'];?>" id='punch_img'/>
            </header>
            <section class="main">
                <!-- <h2>
                    这次陪宝宝阅读《小王子》，宝宝很开心，我也收获了不一样的快乐，好喜欢这样的活动，希望可以越办越好。这次陪宝宝阅读《小王子》，宝宝很开心，我也收获了不一样的快乐，好喜欢这样的活动，希望可以越办越好。这次陪宝宝阅读！
                </h2> -->
                <h2>
                    <?php echo $result['punch_text'];?>
                </h2>
                <h4>
                    <img src="<?php echo $result['qr_scene_url'];?>" class="code" id="qrScenePic"/>
                    <ul>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                        <li>
                            <img src="/img/ten_header_pic.jpg" />
                        </li>
                    </ul>
                </h4>
            </section>
        </section>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

        <script type="text/javascript">
            var localUrl;
            var serverUrl;
            function test(){
                $("#container").css("backgroundImage","url(/img/ten_body_bg.jpg)"); 
                html2canvas($("#container"), {
                    onrendered: function(canvas) {  
                        //把截取到的图片替换到a标签的路径下载  
                        localUrl = canvas.toDataURL();

                        saveImgToServer(localUrl);
                        //下载下来的图片名字  
                        // $("#download").attr('download','share.png');
                        // document.body.appendChild(canvas);
                        $("#container").css('display','none');
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
