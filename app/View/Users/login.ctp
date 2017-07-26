<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<title>登录</title>
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
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
                background-color: #FFFFFF;
            }
            .home {
                width:100%;
                background-color: #FFFFFF;
            }
            .home .top img {
                width:57%;
                display: block;
                padding-top:3.9rem;
                padding-bottom: 0.9rem;
                margin:0 auto;
            }
            .home .message input[type=text],.home .message input[type=password] {
                display: block;
                width:70%;
                height:1.9rem;
                box-sizing: border-box;
                border:none;
                outline: none;
                background-color: #e8e8e8;
                margin: 0 auto;
                font-size: 0.65rem;
                text-indent: 4.4%;
                margin-bottom: 0.4rem;
                font-family:"DFPHannotateW5-GB";
            }
            .home .message input[type=submit] {
                width:51%;
                height: 1.6rem;
                border-radius: 0.8rem;
                -webkit-border-radius: 0.8rem;
                margin:1.45rem auto 0.6rem;
                display: block;
                border:none;
                outline: none;
                box-sizing: border-box;
                color:#FFFFFF;
                background-color: #ff9601;
                font-size: 0.8rem;
                font-family:"DFPHannotateW5-GB";
            }
            .message h2 {
                text-align: center;
            }
            .message a {
                font-size: 0.6rem;
                color:#666666;
            }
</style>
</head>

<body>
    <section class="home">
        <section class="top">
            <img src="/img/login.jpg" />
        </section>
        <section class="message">
            <form action="/users/login" method="post">
                <input type="text" name="data[User][username]" placeholder="账户"/>
                <input type="password" name="data[User][password]" placeholder="密码"/>
                <p style="text-align: center;font-size: 0.7rem;line-height: 0.65rem;" id='msg'></p>
                <input type="submit" value="立即登录" style="margin-top:0.8rem;"/>
            </form>
            <h2>
                <a href="/users/findPasswd" style="border-right:1px #4c4c4c solid;padding-right:0.3rem;">忘记密码？</a><a href="/users/signIn" style="padding-left:0.5rem">免费注册</a>
            </h2>
        </section>
    </section>
</body>
</html>
<script type="text/javascript">
    var a = document.getElementById('msg');
    var authMsg = '<?php echo trim(strip_tags($this->Flash->render("auth")));?>';
    var renderMsg = '<?php echo trim(strip_tags($this->Flash->render()));?>';
    if (authMsg != '') {
        a.innerText = authMsg;
    } else if (renderMsg != '') {
        a.innerText = renderMsg;
    } else {
        a.innerText = '请输入账号密码';
    }
</script>
