<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<link rel="stylesheet" href="<?php echo $BASE_URL; ?>/assets/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo $BASE_URL; ?>/css/flaty.css" />
<link rel="stylesheet" href="<?php echo $BASE_URL; ?>/css/flaty-responsive.css" />
<link rel="stylesheet" href="<?php echo $BASE_URL; ?>/assets/font-awesome/css/font-awesome.min.css" />
<!--flaty scripts-->
<script src="<?php echo $BASE_URL; ?>/js/flaty.js"></script>
<script src="<?php echo $BASE_URL; ?>/js/flaty-demo-codes.js"></script>
<script src="<?php echo $BASE_URL; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $BASE_URL; ?>/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $BASE_URL; ?>/assets/jquery-cookie/jquery.cookie.js"></script>
<style>
    .navbar {
        background: none !important;
    }
</style>
<div  style="background: #003876">
    <div class="main-content" style="margin-top: 0px;">
        <div id="navbar" class="navbar">
            <ul class="nav flaty-nav navbar-collapse collapse" id="nav-horizontal">
                <?php foreach ($categories as $category) { ?>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-bars"></i>
                            <span><?= $category->name ?></span>
                            <b class="arrow fa fa-caret-down"></b>
                        </a>
                        <? 
                        $child = RetailerCategory::model()->findAll("parent_id = '".$category->id."'");
                        if(count($child) >0 ) {
                        ?>
                        <ul class="dropdown-menu dropdown-navbar">
                            <?foreach($child as $cat) {?>
                            <li class="active"><a href="ui_horizontal-menu.html"><i class="fa fa-bars"></i><?= $cat->name ?></a></li>
                            <?}?>
                        </ul>
                        <? }?>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>
<div class="banner hidden-phone">
    <div class="banner-detail">
        <img src="<?= $BASE_URL . $content->image_url; ?>" alt="" />
    </div>
</div><!-- END BANNER -->

<div class="main-content">




    <div class="online-shop">
        <div class="section-1">
            <ul>
                <li><a href="#"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/img1.png" /></a></li>
                <li><a href="#"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/img1.png" /></a></li>
                <li><a href="#"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/img1.png" /></a></li>
                <li><a href="#"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/img1.png" /></a></li>
                <li><a href="#"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/img1.png" /></a></li>
                <li><a href="#"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/img1.png" /></a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="separator">
            <span>Shop Lucky Buys Online Now!</span>
        </div>
        <div class="section-2">
            <div class="box onsport">
                <h3><a href="#">Onsport</a></h3>
                <p class="detail">
                    UP TO 70% OFF RUNNING BARE APPAREL + 8% BONUS CASH
                </p>
            </div>
            <div class="box balley-nelson">
                <h3><a href="#">BAILEY NELSON</a></h3>
                <p class="description">optical and fashion glasses</p>
                <p class="detail">
                    UP TO 24% BONUS CASH
                </p>
            </div>
            <div class="box iconic">
                <h3><a href="#">THE ICONIC</a></h3>
                <p class="detail">
                    3HR SHIPPING + UP TO 12.8% BONUS CASH
                </p>
            </div>
            <div class="box zanui">
                <h3><a href="#">ZANUI</a></h3>
                <p class="detail">
                    20% OFF ALL ENTERTAINMENT UNITS + UP TO 8% BONUS CASH
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
