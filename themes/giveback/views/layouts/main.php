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
        <title>Give Back Home</title>
        <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/css/colorbox.css">
        <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/giveback/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/giveback/css/responsive.css">
		<link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/giveback/css/overlay.css">
		<link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/giveback/css/fonts.css">	
			
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="<?= $BASE_URL ?>/skin/giveback/js/main.js"></script>
		<script src="<?= $BASE_URL ?>/skin/giveback/js/retailer_info.js"></script>
		<script src="<?= $BASE_URL ?>/skin/giveback/js/jquery.nicescroll.js"></script>
    </head>
    <body>
        <div class="collapse-menu collapsed">
            <ul>
                <li><?php echo CHtml::link("About us", array("site/aboutus")); ?></li>
                <li><?php echo CHtml::link("Hot<br/>Deal", array("site/hotdeals")); ?></li>
                <li><?php echo CHtml::link("Latest<br/>News", array("site/news")); ?></li>
                <li><?php echo CHtml::link("Our<br/>Retailers", array("site/retailers")); ?></li>
                <li><?php echo CHtml::link("Online<br/>Shop", array("site/shop")); ?></li>
                <li><?php echo CHtml::link("Store<br/>Locator", array("site/store")); ?></li>
                <li><?php echo CHtml::link("My<br/>Account", array("site/myaccount")); ?></li>
                <?php if (!Yii::app()->user->isGuest) : ?>
                    <li><?php echo CHtml::link("My<br/>Profile", array("Account/Profile")); ?></li>
                <?php endif ?>
            </ul>
        </div>
        <div class="wrapper">

            <div class="header">
                <div class="header-detail">
                    <div class="collapse-menu-icon">
                        <a href="#"><img src="<?= $BASE_URL ?>/skin/giveback/images/ic_menu_white.png" alt="" border="0" /></a>
                    </div>
                    <div class="logo"><a href="/"><img src="<?= $BASE_URL ?>/skin/giveback/images/logo.png" alt="" /></a></div>
                    <div class="top-navigator hidden-phone">
                        <ul>
                            <li><?php echo CHtml::link("About us", array("site/aboutus")); ?></li>
                            <li><?php echo CHtml::link("Hot<br/>Deal", array("site/hotdeals")); ?></li>
                            <li><?php echo CHtml::link("Latest<br/>News", array("site/news")); ?></li>
                            <li><?php echo CHtml::link("Our<br/>Retailers", array("site/retailers")); ?></li>
                            <li><?php echo CHtml::link("Online<br/>Shop", array("site/shop")); ?></li>
                            <li><?php echo CHtml::link("Store<br/>Locator", array("site/store")); ?></li>
                            <li><?php echo CHtml::link("My<br/>Account", array("site/myaccount")); ?></li>
                            <?php if (!Yii::app()->user->isGuest) : ?>
                            <li><?php echo CHtml::link("My<br/>Profile", array("account/profile")); ?></li>
                            <?php endif ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <!--<div class="bag">
                        <p><a href="#">My Bag (<span>0</span>)</a></p>
                    </div>-->
                </div>
                <div class="clear"></div>
            </div><!-- END HEADER -->
		<?php /*
           <!-- <div class="search-bar">
                <div class="search-bar-detail">
                    <?php echo CHtml::link('Login', array('Login/index'), array('class' => 'login')); ?>
                    <form name="search_frm" method="post" action="<?= $BASE_URL ?>/index.php/site/search">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'retailer',
                            'value' => '',
                            'source' => $BASE_URL . '/index.php/site/getRetailers', // <- path to controller which returns dynamic data
                            'options' => array(
                                'minLength' => '1', // min chars to start search
                                'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                            ),
                            'htmlOptions' => array(
                                'id' => 'retailer',
                                'rel' => 'val',
                                'placeholder' => 'Search Retailer'
                            ),
                        ));
                        ?>
                        <input type="image" src="<?= $BASE_URL ?>/skin/giveback/images/search-ico.png" />
                    </form>
                    <form name="search_frm" method="post" action="<?= $BASE_URL ?>/index.php/site/searchCategory">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'category',
                            'value' => '',
                            'source' => $BASE_URL . '/index.php/site/getCategory', // <- path to controller which returns dynamic data
                            'options' => array(
                                'minLength' => '1', // min chars to start search
                                'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                            ),
                            'htmlOptions' => array(
                                'id' => 'category',
                                'rel' => 'val',
                                'placeholder' => 'Search Category'
                            ),
                        ));
                        ?>
                        <input type="image" src="<?= $BASE_URL ?>/skin/giveback/images/search-ico.png" />
                    </form>
                    <?php
                        if (Yii::app()->user->isGuest)
                            echo CHtml::link('Join Lucky Buys', array('Join/index'), array('class' => 'btn blue hidden-small-phone'));
                        else echo CHtml::link('Log out', array('Login/Logout'), array('class' => 'btn blue hidden-small-phone'));
                    ?>
                </div>
            </div><!-- END SEARCH BAR -->
			*/ ?>
            <div class="content-wrapper main-content">

				<!--show content introduce -->
                <?php  echo $content; ?>
            </div>
			<div class="bg_retailer">
				<div class="main-content">
					<div class="bottom-ads">
						<ul>
							<?php foreach (Retailers::getListRetailers() as $retailer) : ?>
							<li onclick="showRetailerOverlay('<?= $BASE_URL ?>/index.php/site/GetIDRetailers/<?=$retailer->id ?>');">
								<?php if($retailer->logo_url != '') { ?> <img src="<?=$retailer->logo_url ?>" /> <?php } else { ?><img src="<?= $BASE_URL ?>/skin/luckybuys/images/ic_online_blue.png" alt="" /> <?php } ?>
								<p class="bonus_cash"><?php echo 'Bonus cash'. $retailer->bonus_cash; ?> </p>
							</li>
							<?php endforeach ; ?>
						
						</ul>
					</div>
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
                                <li><?php echo CHtml::link('Contact Us', array('site/contact')); ?></li>
                                <li><a href="#">Term &amp; Conditions</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="footer-right">
                        <p>Powered by</p>
                        <p><img src="<?= $BASE_URL ?>/skin/giveback/images/footer-logo.png" alt="" /></p>
                        <p>&copy; Give Back Bonus Cash 2014</p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div><!-- END FOOTER -->

        </div><!-- END WRAPPER -->
    </body>
</html>
