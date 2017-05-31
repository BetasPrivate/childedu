<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
        <meta name="format-detection" content="telephone=no" />
  	</head>
<?php if ($result['status'] == 1):?>
	<?php $info = $result['data'];?>
	<ul>
		<h4 style="color: green;">报名成功!</h4>
		<li>
			<label class="label label-primary">家长姓名</label>
			<?php echo $info['adultName'];?>
		</li>
		<li>
			<label class="label label-primary">联系方式</label>
			<?php echo $info['adultPhone'];?>
		</li>
		<li>
			<label class="label label-primary">子女姓名</label>
			<?php echo $info['childName'];?>
		</li>
		<li>
			<label class="label label-primary">出生年月</label>
			<?php echo $info['childBirthday'];?>
		</li>
	</ul>
<?php else:?>
	<h4 style="color: red;"><?php echo $result['msg'];?></h4>
<?php endif;?>
</html>