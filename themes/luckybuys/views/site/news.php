<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
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
