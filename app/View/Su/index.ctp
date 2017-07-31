<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="/css/common.css" />
		<link rel="stylesheet" href="/css/index.css" />
		<title>后台配置</title>
	</head>
	<body>
		<header>
			<h2>
				<img src="/img/logo.jpg" />
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
					<li class="odd"><a href="/su/productLogs" target="_blank">兑换详情</a></li>
				</ul>
			</nav>
			<section class="main">
				<!--账户管理-->
				<section class="user">
					<h2 class="check1">
						<ul>
							<li class="selected">填写用户名</li>
							<li>修改密码</li>
							<li><a href="/su/userManager" target="_blank">用户管理</a></li>
						</ul>
					</h2>
					<!--填写用户名-->
					<div class="user_name">
						<form action="" method="" onsubmit="return false">
							<h3><input type="tel" name="phone" id="user_info_to_change" placeholder="请输入用户名或者手机号"/></h3>
							<!--<h4><input type="text" name="code" placeholder="请输入验证码"/><img src="img/user_pic1.jpg" /><span>看不清？</span></h4>-->
							<h5><input type="submit" value="下一步"/></h5>
						</form>
					</div>
					<!--修改密码-->
					<div class="change_key">
						<form action="" method="" onsubmit="return false">
							<h3><input type="password" name="newkey" id="user_passwd_n_to_change" placeholder="请输入新密码"/></h3>
							<h4>长度大于等于8</h4>
							<h5><input type="password" name="submit_newkey" id="user_passwd_nc_to_change" placeholder="确认新密码"/></h5>
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
									<span>查看记录：</span><a href="/su/activityManager" target="_blank">活动一览</a>&nbsp&nbsp&nbsp&nbsp<a href="/su/activityInfoManager" target="_blank">活动报名信息</a>
								</li>
								<li>
									<span>标题：</span><input type="text" name="title" id="activity_title" />
								</li>
								<li>
									<span>开始时间：</span><input type="text" name="start_time" id="activity_start_time" placeholder="例：2017-07-25" />
								</li>
								<li>
									<span>截止时间：</span><input type="text" name="end_time" id="activity_end_time" placeholder="例：2017-07-25" />
								</li>
								<li>
									<span>报名分数：</span><input type="text" id="activity_point_onsubmit" />
								</li>
								<li>
									<span>扫码分数：</span><input type="text" id="activity_point_onscan" />
								</li>
								<li>
									<span>人数限制：</span><input type="text" id="activity_people_limation" />
								</li>
								<li>
									<span>位置：</span><input type="text" id="activity_location" />
								</li>
								<li class="clearfix">
									<span title="蓝色为选中">设置字段：</span>
									<?php foreach($result['activity_fields'] as $name => $fieldText):?>
										<em id="<?php echo 'activity_'.$name;?>" onclick="addToActivityFields('<?php echo $name;?>')"><?php echo $fieldText;?></em>
									<?php endforeach;?>
								</li>
								<li>
									<span>描述：</span><textarea id="activity_description"></textarea>
								</li>
								<li>
									<input type="submit" value="保存" onclick="saveActivity()" />
								</li>
							</ul>
						</form>
					</h2>
					<h3>
						<span>二维码</span>
						<img src="/img/apply_pic_code.jpg" />
					</h3>
					<h4>
						<span>选择活动类型</span>
						<select id="activity_type">
							<option value="0" selected="true">在线报名</option>
							<option value="1">现场核销</option>
						</select>
							<span>活动图：
						</span><input type="file" id="activity_img">
						<img src="" id="activity_img_to_show" style="display: none;">
						<!-- <p>在线报名</p>
						<p class="line_out">在线报名<br />现场核销</p> -->
					</h4>
				</section>
				<section class="sign">
					<h2 class="clearfix"><span>查看记录</span><p><a href="/su/pointManager" target="blank">积分记录</a>&nbsp&nbsp&nbsp&nbsp<a href="/su/punchRecordManager" target="blank">打卡记录</a></p></h2>
					<h2 class="clearfix"><span>报名</span><p>添加打卡类型&nbsp&nbsp&nbsp&nbsp<a href="/su/punchBgImgManager" target="blank">编辑打卡图片</a></p></h2>
					<h3>
						<div class="sign_menu">
							<ul class="sign_show">
								<?php foreach($result['punch_types'] as $key => $punchType):?>
								<li class="clearfix">
									<span><?php echo $punchType['PunchType']['name'];?></span><button class="look" onclick="getCurrentPunchType(<?php echo $key;?>)">查看打卡</button><button class="revise" onclick="getCurrentPunchType(<?php echo $key;?>)">修改</button><em onclick="getCurrentPunchType(<?php echo $key;?>)"><i></i>删除</em>
								</li>
								<?php endforeach;?>
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
										<span>打卡名称</span><input type="text" name="sign_name" id="punch_name" />
									</dd>
									<dd>
										<span>打卡积分</span><input type="text" name="sign_name" id="punch_point" />
									</dd>
									<dd>
										<span>分享积分</span><input type="text" name="sign_name" id="punch_share_point" />
									</dd>
									<dd>
										<span>单次助力积分</span><input type="text" name="sign_name" id="punch_assistant_point" />
									</dd>
									<dd>
										<span>助力积分最大额度</span><input type="text" name="sign_name" id="punch_assistant_total" />
									</dd>
									<!-- <dd class="clearfix">
										<span>上传背景图</span>
										<em id="imagePreview">
											<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
										</em>
									</dd> -->
									<dd>
										<input type="submit" value="保存" onclick="savePunchType(1)" /> 
									</dd>
								</dl>
							</form>
						</div>
						<div class="sign_details sign_details2">
							<form action="" method="" onsubmit="return false">
								<dl>
									<dd class="sign_name">
										<span>打卡名称</span><input type="text" name="sign_name" id="punch_name2" />
									</dd>
									<dd>
										<span>打卡积分</span><input type="text" name="sign_name" id="punch_point2" />
									</dd>
									<dd>
										<span>分享积分</span><input type="text" name="sign_name" id="punch_share_point2" />
									</dd>
									<dd>
										<span>单次助力积分</span><input type="text" name="sign_name" id="punch_assistant_point2" />
									</dd>
									<dd>
										<span>助力积分最大额度</span><input type="text" name="sign_name" id="punch_assistant_total2" />
									</dd>
									<!-- <dd class="clearfix">
										<span>上传背景图</span>
										<em id="imagePreview">
											<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
										</em>
									</dd> -->
									<!-- <dd>
										<input type="submit" value="保存" onclick="savePunchType(2)"/> 
									</dd> -->
								</dl>
							</form>
						</div>
						<div class="sign_details sign_details3">
							<form action="" method="" onsubmit="return false">
								<dl>
									<dd class="sign_name">
										<span>打卡名称</span><input type="text" name="sign_name" id="punch_name3" />
									</dd>
									<dd>
										<span>打卡积分</span><input type="text" name="sign_name" id="punch_point3" />
									</dd>
									<dd>
										<span>分享积分</span><input type="text" name="sign_name" id="punch_share_point3" />
									</dd>
									<dd>
										<span>单次助力积分</span><input type="text" name="sign_name" id="punch_assistant_point3" />
									</dd>
									<dd>
										<span>助力积分最大额度</span><input type="text" name="sign_name" id="punch_assistant_total3" />
									</dd>
									<!-- <dd class="clearfix">
										<span>上传背景图</span>
										<em id="imagePreview">
											<input id="imageInput" type="file" name="myPhoto" onchange="loadImageFile();" />
										</em>
									</dd> -->
									<dd>
										<input type="submit" value="保存" onclick="savePunchType(3)"/> 
									</dd>
								</dl>
							</form>
						</div>
					</h3>
				</section>
				<section class="market">
					<h3>
						<div class="market_menu">
							<em><span><span class="addtype">添加产品</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="/su/productManager" target="_blank">管理所有产品</a></span></em>
							<em><span onclick="addProductType()">添加产品类型</span></em>
							<p>产品类型</p>
							<ul class="market_show">
								<?php foreach($result['product_types'] as $key => $productType):?>
								<li class="clearfix">
									<span><?php echo $productType['ProductType']['name'];?></span>
									<button onclick="editProductType(<?php echo $key;?>)">修改</button>
									<em onclick="deleteProductType(<?php echo $key;?>)"><i></i>删除</em>
								</li>
								<?php endforeach;?>
							</ul>
						</div>
						<div class="market_details market_details1">
							<form action="" method="" onsubmit="return false">
								<ul>
									<li class="market_name">
										<span>名称</span>
										<input type="text" name="market_details_name" id="product_name" />
									</li>
									<li class="clearfix radio">
										<span>商品类型</span>
										<dl class="clearfix">
											<dd class="checked" onclick="isVirtual=0;$('#is_front_page').css('display', 'block');$('#product_type_li').css('display', 'block');">
												<i></i>
												实物商品
											</dd>
											<dd value="0" onclick="isVirtual=1;$('#product_type_li').css('display', 'none');">
												<i></i>
												在线课程
											</dd>
										</dl>
									</li>
									<li class="clearfix radio" id="is_front_page">
										<span>是否首页推荐</span>
										<dl class="clearfix">
											<dd class="checked" onclick="isFrontPage=1;">
												<i></i>
												是
											</dd>
											<dd value="0" onclick="isFrontPage=0;">
												<i></i>
												否
											</dd>
										</dl>
									</li>
									<li id="product_type_li">
										<span>类别</span>
										<select id="product_type">
											<?php foreach($result['product_types'] as $key => $productType):?>
											<option value="<?php echo $productType['ProductType']['id'];?>"><?php echo $productType['ProductType']['name'];?></option>
											<?php endforeach;?>
										</select>
									</li>
									<li>
										<span>图片1</span>
										<input type="file" id="product_img1">
										<img src="" id="product_img_to_show1" style="display: none;">
									</li>
									<li>
										<span>图片2</span>
										<input type="file" id="product_img2">
										<img src="" id="product_img_to_show2" style="display: none;">
									</li>
									<li>
										<span>图片3</span>
										<input type="file" id="product_img3">
										<img src="" id="product_img_to_show3" style="display: none;">
									</li>
									<li>
										<span>价格</span>
										<input type="text" name="market_details_name" id="product_price" />
									</li>
									<li>
										<span>库存</span>
										<input type="text" name="market_details_name" id="product_stock" />
									</li>
									<li>
										<span>规格</span>
										<input type="text" name="market_details_name" id="product_sku_type" />
									</li>
									<li class="clearfix radio">
										<span>上架中</span>
										<dl class="clearfix" id="is_onsale">
											<dd class="checked" onclick="isOnsale=1;">
												<i></i>
												是
											</dd>
											<dd onclick="isOnsale=0;">
												<i></i>
												否
											</dd>
										</dl>
									</li>
									<li class="text">
										<span>产品介绍</span>
										<textarea id="product_description"></textarea>
									</li>
									<li>
										<input type="submit" value="保存" onclick="saveProduct()" /> 
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
		var activityFields = <?php echo json_encode($result['activity_fields']);?>;
		var productTypes = <?php echo json_encode($result['product_types']);?>;
		var currentFields = [];
		var isFrontPage = 1;
		var isOnsale = 1;
		var isVirtual = 0;

	    function readFile() {
  
		  	if (this.files && this.files[0]) {
		    
			    var FR= new FileReader();
			    
			    FR.addEventListener("load", function(e) {
			      document.getElementById("activity_img_to_show").src = e.target.result;
			    }); 
			    
			    FR.readAsDataURL( this.files[0] );
		  	}
		  
		}

		document.getElementById("activity_img").addEventListener("change", readFile);

		function addToActivityFields(name) {
			var currentName = 'activity_' + name;
			if (currentFields.indexOf(name) >= 0) {
				currentFields.splice(currentFields.indexOf(name),1);
				$('#'+currentName).css('background', '#ffe9d0');
			} else {
				$('#'+currentName).css('background', '#33CCFF');
				currentFields.push(name);
			}
			console.log(currentFields);
		}

		function saveActivity() {
			var title = $('#activity_title').val();
			var startTime = $('#activity_start_time').val();
			var endTime = $('#activity_end_time').val();
			var fields = currentFields;
			var description = $('#activity_description').val();
			var ponitOnScan = $('#activity_point_onscan').val();
			var pointOnSubmit = $('#activity_point_onsubmit').val();
			var type = $('#activity_type').val();
			var file = $('#activity_img_to_show')[0].src == undefined ? null : $('#activity_img_to_show')[0].src;
			var peopleLimation = $('#activity_people_limation').val();
			var location = $('#activity_location').val();

			var data = {
				title:title,
				start_time:startTime,
				end_time:endTime,
				fields:fields,
				description:description,
				point_onscan:ponitOnScan,
				point_onsubmit:pointOnSubmit,
				type:type,
				people_limation:peopleLimation,
				location:location,
			};

			if (file) {
				data.img = file;
			}

			<?php if(!empty($result['activityId'])):?>
			data.id = <?php echo $result['activityId'];?>
			<?php endif;?>

			$.ajax({
				url:'/activity/createActivity/',
				type:'POST',
				dataType:'json',
				data:data,
				success:function(res){
					if (res.status == 1) {
						if (confirm('保存成功，是否现在查看？')) {
							window.location.href = '/activity/view/' + res.id;
						}
					}
					console.log(res);
				},
				error:function(res){
					console.log(res);
				}
			})
		}



		var punchTypes = <?php echo json_encode($result['punch_types']);?>;
		var currentPunchType;

		function getCurrentPunchType(id) {
			currentPunchType = punchTypes[id];
		}

		function initPunchPanel() {
			$("#punch_name").val(currentPunchType.PunchType.name);
			$("#punch_point").val(currentPunchType.PunchType.punch_point);
			$("#punch_share_point").val(currentPunchType.PunchType.share_point);
			$("#punch_assistant_point").val(currentPunchType.PunchType.assistant_point);
			$("#punch_assistant_total").val(currentPunchType.PunchType.assistant_point_total);
			$("#punch_name2").val(currentPunchType.PunchType.name);
			$("#punch_point2").val(currentPunchType.PunchType.punch_point);
			$("#punch_share_point2").val(currentPunchType.PunchType.share_point);
			$("#punch_assistant_point2").val(currentPunchType.PunchType.assistant_point);
			$("#punch_assistant_total2").val(currentPunchType.PunchType.assistant_point_total);
			$("#punch_name3").val(currentPunchType.PunchType.name);
			$("#punch_point3").val(currentPunchType.PunchType.punch_point);
			$("#punch_share_point3").val(currentPunchType.PunchType.share_point);
			$("#punch_assistant_point3").val(currentPunchType.PunchType.assistant_point);
			$("#punch_assistant_total3").val(currentPunchType.PunchType.assistant_point_total);
		}

		function savePunchType(typeId) {
			if (typeId == 1) {
				var data = {
					name: $("#punch_name").val(),
					punch_point: $("#punch_point").val(),
					share_point: $("#punch_share_point").val(),
					assistant_point: $("#punch_assistant_point").val(),
					assistant_point_total: $("#punch_assistant_total").val(),
				};
				var url = '/punch/editPunchType';
			} else if (typeId == 3) {
				var data = {
					id:currentPunchType.PunchType.id,
					name: $("#punch_name3").val(),
					punch_point: $("#punch_point3").val(),
					share_point: $("#punch_share_point3").val(),
					assistant_point: $("#punch_assistant_point3").val(),
					assistant_point_total: $("#punch_assistant_total3").val(),
				};
				var url = '/punch/createNewPunchType';
			} else {
				alert('禁止的操作');
				return;
			}
			$.ajax({
				'url': url,
				'method': 'POST',
				'dataType': 'json',
				'data': data,
				success:function(res) {
					if (res.status == 1) {
						alert('保存成功(*^__^*) 嘻嘻……');
					} else {
						alert(res.msg);
					}
				},
				error:function(res) {

				}
			})
		}

		//products
		function addProductType() {
			var name = prompt('输入新的产品类型', "");
			if (name == null) {
				return;
			}
			var url = '/product/addProductType';
			var data = {
				name:name,
			};
			$.ajax({
				'url': url,
				'method': 'POST',
				'dataType': 'json',
				'data': data,
				success:function(res) {
					if (res.status == 1) {
						alert('保存成功(*^__^*) 嘻嘻……');
					} else {
						alert(res.msg);
					}
				},
				error:function(res) {

				}
			})
		}

		function editProductType(index) {
			var name = prompt('名称', productTypes[index].ProductType.name);
			if (name == null) {
				return;
			}
			var url = '/product/editProductType';
			var data = {
				id:productTypes[index].ProductType.id,
				name:name,
			};
			$.ajax({
				'url': url,
				'method': 'POST',
				'dataType': 'json',
				'data': data,
				success:function(res) {
					if (res.status == 1) {
						alert('保存成功(*^__^*) 嘻嘻……');
					} else {
						alert(res.msg);
					}
				},
				error:function(res) {

				}
			})
		}

		function deleteProductType(index) {
			if (!confirm('删除产品类型后，与其相关的商品也会全部失效，确定删除？')) {
				return;
			}
			var url = '/product/editProductType';
			var data = {
				id:productTypes[index].ProductType.id,
				is_deleted:1,
			};
			$.ajax({
				'url': url,
				'method': 'POST',
				'dataType': 'json',
				'data': data,
				success:function(res) {
					if (res.status == 1) {
						alert('删除成功!');
					} else {
						alert(res.msg);
					}
				},
				error:function(res) {

				}
			})
		}

		function saveProduct(){
			var productName = $('#product_name').val();
			var productPrice = $('#product_price').val();
			var productStock = $('#product_stock').val();
			var productSkuType = $('#product_sku_type').val();
			var productType = $('#product_type').val();
			var productDescription = $('#product_description').val();
			var file1 = $('#product_img_to_show1')[0].src;
			var file2 = $('#product_img_to_show2')[0].src;
			var file3 = $('#product_img_to_show3')[0].src;

			var data = {
				name:productName,
				is_front_page:isFrontPage,
				price:productPrice,
				stock:productStock,
				sku_type:productSkuType,
				is_onsale:isOnsale,
				product_type_id:productType,
				description:productDescription,
				file1:file1,
				file2:file2,
				file3:file3,
				is_virtual:isVirtual,
			};
			var url = '/product/addProduct';
			$.ajax({
				'url':url,
				'method':'POST',
				'dataType':'json',
				'data':data,
				success:function(res) {
					if (res.status == 1) {
						alert('保存成功');
					} else {
						alert(res.msg);
					}
				},
				error:function(res) {
					console.log(res);
				}
			})
		}

		function readFileProduct1() {
  
		  	if (this.files && this.files[0]) {
		    
			    var FR= new FileReader();
			    
			    FR.addEventListener("load", function(e) {
			      document.getElementById("product_img_to_show1").src = e.target.result;
			    }); 
			    
			    FR.readAsDataURL( this.files[0] );
		  	}
		  
		}
		document.getElementById("product_img1").addEventListener("change", readFileProduct1);

		function readFileProduct2() {
  
		  	if (this.files && this.files[0]) {
		    
			    var FR= new FileReader();
			    
			    FR.addEventListener("load", function(e) {
			      document.getElementById("product_img_to_show2").src = e.target.result;
			    }); 
			    
			    FR.readAsDataURL( this.files[0] );
		  	}
		  
		}
		document.getElementById("product_img2").addEventListener("change", readFileProduct2);

		function readFileProduct3() {
  
		  	if (this.files && this.files[0]) {
		    
			    var FR= new FileReader();
			    
			    FR.addEventListener("load", function(e) {
			      document.getElementById("product_img_to_show3").src = e.target.result;
			    }); 
			    
			    FR.readAsDataURL( this.files[0] );
		  	}
		  
		}
		document.getElementById("product_img3").addEventListener("change", readFileProduct3);

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

			<?php if (!empty($result['activityId'])):?>
			var a = document.getElementsByTagName('nav');
			var c = a[0].children[0].children[2];

			$('#activity_title').val('<?php echo $result['activity']['Activity']['title'];?>');
			$('#activity_start_time').val('<?php echo $result['activity']['Activity']['start_time'];?>');
			$('#activity_end_time').val('<?php echo $result['activity']['Activity']['end_time'];?>');
			$('#activity_description').val('<?php echo str_replace(array("\r\n", "\r", "\n"), '', $result['activity']['Activity']['description']);?>');
			$('#activity_point_onscan').val('<?php echo $result['activity']['Activity']['point_onscan'];?>');
			$('#activity_point_onsubmit').val('<?php echo $result['activity']['Activity']['point_onsubmit'];?>');
			$('#activity_type').val('<?php echo $result['activity']['Activity']['type'];?>');
			$('#activity_people_limation').val('<?php echo $result['activity']['Activity']['people_limation'];?>');
			$('#activity_location').val('<?php echo $result['activity']['Activity']['location'];?>');
			c.click();

			<?php endif;?>
			
			
			
			
			//账户管理tab修改密码
			//点击填写用户名页的下一步，跳转修改密码页
			$(".user_name input:submit").click(function(){
				checkUserInfo();
			})
			var userIdToChange;

			function checkUserInfo() {
				var info = $('#user_info_to_change').val();
				var url = '/users/checkUserInfo';
				var data = {
					info:info
				};
				$.ajax({
					url:url,
					type:'POST',
					dataType:'json',
					data:data,
					success:function(res){
						if (res.status == 1) {
							userIdToChange = res.user_id;
							$(".user h2").removeClass("check1");
							$(".user h2").addClass("check2");
							$(".user_name").css({display:"none"});
							$(".change_key").css({display:"block"});
							var onow=$(".user h2 ul").children("li")[0];
							var onext=$(".user h2 ul").children("li")[1]
							$(onow).removeClass("selected");
							$(onext).addClass("selected");
						} else {
							alert(res.msg);
						}
					},
					error:function(res){

					}
				})
			}
			//点击修改密码确定，跳转完成
			$(".change_key input:submit").click(function(){
				editUserInfo();
				$(".user h2").removeClass("check2");
				$(".user h2").addClass("check3");
				var onow=$(".user h2 ul").children("li")[1];
				var onext=$(".user h2 ul").children("li")[2]
				$(onow).removeClass("selected");
				$(onext).addClass("selected");
			})

			function editUserInfo() {
				var passwd = document.getElementById('user_passwd_n_to_change').value.trim();
		        var passwdVerify = document.getElementById('user_passwd_nc_to_change').value.trim();
		        if (passwd != passwdVerify) {
		            alert('两次输入的密码不一致，请重试！');
		            return;
		        }
		        if (passwd.length < 8) {
		            alert('密码长度过短！');
		            return;
		        }
		        var data = {
		        	user_id: userIdToChange,
		        	passwd: passwd,
		        };
		        $.ajax({
		            url: '/su/editUserSu',
		            method: 'POST',
		            dataType: 'json',
		            data: data,
		            success: function(res) {
		                if (res.status == 1) {
		                	alert('修改成功！');
		                } else {
		                	alert(res.msg);
		                }
		            },
		            error: function(data) {
		                console.log(data);
		            }
		        })
			}
			
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
				initPunchPanel();
				start="off";
				$(".sign_menu").css({display:"none"});
				$(".sign_details2").css({display:"block"});
				// $(".sign_details2 .sign_name input").val($(this).parent().children("span").html());
				$(".sign_details2 input:text,.sign_details input:file").attr("disabled",true);
			})
			//点击修改，跳转打卡详情页
			$(".sign h3 .revise").click(function(){
				initPunchPanel();
				start="off";
				$(".sign_menu").css({display:"none"});
				$(".sign_details3").css({display:"block"});
				// $($(".sign_details3 input:text")[0]).val($(this).parent().children("span").html());
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
				if (confirm('确认删除？')) {
					$(this).parents("li").remove();
					var url = '/punch/editPunchType';
					var data = {
						id: currentPunchType.PunchType.id,
						is_deleted: 1,
					};
					$.ajax({
						'url': url,
						'method': 'POST',
						'dataType': 'json',
						'data': data,
						success:function(res) {
							if (res.status == 1) {
								alert('保存成功(*^__^*) 嘻嘻……');
							} else {
								alert(res.msg);
							}
						},
						error:function(res) {

						}
					})
				}
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
			// $(".market_menu").click(function(){
			// 	$(".market_details2 .market_name input").val($(this).parent().children("span").html());
			// 	$(".market_menu").css({display:"none"});
			// 	$(".market_details2").css({display:"block"});
			// })
			$(".market_details2 input:submit").click(function(){
				$(".market_menu").css({display:"block"});
				$(".market_details2").css({display:"none"});
			})
		})
		
		function showTips(tipNote) {
	        $("body").find(".tips").remove().end().append("<div class='tips'>"+tipNote+"</div>"),setTimeout(function(){$(".tips").fadeOut(500)},500);
	    }
		
		
		</script>
		<!--点击打卡管理中的选择背景图上传图片-->
		<script type="text/javascript" src="js/accompany_read.js" ></script>
	</body>
</html>
