<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
        <meta name="format-detection" content="telephone=no" />
        <title>注册</title>
        <!-- <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script> -->
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
                font-family:"DFPHannotateW5-GB";
            }
            .home {
                width:100%;
            }
            header img {
                width:100%;
                display: block;
            }
            .main {
                width:89%;
                margin:0 auto;
            }
            .main h2 {
                font-size: 0.8rem;
                text-align: center;
                line-height: 2.75rem;
                margin-top: 0.6rem;
            }
            .main li {
                width:100%;
                display: flex;
                display: -webkit-flex;
                display: -moz-box;
                margin-bottom: 0.5rem;
            }
            .main li input[type="text"] {
                width:100%;
                height:2rem;
                float:right;
                border:none;
                box-sizing: border-box;
                outline: none;
                background-color: #e8e8e8;
                font-size: 0.8rem;
                color:#333;
                text-indent: 5%;
                font-family:"DFPHannotateW5-GB";
            }
        .main button {
            width:64%;
            height:1.6rem;
            display: block;
            margin:1.25rem auto;
            background-color: #ff9601;
            border:none;
            box-sizing: border-box;
            outline: none;
            border-radius: 0.8rem;
            color: #FFFFFF;
            font-size: 0.85rem;
            font-family:"DFPHannotateW5-GB";
        }
        </style>
    </head>
    <body>
        <section class="home">
            <header>
                <img src="/img/header.jpg" alt="周末识趣，亲情不打烊"/> 
            </header>
            <div class="main">
                <h2>注册信息填写</h2>
                <form action="/registration/submitReg" method="post">
                    <ul>
                        <li class="clearfix first-item">
                            <input type="text" name="user_name" onclick="checkLogIn()" placeholder="家长姓名"/> 
                        </li>
                        <li class="clearfix">
                            <input type="text" name="mobile_phone" onclick="checkLogIn()"  placeholder="联系方式"/> 
                        </li>
                        <li class="clearfix">
                            <input type="text" name="child_name" onclick="checkLogIn()"  placeholder="子女姓名"/> 
                        </li>
                        <li class="clearfix">
                            <input type="text" name="child_birth" onclick="checkLogIn()"  placeholder="子女出生年月"/> 
                        </li>
                    </ul>
                    <button>提交</button>
                </form>
            </div>
        </section>
    </body>
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
    </script>
</html>
