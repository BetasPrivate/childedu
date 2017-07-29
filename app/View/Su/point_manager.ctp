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
        <caption>所有积分记录</caption>
        <thead class="row">
            <tr>
                <th class="col-md-2">买家昵称</th>
                <th class="col-md-3">操作</th>
                <th class="col-md-1">单次积分</th>
                <th class="col-md-2">初次操作时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pointLogs as $pointLog): ?>
            <tr>
                <td class="col-md-2 <?php echo $pointLog['class_name'];?>"><?php echo $pointLog['User']['username'];?></td>
                <td class="col-md-3 <?php echo $pointLog['class_name'];?>"><?php echo $pointLog['origin_action'];?></td>
                <td class="col-md-1 <?php echo $pointLog['class_name'];?>">
                    <?php if ($pointLog['PointLog']['action_type'] == 1):?>
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    <?php elseif ($pointLog['PointLog']['action_type'] == 0):?>
                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                    <?php endif;?>
                    <?php echo $pointLog['PointLog']['point'];?>
                </td>
                <td class="col-md-2 <?php echo $pointLog['class_name'];?>"><?php echo $pointLog['PointLog']['created'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>