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
        <caption>打卡记录</caption>
        <thead class="row">
            <tr>
                <th class="col-md-3">昵称</th>
                <th class="col-md-3">打卡类型</th>
                <th class="col-md-3">心得感受</th>
                <th class="col-md-3">打卡时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($punchRecords as $record): ?>
            <tr>
                <td class="col-md-3"><?php echo $record['User']['username'];?></td>
                <td class="col-md-3"><?php echo $record['PunchType']['name'];?></td>
                <td class="col-md-3"><?php echo $record['PunchRecord']['text'];?></td>
                <td class="col-md-3"><?php echo $record['PunchRecord']['created'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>