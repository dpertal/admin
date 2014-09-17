<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>/assets/jquery/jquery.colorbox.js"></script>
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
                            <li class="active"><a href="<?php echo $BASE_URL . "/index.php/site/category/" . $cat->id ?>"><i class="fa fa-bars"></i><?= $cat->name ?></a></li>
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

        <img src="<?= $BASE_URL . $current_cat->image; ?>" alt="" />
    </div>
</div><!-- END BANNER -->
<div class="main-content" style="margin-top: 0px;">
    <div class="retailers">
        <div class="retailer-top">

            <br/>
        </div>
        <div class="retailer-categories">
            <div class="category-paginator"  style="text-align: left;">
                <h4><?= $current_cat->name ?></h4>
            </div>

            <div class="category-paginator">

                <span><a href="#"> << </a></span>
                <span><a href="#"> < </a></span>
                <span><a href="#"> 1 </a></span>
                <span><a href="#"> 2 </a></span>
                <span><a href="#"> 3 </a></span>
                <span><a href="#"> > </a></span>
                <span><a href="#"> >> </a></span>
            </div>
            <div class="retailer-boxes">
                <?php foreach ($model as $retailer) :
                    ?>
                    <div class="retailer-box popup<?= $retailer->id ?>" href="#popup<?= $retailer->id ?>"  style="cursor:pointer;">
                        <p class="image"><img src="<?= $retailer->logo_url ?>" alt="" /></p>
                        <div class="cash-precent">
                            <div class="left">
                                <p><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ic_online_blue.png" /></p>
                                <?php
                                if (isset($retailer->offerType)) {
                                    echo $retailer->offerType->name;
                                } else {
                                    echo "&nbsp;";
                                }
                                ?>
                            </div>
                            <div class="right">
                                <p class="percent"><?= $retailer->bonus_cash ?></p>
                                <p class="program">Bonus Cash</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <span>Car Parts</span>
                        </div>
                    </div>

                    <div style="display:none;">
                        <?php $this->renderPartial('_shopnow_popup', array('retailer' => $retailer,)); ?>
                    </div>
                    <script type="text/javascript">
                        $(".popup<?= $retailer->id ?>").colorbox({inline: true});
                    </script>
                <?php endforeach; ?>

                <div class="clear"></div>
                <div class="retailers-paginator">
                    <span><a href="#"> << </a></span>
                    <span><a href="#"> < </a></span>
                    <span><a href="#"> 1 </a></span>
                    <span><a href="#"> 2 </a></span>
                    <span><a href="#"> 3 </a></span>
                    <span><a href="#"> > </a></span>
                    <span><a href="#"> >> </a></span>
                </div>
            </div>
        </div>
    </div>
</div>