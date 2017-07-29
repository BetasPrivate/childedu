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
<style type="text/css">
    .tips{
    position:fixed;
    padding:10px;
    font-size:14px;
    line-height:14px;
    left:50%;
    top:200px;
    -webkit-transform:translate(-50%);
    transform:translate(-50%);
    background-color:rgba(0,0,0,.7);
    text-align:center;
    color:#fff;
    z-index:101;
    box-sizing:content-box;
    border-radius:5px
}
</style>
<div style="width: 80%;" class="container-fluid">
    <table class="table table-hover table-condensed">
        <caption>产品兑换记录</caption>
        <thead class="row">
            <tr>
                <th class="col-md-2">序号</th>
                <th class="col-md-1">消耗积分</th>
                <th class="col-md-1">产品名称 * 数量</th>
                <th class="col-md-1">兑换人</th>
                <th class="col-md-2">兑换时间</th>
                <th class="col-md-2">领取时间</th>
                <th class="col-md-2">编辑</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productLogs as $log): ?>
            <tr>
                <td class="col-md-2"><?php echo $log['ProductLog']['id'];?></td>
                <td class="col-md-1"><?php echo $log['ProductLog']['points'];?></td>
                <td class="col-md-1"><?php echo $log['Product']['name'].' * '.$log['ProductLog']['quantity'];?></a></td>
                <td class="col-md-1"><?php echo $log['User']['username'];?></td>
                <td class="col-md-2"><?php echo $log['ProductLog']['created'];?></td>
                <td class="col-md-2" id="doneTime<?php echo $log['ProductLog']['id'];?>"><?php echo $log['ProductLog']['done_time'];?></td>
                <td class="col-md-2"><button class="btn btn-success" <?php echo empty($log['ProductLog']['done_time']) ? '': "disabled='disabled'"?> onclick="setDone(<?php echo $log['ProductLog']['id'];?>)" id="setDone<?php echo $log['ProductLog']['id'];?>">设置领取</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="tips" style="display: none;">☺ 复制成功</div>
</div>
<script type="text/javascript">
    function setDone(logId) {
        var confirmMsg;
        var a = document.getElementById("doneTime"+logId);

        var data = {
            id:logId
        };

        confirmMsg = '确认设置?';

        if (confirm(confirmMsg)) {
            $.ajax({
                'url':'/product/setDone',
                'type':'POST',
                'dataType': 'json',
                'data': data,
                success:function(response) {
                    if (response.status == 1) {
                        a.innerText = response.done_time;
                        $('#setDone'+logId).attr('disabled', true);
                        showTips('设置成功(*^__^*) 嘻嘻……');
                    } else {
                        showTips(response.msg);
                    }
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }
    }

    function showTips(tipNote) {
        $("body").find(".tips").remove().end().append("<div class='tips'>"+tipNote+"</div>"),setTimeout(function(){$(".tips").fadeOut(500)},500);
    }
</script>