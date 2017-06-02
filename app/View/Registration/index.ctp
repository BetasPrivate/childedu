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
            body {
                max-width: 750px;
                min-width: 320px;
                margin:0 auto;
            }
            .home {
                width:100%;
            }
            header img {
                width:100%;
                display: block;
            }
            .main {
                width:90%;
                margin:0 auto;
            }
            .main li {
                width:100%;
                display: flex;
                display: -webkit-flex;
                display: -moz-box;
                margin-bottom: 0.4rem;
            }
            .main li.first-item {
                margin-top:1.2rem;
            }
            .main li.last-item {
                margin-bottom: 1.8rem;
            }
            .main li img {
                width:28%;
                display:block;
                float:left;
                margin:auto 2% auto 0;
            }
            .main li input[type="text"] {
                width:70%;
                height:2rem;
                float:right;
                border:none;
                box-sizing: border-box;
                outline: none;
                background-color: #e8e8e8;
                border-radius: 0.2rem;
                -webkit-border-radius: 0.2rem;
                -moz-border-radius: 0.2rem;
                font-size: 0,8rem;
                color:#333;
                text-indent: 5%;
            }
        .main button {
            background:url(/img/button_bg.jpg);
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
                <img src="/img/header.jpg" alt="周末识趣，亲情不打烊"/> 
            </header>
            <div class="main">
                <form action="/registration/submitReg" method="post">
                    <ul>
                        <li class="clearfix first-item">
                            <img src="/img/main_pic_one.jpg">
                            <input type="text" name="adultName" /> 
                        </li>
                        <li class="clearfix">
                            <img src="/img/main_pic_two.jpg">
                            <input type="text" name="adultPhone" /> 
                        </li>
                        <li class="clearfix">
                            <img src="/img/main_pic_three.jpg">
                            <input type="text" name="childName" /> 
                        </li>
                        <li class="clearfix last-item">
                            <img src="/img/main_pic_four.jpg">
                            <input type="text" name="childBirthday" /> 
                        </li>
                    </ul>
                    <button></button>
                </form>
            </div>
        </section>
    </body>
</html>
