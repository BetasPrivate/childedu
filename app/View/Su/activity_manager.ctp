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
        <caption>所有活动</caption>
        <thead class="row">
            <tr>
                <th class="col-md-2">活动名称</th>
                <th class="col-md-2">起始时间</th>
                <th class="col-md-1">终止时间</th>
                <th class="col-md-1">位置</th>
                <th class="col-md-1">最大人数</th>
                <th class="col-md-2">活动信息字段</th>
                <th class="col-md-3">活动描述</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($activities as $activity): ?>
            <tr>
                <td class="col-md-2">
                    <?php echo $activity['Activity']['title'];?>
                    <?php if ($activity['Activity']['type'] == 1):?>
                        <br>
                        <?php if (empty($activity['Activity']['offline_url'])):?>
                            <button class="btn btn-info" onclick="genQrCode(<?php echo $activity['Activity']['id'];?>)">生成核销二维码</button>
                        <?php else:?>
                            <a href="<?php echo $activity['Activity']['offline_url'];?>" target="_blank">查看核销二维码</a>
                        <?php endif;?>
                    <?php endif;?>
                </td>
                <td class="col-md-2"><?php echo $activity['Activity']['start_time'];?></td>
                <td class="col-md-1"><?php echo $activity['Activity']['end_time'];?></td>
                <td class="col-md-1"><?php echo $activity['Activity']['location'];?></td>
                <td class="col-md-1"><?php echo $activity['Activity']['people_limation'];?></td>
                <td class="col-md-2"><?php echo $activity['Activity']['fields'];?></td>
                <td class="col-md-3"><?php echo $activity['Activity']['description'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function genQrCode($activityId){
        var url = '/su/genQrCodeForActivity';
        var data = {
            id:$activityId,
        };
        $.ajax({
            url:url,
            type:"POST",
            dataType:'json',
            data:data,
            success:function(res){
                if (res.status == 1) {
                    if (confirm('获取成功，现在查看?')) {
                        window.open(res.url,'_blank');
                    }
                } else {
                    alert(res.msg);
                }
            },
            error:function(res){

            }
        });
    }
</script>