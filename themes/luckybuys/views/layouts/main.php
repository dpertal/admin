<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en">
        <meta name="author" content="">
        <meta http-equiv="Reply-to" content="@.com">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="revisit-after" content="15 days">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        <title>LuckBuys Home</title>
        <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/luckybuys/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/luckybuys/css/responsive.css">
		<link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/luckybuys/css/overlay.css">
			
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="<?= $BASE_URL ?>/skin/luckybuys/js/main.js"></script>
		<script src="<?= $BASE_URL ?>/skin/luckybuys/js/retailer_info.js"></script>
		<script src="<?= $BASE_URL ?>/skin/luckybuys/js/jquery.nicescroll.js"></script>
    </head>
    <body>
        <div class="collapse-menu collapsed">
            <ul>
                <li><a href="#">How It Work</a></li>
                <li><a href="#">Hot Deal</a></li>
                <li><a href="#">Latest News</a></li>
                <li><a href="#">Our Retailers</a></li>
                <li><a href="#">Online Shop</a></li>
                <li><a href="#">Store Locator</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
        </div>
        <div class="wrapper">

            <div class="header">
                <div class="header-detail">
                    <div class="collapse-menu-icon">
                        <a href="#"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ic_menu_white.png" alt="" border="0" /></a>
                    </div>
                    <div class="logo"><img src="<?= $BASE_URL ?>/skin/luckybuys/images/logo.png" alt="" /></div>
                    <div class="top-navigator hidden-phone">
                        <ul>
                            <li><a href="<?= $BASE_URL ?>/index.php/site/aboutus">How It<br/>Work</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/site/hotdeals">Hot<br/>Deal</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/site/news">Latest<br/>News</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/site/retailers">Our<br/>Retailers</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/site/shop">Online<br/>Shop</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/site/store">Store<br/>Locator</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/site/myaccount">My<br/>Account</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="bag">
                        <p><a href="#">My Bag (<span>0</span>)</a></p>
                    </div>
                </div>
                <div class="clear"></div>
            </div><!-- END HEADER -->

            <div class="search-bar">
                <div class="search-bar-detail">
                    <?php echo CHtml::link('Login', 'Login/index', array('class' => 'login')); ?>
                    <form name="search_frm" method="post" action="<?= $BASE_URL ?>/index.php/site/search">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'retailer',
                            'value' => '',
                            'source' => $BASE_URL.'/index.php/site/getRetailers', // <- path to controller which returns dynamic data
                            'options' => array(
                                'minLength' => '1', // min chars to start search
                                'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                            ),
                            'htmlOptions' => array(
                                'id' => 'retailer',
                                'rel' => 'val',
                                'placeholder' =>'Search'
                            ),
                        ));
                        ?>
                        <input type="image" src="<?= $BASE_URL ?>/skin/luckybuys/images/search-ico.png" />
                    </form>
                    <?php echo CHtml::link('Join Lucky Buys', array('Join/index'), array('class' => 'btn blue hidden-small-phone')); ?>
                </div>
            </div><!-- END SEARCH BAR -->

            <div class="content-wrapper">
                <?php echo $content; ?>
            </div>

            <div class="main-content">
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
            </div>
            <div class="clear"></div>

            <div class="footer">
                <div class="footer-detail">
                    <div class="footer-blocks">
                        <div class="blocks">
                            <ul>
                                <li><a href="<?= $BASE_URL ?>">Home</a></li>
                                <li><a href="<?= $BASE_URL ?>/index.php/site/news">Latest News</a></li>
                                <li><a href="<?= $BASE_URL ?>/index.php/site/hotdeals">Hot Deals</a></li>
                                <li><a href="<?= $BASE_URL ?>/index.php/site/retailers">Our Retailers</a></li>
                            </ul>
                        </div>
                        <div class="blocks">
                            <ul>
                                <li><a href="#">Online Offers</a></li>
                                <li><a href="<?= $BASE_URL ?>/index.php/site/store">Deal Locator</a></li>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Shopping Bag</a></li>
                            </ul>
                        </div>
                        <div class="blocks last">
                            <ul>
                                <li><a href="<?= $BASE_URL ?>/index.php/site/faq">FAQ's</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Term &amp; Conditions</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="footer-right">
                        <p>Powered by</p>
                        <p><img src="<?= $BASE_URL ?>/skin/luckybuys/images/footer-logo.png" alt="" /></p>
                        <p>&copy; Give Back Bonus Cash 2014</p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div><!-- END FOOTER -->

        </div><!-- END WRAPPER -->
    </body>
</html>
