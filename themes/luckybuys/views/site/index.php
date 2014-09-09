<?php
    $BASE_URL = Yii::app ()->request->baseUrl;
?>
<div class="banner hidden-phone">
    <div class="banner-detail">
        <img src="<?= $BASE_URL . $home->image_url; ?>" alt="" />
    </div>
</div><!-- END BANNER -->
<div class="main-content">
    <div class="intro">
        <h2><?php echo $home->headline; ?></h2>
        <?php echo $home->tag_line; ?>
    </div>
    <div class="bottom-blocks">
        <div class="blocks about-us">
            <h3>About us &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/video.jpg" alt="" />
            </div>
        </div>
        <div class="blocks hot-deals">
            <h3>Hot Deals &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/hot-deal.jpg" alt="" />
            </div>
        </div>
        <div class="blocks latest-news">
            <h3>Latest News &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/latest-news.jpg" alt="" />
            </div>
        </div>
        <div class="blocks online-store">
            <h3>Online Store &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/store.jpg" alt="" />
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="bottom-ads">
        <ul>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-1.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-2.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-3.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-4.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-5.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-6.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-7.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-8.jpg" alt="" /></li>
            <li><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ads-9.jpg" alt="" /></li>
        </ul>
    </div>
    <div class="clear"></div>
</div>