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
.whole_img {
        width: 20%;
        height: 20%;
    }
</style>
<div style="width: 80%;" class="container-fluid">
    <table class="table table-hover table-condensed">
        <caption>所有积分记录</caption>
        <thead class="row">
            <tr>
                <th class="col-md-2">图片类型</th>
                <th class="col-md-3">预览</th>
                <th class="col-md-1">新图片</th>
                <th class="col-md-2">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($imgs as $img): ?>
            <tr>
                <td><?php echo $img['PunchBgImg']['type_text'];?></td>
                <td><img src="<?php echo $img['PunchBgImg']['url'];?>" class='whole_img' id="img_to_date<?php echo $img['PunchBgImg']['id'];?>"></td>
                <td>
                    <span>新图片</span>
                    <input type="file" id="img<?php echo $img['PunchBgImg']['id'];?>">
                    <img src="" id="img_to_show<?php echo $img['PunchBgImg']['id'];?>" style="display: none;">
                </td>
                <td><button class="btn btn-success" onclick="updateImg(<?php echo $img['PunchBgImg']['id'];?>)">提交</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
     <div class="tips" style="display: none;">☺ 复制成功</div>
</div>
<script type="text/javascript">
    function updateImg(logId) {
        var confirmMsg;
        var file = $('#img_to_show'+logId)[0].src;

        if (file.length < 100) {
            return;
        }

        var data = {
            id:logId,
            file:file,
        };

        confirmMsg = '确认更新?';

        if (confirm(confirmMsg)) {
            $.ajax({
                'url':'/punch/updateImg',
                'type':'POST',
                'dataType': 'json',
                'data': data,
                success:function(response) {
                    if (response.status == 1) {
                        $("#img_to_date"+logId).attr("src", response.url);
                        showTips('更新成功(*^__^*) 嘻嘻……');
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

    <?php foreach($imgs as $key => $img):?>
        function readFileProduct<?php echo $img['PunchBgImg']['id'];?>() {
  
            if (this.files && this.files[0]) {
            
                var FR= new FileReader();
                
                FR.addEventListener("load", function(e) {
                  document.getElementById("img_to_show<?php echo $img['PunchBgImg']['id'];?>").src = e.target.result;
                }); 
                
                FR.readAsDataURL( this.files[0] );
            }
          
        }
        document.getElementById("img<?php echo $img['PunchBgImg']['id'];?>").addEventListener("change", readFileProduct<?php echo $img['PunchBgImg']['id'];?>);
    <?php endforeach;?>
</script>