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
        <caption>所有产品</caption>
        <thead class="row">
            <tr>
                <th class="col-md-1">产品名称</th>
                <th class="col-md-1">首页展示</th>
                <th class="col-md-1">产品类别</th>
                <th class="col-md-2">图片链接</th>
                <th class="col-md-1">产品价格</th>
                <th class="col-md-1">产品库存</th>
                <th class="col-md-1">产品规格</th>
                <th class="col-md-1">是否在售</th>
                <th class="col-md-1">产品描述</th>
                <th class="col-md-2">添加时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
            <tr>
                <td class="col-md-1"><?php echo $product['Product']['name'];?></td>
                <td class="col-md-1"><?php echo $product['Product']['is_front_page'];?></td>
                <td class="col-md-1"><?php echo $product['ProductType']['name'];?></td>
                <td class="col-md-2">
                    <?php foreach($product['pic_urls'] as $key => $picUrl):?>
                        <?php if(!empty($picUrl)):?>
                            <p><a style="cursor: pointer;" target="__blank" href="<?php echo 'http://'.ROOT_URL.'/'.$picUrl?>"><?php echo '图片'.++$key;?></a></p>
                        <?php endif;?>
                    <?php endforeach;?>
                </td>
                <td class="col-md-1"><?php echo $product['Product']['price'];?></td>
                <td class="col-md-1"><?php echo $product['Product']['stock'];?></td>
                <td class="col-md-1"><?php echo $product['Product']['sku_type'];?></td>
                <td class="col-md-1"><?php echo $product['Product']['is_onsale'];?></td>
                <td class="col-md-1"><?php echo $product['Product']['description'];?></td>
                <td class="col-md-2"><?php echo $product['Product']['created'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>