<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<div class="main-content">
    <div class="news">
        <?php foreach ($model as $news) {
            ?>
            <div class="news-rows">
                <h3 class="title"><?= $news['title'] ?></h3>
                <div class="detail">
                    <?= $news['description'] ?>
                </div>
            </div>
        <?php } ?>


    </div>
    <?php if($products != NULL):?>
    <div class="clear"></div>
    <div style="width: 940px;height: auto;">
        <?php 
        $count = 0;
//        var_dump($productCount);exit;
        foreach ($products['data']->item as $product):             
            if($count >= intval($productCount))
                break;
            
        ?>
        <div style="width: 200px;padding: 5px; height: 100px;margin: 10px;float:left;text-align: center;">
            <img src="<?php echo $product->imageurl[0]; ?>" width="100px" height="70px" style="margin-left: 15px;" />
            <div>
                <a href="<?php echo $product->linkurl; ?>" target="_blank"><?php echo $product->productname; ?></a>
            </div>
            <div>
                <?php echo $product->price; ?>
            </div>
        </div>
            <?php $count++; endforeach; ?>
    </div>
    <div class="clear"></div>
    <?php endif; ?>
</div>