<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="/css/common.css" type="text/css" />
		<link rel="stylesheet" href="/css/LArea.css">
		<title>我的地址</title>
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
				background-color: #f2f2f2;
			}
			.home {
				width:100%;
				background-color: #FFFFFF;
			}
			ul li {
				width:90%;
				margin:0 auto;
				line-height:2.2rem;
				border-bottom: solid 1px #d7d7d7;
			}
			ul li span {
				font-size: 0.8rem;
				color:#333;
			}
			ul li input {
				border:none;
				outline: none;
				box-sizing: border-box;
				line-height: 2.2rem;
				font-size: 0.6rem;
				font-family:"DFPHannotateW5-GB";
				width:75%;
				float: right;
				padding:0;
				margin:0;
			}
			.area_ctrl {
				background-color:#ffffff;
			}
			.larea_cancel {
				color:#999999;
				font-family:"DFPHannotateW5-GB";
				font-size:0.8rem;
			}
			.larea_finish {
				color:#f5952c;
				font-family:"DFPHannotateW5-GB";
				font-size:0.8rem;
			}
			.area_btn_box {
				background-color: #ffffff;
			}
			.area_roll>div {
				font-size: 0.7rem;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<form action="" method="">
				<ul>
					<li>
						<span>收件人</span><input type="text" name="user" placeholder="填写收件人"/>
					</li>
					<li>
						<span>联系电话</span><input type="tel" name="phone_num" placeholder="填写联系电话"/>
					</li>
					<li class="content-block">
						<span>所在地区</span><input id="demo1" type="text" name="area" readonly="readonly" value="请选择，请选择，请选择"/>
					</li>
					<li>
						<span>详细地址</span><input type="text" name="address" placeholder="填写详细地址"/>
					</li>
				</ul>
			</form>
		</section>
	    <script src="/js/LAreaData1.js"></script>
	    <script src="/js/LArea.js"></script>
	    <script>
		    var area1 = new LArea();
		    area1.init({
		        'trigger': '#demo1', //触发选择控件的文本框，同时选择完毕后name属性输出到该位置
		        'valueTo': '#value1', //选择完毕后id属性输出到该位置
		        'keys': {
		            id: 'id',
		            name: 'name'
		        }, //绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
		        'type': 1, //数据源类型
		        'data': LAreaData //数据源
		    });
		    area1.value=[27,13,3];//控制初始位置，注意：该方法并不会影响到input的value
	    </script>
	</body>
</html>
