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
		<section class="home" id="container">
			<canvas id="cvs"></canvas>
			<button id="btn" onclick="test()">点我测试</button>
			<a href="#" id="download">download</a>
			<header>
				<!-- <img src="/img/ten_header_pic.jpg" /> -->
				<img src="<?php echo $urlData['url'];?>" id='punch_img'/>
			</header>
			<section class="main">
				<h2>
					这次陪宝宝阅读《小王子》，宝宝很开心，我也收获了不一样的快乐，好喜欢这样的活动，希望可以越办越好。这次陪宝宝阅读《小王子》，宝宝很开心，我也收获了不一样的快乐，好喜欢这样的活动，希望可以越办越好。这次陪宝宝阅读！
				</h2>
				<h3 onclick="saveImg()" id="save">长按保存图片到相册</h3>
				<h4>
					<img src="/img/ten_pic_code.jpg" class="code"/>
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
		<script type="text/javascript">
			function test(){
		        html2canvas($("#container"), {
		            onrendered: function(canvas) {  
		                //把截取到的图片替换到a标签的路径下载  
		                $("#download").attr('href',canvas.toDataURL());
		                //下载下来的图片名字  
		                $("#download").attr('download','share.png');
		                document.body.appendChild(canvas);  
		            }
				});
			}
			 var canvas, ctx, bMouseIsDown = false, iLastX, iLastY,
		        $save, $imgs,
		        $convert, $imgW, $imgH,
		        $sel;
		    function init () {
		        canvas = document.getElementById('cvs');
		        ctx = canvas.getContext('2d');
		        $save = document.getElementById('save');
		        $sel = document.getElementById('sel');
		        $imgs = document.getElementById('imgs');
		        $imgW = document.getElementById('imgW');
		        $imgH = document.getElementById('imgH');
		        // bind();
		        // draw();
		    }
		    function bind () {
		        canvas.onmousedown = function(e) {
		            bMouseIsDown = true;
		            iLastX = e.clientX - canvas.offsetLeft + (window.pageXOffset||document.body.scrollLeft||document.documentElement.scrollLeft);
		            iLastY = e.clientY - canvas.offsetTop + (window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop);
		        }
		        canvas.onmouseup = function() {
		            bMouseIsDown = false;
		            iLastX = -1;
		            iLastY = -1;
		        }
		        canvas.onmousemove = function(e) {
		            if (bMouseIsDown) {
		                var iX = e.clientX - canvas.offsetLeft + (window.pageXOffset||document.body.scrollLeft||document.documentElement.scrollLeft);
		                var iY = e.clientY - canvas.offsetTop + (window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop);
		                ctx.moveTo(iLastX, iLastY);
		                ctx.lineTo(iX, iY);
		                ctx.stroke();
		                iLastX = iX;
		                iLastY = iY;
		            }
		        };
		        
		        $save.onclick = function (e) {
		            var type = $sel.value,
		                w = $imgW.value,
		                h = $imgH.value;
		            Canvas2Image.saveAsImage(canvas, w, h, type);
		        }
		        
		    }
		    function draw () {
		        ctx.fillStyle = '#ffffff';
		        ctx.fillRect(0, 0, 600, 400);
		        ctx.fillStyle = 'red';
		        ctx.fillRect(100, 100, 50, 50);
		    }
		    
		    
		    // onload = init;
		</script>
	</body>
</html>
