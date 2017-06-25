<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="css/common.css" />
		<link rel="stylesheet" href="css/index.css" />
		<title>后台配置</title>
	</head>
	<body>
		<header>
			<h2>
				<img src="img/logo.jpg" />
				<span>后台设置</span>
			</h2>
		</header>
		<section class="content">
			<nav>
				<ul>
					<li class="even active">账号管理</li>
					<li class="odd">修改密码</li>
					<li class="even">报名管理</li>
					<li class="odd">报名管理</li>
					<li class="even">打卡管理</li>
					<li class="odd">打卡管理</li>
					<li class="even">商城管理</li>
					<li class="odd">礼品兑换</li>
				</ul>
			</nav>
			<section class="main">
				<!--账户管理-->
				<section class="user">
					<h2 class="check1">
						<ul>
							<li class="selected">填写用户名</li>
							<li>修改密码</li>
							<li>密码</li>
						</ul>
					</h2>
					<!--填写用户名-->
					<div class="user_name">
						<form action="" method="" onsubmit="return false">
							<h3><input type="tel" name="phone" placeholder="请输入您的手机号"/></h3>
							<!--<h4><input type="text" name="code" placeholder="请输入验证码"/><img src="img/user_pic1.jpg" /><span>看不清？</span></h4>-->
							<h5><input type="submit" value="下一步"/></h5>
						</form>
					</div>
					<!--修改密码-->
					<div class="change_key">
						<form action="" method="" onsubmit="return false">
							<h3><input type="password" name="newkey" placeholder="请输入新密码"/></h3>
							<h4>由6~19个英文或数字组成</h4>
							<h5><input type="password" name="submit_newkey" placeholder="确认新密码"/></h5>
							<h6><input type="submit" value="确定"/></h6>
						</form>
					</div>
				</section>
				<!--报名管理-->
				<section class="apply">
					<h2>
						<form action="" method="" onsubmit="return false">
							<ul>
								<li>
									<span>报名地址：</span><a href="#">www.baidu.com</a>
								</li>
								<li>
									<span>标题：</span><input type="text" name="title"/>
								</li>
								<li>
									<span>缩略图：</span><img src="img/apply_pic1.jpg" width="302" height="171" />
								</li>
								<li>
									<span>开始时间：</span><input type="text" name="start_time"/>
								</li>
								<li>
									<span>截止时间：</span><input type="text" name="end_time"/>
								</li>
								<li class="clearfix">
									<span>设置字段：</span><em>童年</em><em>童年</em><i>添加</i>
								</li>
								<li>
									<span>描述：</span><textarea></textarea>
								</li>
								<li>
									<input type="submit" value="保存"/>
								</li>
							</ul>
						</form>
					</h2>
					<h3>
						<span>二维码</span>
						<img src="img/apply_pic_code.jpg" />
					</h3>
					<h4>
						<span>选择报名类型</span>
						<p>在线报名</p>
						<p class="line_out">在线报名<br />现场核销</p>
					</h4>
				</section>
				<section class="sign">
					<h2 class="clearfix"><span>报名</span><p>添加打卡类型</p></h2>
					<h3>
						<div class="sign_menu">
							<ul class="sign_show">
								<li class="clearfix">
									<span>陪伴阅读打卡</span><button class="look">查看打卡</button><button class="revise">修改</button><em><i></i>删除</em>
								</li>
								<li class="clearfix">
									<span>活动打卡</span><button class="look">查看打卡</button><button class="revise">修改</button><em><i></i>删除</em>
								</li>
								<li class="clearfix">
									<span>课堂打卡</span><button class="look">查看打卡</button><button class="revise">修改</button><em><i></i>删除</em>
								</li>
								<li class="clearfix">
									<span>助教打卡</span><button class="look">查看打卡</button><button class="revise">修改</button><em><i></i>删除</em>
								</li>
							</ul>
							<ul class="sign_hidden" style="display:none">
								<li class="clearfix">
									<span>活动打卡</span><button class="look">查看打卡</button><button class="revise">修改</button><em><i></i>删除</em>
								</li>
							</ul>
						</div>
						<div class="sign_details sign_details1">
							<form action="" method="" onsubmit="return false">
								<dl>
									<dd class="sign_name">
										<span>打卡名称</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>打卡积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>分享积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>单次助力积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>助力积分最大额度</span><input type="text" name="sign_name" />
									</dd>
									<dd class="clearfix">
										<span>上传背景图</span>
										<em id="imagePreview">
											<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
										</em>
									</dd>
									<dd>
										<input type="submit" value="保存"/> 
									</dd>
								</dl>
							</form>
						</div>
						<div class="sign_details sign_details2">
							<form action="" method="" onsubmit="return false">
								<dl>
									<dd class="sign_name">
										<span>打卡名称</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>打卡积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>分享积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>单次助力积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>助力积分最大额度</span><input type="text" name="sign_name" />
									</dd>
									<dd class="clearfix">
										<span>上传背景图</span>
										<em id="imagePreview">
											<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
										</em>
									</dd>
									<dd>
										<input type="submit" value="保存"/> 
									</dd>
								</dl>
							</form>
						</div>
						<div class="sign_details sign_details3">
							<form action="" method="" onsubmit="return false">
								<dl>
									<dd class="sign_name">
										<span>打卡名称</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>打卡积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>分享积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>单次助力积分</span><input type="text" name="sign_name" />
									</dd>
									<dd>
										<span>助力积分最大额度</span><input type="text" name="sign_name" />
									</dd>
									<dd class="clearfix">
										<span>上传背景图</span>
										<em id="imagePreview">
											<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
										</em>
									</dd>
									<dd>
										<input type="submit" value="保存"/> 
									</dd>
								</dl>
							</form>
						</div>
					</h3>
				</section>
				<section class="market">
					<h3>
						<div class="market_menu">
							<em><span class="addtype">添加类型</span></em>
							<p>名称</p>
							<ul class="market_show">
								<li class="clearfix">
									<span>课本</span>
									<button>修改</button>
									<em><i></i>删除</em>
								</li>
								<li class="clearfix">
									<span>户外</span>
									<button>修改</button>
									<em><i></i>删除</em>
								</li>
								<li class="clearfix">
									<span>文具</span>
									<button>修改</button>
									<em><i></i>删除</em>
								</li>
							</ul>
							<ul class="market_hidden" style="display:none">
								<li class="clearfix">
									<span>课本</span>
									<button>修改</button>
									<em><i></i>删除</em>
								</li>
							</ul>
						</div>
						<div class="market_details market_details1">
							<form action="" method="" onsubmit="return false">
								<ul>
									<li class="market_name">
										<span>名称</span>
										<input type="text" name="market_details_name" />
									</li>
									<li class="clearfix radio">
										<span>是否首页推荐</span>
										<dl class="clearfix">
											<dd class="checked">
												<i></i>
												是
											</dd>
											<dd>
												<i></i>
												否
											</dd>
										</dl>
									</li>
									<li>
										<span>类别</span>
										<select>
											<option value="a">玩子礼物</option>
											<option value="b">在线课程</option>
										</select>
									</li>
									<li>
										<span>图片</span>
										<img src="img/market_pic1.jpg" />
									</li>
									<li>
										<span>价格</span>
										<input type="text" name="market_details_name" />
									</li>
									<li>
										<span>库存</span>
										<input type="text" name="market_details_name" />
									</li>
									<li>
										<span>规格</span>
										<input type="text" name="market_details_name" />
									</li>
									<li class="clearfix radio">
										<span>上架中</span>
										<dl class="clearfix">
											<dd class="checked">
												<i></i>
												是
											</dd>
											<dd>
												<i></i>
												否
											</dd>
										</dl>
									</li>
									<li class="text">
										<span>产品内容</span>
										<textarea></textarea>
									</li>
									<li>
										<input type="submit" value="保存"/> 
									</li>
								</ul>
							</form>
						</div>
						<div class="market_details market_details2">
							<form action="" method="" onsubmit="return false">
								<ul>
									<li class="market_name">
										<span>名称</span>
										<input type="text" name="market_details_name" />
									</li>
									<li class="clearfix radio">
										<span>是否首页推荐</span>
										<dl class="clearfix">
											<dd class="checked">
												<i></i>
												是
											</dd>
											<dd>
												<i></i>
												否
											</dd>
										</dl>
									</li>
									<li>
										<span>类别</span>
										<select>
											<option value="a">玩子礼物</option>
											<option value="b">在线课程</option>
										</select>
									</li>
									<li>
										<span>图片</span>
										<img src="img/market_pic1.jpg" />
									</li>
									<li>
										<span>价格</span>
										<input type="text" name="market_details_name" />
									</li>
									<li>
										<span>库存</span>
										<input type="text" name="market_details_name" />
									</li>
									<li>
										<span>规格</span>
										<input type="text" name="market_details_name" />
									</li>
									<li class="clearfix radio">
										<span>上架中</span>
										<dl class="clearfix">
											<dd class="checked">
												<i></i>
												是
											</dd>
											<dd>
												<i></i>
												否
											</dd>
										</dl>
									</li>
									<li class="text">
										<span>产品内容</span>
										<textarea></textarea>
									</li>
									<li>
										<input type="submit" value="保存"/> 
									</li>
								</ul>
							</form>
						</div>
					</h3>
				</section>
			</section>
		</section>
		<script src="js/jquery-3.2.1.min.js"></script>
		<script>
		$(document).ready(function(){
			//点击导航跳转到对应页面
			$("nav ul li:even").click(function(){
				$("nav ul li:even").removeClass("active");
				$(this).addClass("active");
				for(i=0;i<$("nav ul li:even").length;i++){
					var m=$("nav ul li:even")[i];
					$(m).attr("no",i+1);
				}
				if($(this).attr("no")==1){
					$(".main section").css({display:"none"});
					$(".user").css({display:"block"});
					$(".user h2 li").removeClass("selected");
					$($(".user h2 ul").children()[0]).addClass("selected");
					$(".user div").css({display:"none"});
					$(".user .user_name").css({display:"block"});
					$(".user .change_key").css({display:"none"});
				}else if($(this).attr("no")==2){
					$(".main section").css({display:"none"});
					$(".apply").css({display:"block"});
					$(".apply h4").css({display:"block"});
					$(".apply h3").css({display:"none"});
				}else if($(this).attr("no")==3){
					$(".main section").css({display:"none"});
					$(".sign").css({display:"block"});
					$(".sign_menu").css({display:"block"});
					$(".sign_details").css({display:"none"});
				}else if($(this).attr("no")==4){
					$(".main section").css({display:"none"});
					$(".market").css({display:"block"});
					$(".market_menu").css({display:"block"});
					$(".market_details").css({display:"none"});
				}
			})
			
			
			
			
			//账户管理tab修改密码
			//点击填写用户名页的下一步，跳转修改密码页
			$(".user_name input:submit").click(function(){
				$(".user h2").removeClass("check1");
				$(".user h2").addClass("check2");
				$(".user_name").css({display:"none"});
				$(".change_key").css({display:"block"});
				var onow=$(".user h2 ul").children("li")[0];
				var onext=$(".user h2 ul").children("li")[1]
				$(onow).removeClass("selected");
				$(onext).addClass("selected");
			})
			//点击修改密码确定，跳转完成
			$(".change_key input:submit").click(function(){
				$(".user h2").removeClass("check2");
				$(".user h2").addClass("check3");
				var onow=$(".user h2 ul").children("li")[1];
				var onext=$(".user h2 ul").children("li")[2]
				$(onow).removeClass("selected");
				$(onext).addClass("selected");
			})
			
			//报名管理
			//点击在线或在线报名现场核销跳出对应二维码
			$(".apply h4 p").click(function(){
				$(".apply h4 p").remove("sele");
				$(this).addClass("sele");
				$(".apply h4").css({display:"none"});
				$(".apply h3").css({display:"block"});
			})
			
			
			//打卡管理
			//点击添加打卡类型，跳转打卡详细页
			var start="on";//点击添加打卡类型变量
			$(".sign h2 p").click(function(){
				if(start=="off"){
					return;
				}
				start="off";
				$(".sign_menu").css({display:"none"});
				$(".sign_details1").css({display:"block"});
				$(".sign_details1 input:text").val("");
				$(".sign_details1 em img").attr("src","");
			})
			//点击查看详情，跳转打卡详细页
			$(".sign h3 .look").click(function(){
				start="off";
				$(".sign_menu").css({display:"none"});
				$(".sign_details2").css({display:"block"});
				$(".sign_details2 .sign_name input").val($(this).parent().children("span").html());
				$(".sign_details2 input:text,.sign_details input:file").attr("disabled",true);
			})
			//点击修改，跳转打卡详情页
			$(".sign h3 .revise").click(function(){
				start="off";
				$(".sign_menu").css({display:"none"});
				$(".sign_details3").css({display:"block"});
				$($(".sign_details3 input:text")[0]).val($(this).parent().children("span").html());
			})
			//点击详细页1保存，跳回打卡记录页面，并新建一个打卡类型
			$(".sign_details1 input:submit").click(function(){
				var oname=$(".sign_name input").val();
				if(oname==""){
					alert("请填写名称");
					return false;
				}else{
					var oli=$(".sign_hidden li").clone(true);
					$(oli).children("span").html(oname);
					$(".sign_menu ul.sign_show").append(oli);
					$(".sign_details1").css({display:"none"});
					$(".sign_menu").css({display:"block"});
					start="on";
				}	
			})
			//点击详情页2保存，跳转打卡记录页面，不新建
			$(".sign_details2 input:submit").click(function(){
				$(".sign_details2").css({display:"none"});
				$(".sign_menu").css({display:"block"});	
				start="on";
			})
			//点击详情页3保存，跳转打卡记录页面，不新建
			$(".sign_details3 input:submit").click(function(){
				$(".sign_details3").css({display:"none"});
				$(".sign_menu").css({display:"block"});	
				start="on";
			})
			//点击删除按钮，删除当前列
			$(".sign_menu li em").click(function(){
				$(this).parents("li").remove();
			})
			
			
			
			
			
			
			
			
			//商城管理
			//点击添加类型，跳转打卡详细页
			$(".addtype").click(function(){
				$(".market_menu").css({display:"none"});
				$(".market_details1").css({display:"block"});
				$(".market_details1 input:text").val("");
				$(".market_details1 textarea").val("");
			})
			//点击详细页1保存，调回打卡记录页面
			$(".market_details1 input:submit").click(function(){
				var oname=$(".market_details1 .market_name input").val();
				if(oname==""){
					alert("请填写名称");
					return false;
				}else{
					$(".market_details1").css({display:"none"});
					$(".market_menu").css({display:"block"});
					var oli=$(".market_hidden li").clone(true);
					$(oli).children("span").html(oname);
					$(".market_menu ul.market_show").append(oli);
				}
			})
			//点击删除按钮，删除当前列
			$(".market_menu li em").click(function(){
				$(this).parents("li").remove();
			})
			//点击是否切换
			$(".market_details1 dl dd").click(function(){
				$(this).parent().children("dd").removeClass("checked");
				$(this).addClass("checked");
			})
			//点击修改按钮，跳转详情页2
			$(".market_menu button").click(function(){
				$(".market_details2 .market_name input").val($(this).parent().children("span").html());
				$(".market_menu").css({display:"none"});
				$(".market_details2").css({display:"block"});
			})
			$(".market_details2 input:submit").click(function(){
				$(".market_menu").css({display:"block"});
				$(".market_details2").css({display:"none"});
			})
		})
		
		
		
		
		
		</script>
		<!--点击打卡管理中的选择背景图上传图片-->
		<script type="text/javascript" src="js/accompany_read.js" ></script>
	</body>
</html>
