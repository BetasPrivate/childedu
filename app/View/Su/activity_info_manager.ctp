<?php 
    echo $this->Html->css([
        'bootstrap.min',
        'bootstrap-theme.min',
    ]);
    echo $this->Html->script(array(
        "jquery-3.2.1.min",
        'bootstrap.min',
    ));
?>
<div style="width: 80%;" class="container-fluid">
    <table class="table table-hover table-condensed">
        <caption>报名记录</caption>
        <thead class="row">
            <tr>
                <th class="col-md-2">活动名称</th>
                <th class="col-md-2">姓名</th>
                <th class="col-md-2">联系方式</th>
                <th class="col-md-2">地址</th>
                <th class="col-md-2">子女姓名</th>
                <th class="col-md-1">子女出生年月</th>
                <th class="col-md-1">报名时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($infos as $info): ?>
            <tr>
                <td class="col-md-2"><?php echo $info['Activity']['title'];?></td>
                <td class="col-md-2"><?php echo $info['ActivityInfo']['user_name'];?></td>
                <td class="col-md-2"><?php echo $info['ActivityInfo']['mobile_phone'];?></td>
                <td class="col-md-2"><?php echo $info['ActivityInfo']['address'];?></td>
                <td class="col-md-1"><?php echo $info['ActivityInfo']['child_name'];?></td>
                <td class="col-md-1"><?php echo $info['ActivityInfo']['child_birth'];?></td>
                <td class="col-md-1"><?php echo $info['ActivityInfo']['created'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>