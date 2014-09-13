<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<div class="banner hidden-phone">
    <div class="banner-detail">

    </div>
</div><!-- END BANNER -->
<div class="main-content">
    <div class="retailers">
        <div class="retailer-top">
            <p>Filter search by selecting one or more of the following categories</p>
        </div>
        <div class="retailer-categories">
            <?php foreach ($model as $cat) {
                ?>
            <div class="category"><a href="#"><?=$cat->name?></a></div>
            <? }?>
            <div class="clear"></div>

        </div>
    </div>
</div>
