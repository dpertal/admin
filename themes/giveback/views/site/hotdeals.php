<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>/assets/jquery/jquery.colorbox.js"></script>
<div class="banner hidden-phone">
    <div class="banner-detail">
		<div id="bannerText" class="static">
			<div class="banner-title"><?php echo $content->headline; ?></div>
			<div class="banner-tagline"><?php echo $content->tag_line; ?></div>	
		</div>

        <img src="<?= $BASE_URL . $content->image_url; ?>" alt="" />
    </div>
</div><!-- END BANNER -->
<div class="main-content">
    <div class="hot-deals-home">
        <div class="hot-deals-top">
            <h2><?php echo $content->headline; ?></h2>
            <p>Search our retailers for the latest deals</p>
            <br/>
            <p>We have a range of Hot Deals on offer. These are deals exclusively to members. They are available for a strictly limited time only. And all include Bonus Cash over and above the special pricing indicated. Hot Deals are available both at our instore partners and from our online retailers. Click on the retailer logos for more information and details of how to access the deals.</p>
            <br/>
            <p>Filter search by selecting one or more of the following categories</p>
        </div>
        <div class="hot-deals-categories">
            <div class="category instore"><a href="<?= $BASE_URL . "/index.php/site/hotdeals?cat=1" ?>">In Store</a></div>
            <div class="category online"><a href="<?= $BASE_URL . "/index.php/site/hotdeals?cat=2" ?>">Online</a></div>
            <div class="category ikoupons"><a href="<?= $BASE_URL . "/index.php/site/hotdeals?cat=3" ?>">ikoupons</a></div>
            <div class="category cash-vouchers"><a href="<?= $BASE_URL . "/index.php/site/hotdeals?cat=4" ?>">Bonus Cash Vouchers</a></div>
            <div class="clear"></div>
          <!--  <div class="category-paginator">
                <span><a href="#"> << </a></span>
                <span><a href="#"> < </a></span>
                <span><a href="#"> 1 </a></span>
                <span><a href="#"> 2 </a></span>
                <span><a href="#"> 3 </a></span>
                <span><a href="#"> > </a></span>
                <span><a href="#"> >> </a></span>
            </div>-->
        </div>
		
		<div class="result">Result</div>
		<div class="hot-deals-list">
       <?php
            foreach ($model as $deal) {
                ?>
                <a href="#popup<?= $deal->id ?>" class="popup<?= $deal->id ?>">
                    <div class="deal-box popup" style="cursor: pointer;">
                        <div class="left">
                            <h4 class="title"><?= $deal->title ?><?= $deal->offer_type_id ?></h4>
                            <div class="description">
                                <p><?= $deal->summary ?></p>
                                <p>Valid Until <?php echo date_format(new DateTime($deal->end_date), 'd F Y'); ?></p>
                            </div>
                        </div>
                        <div class="right">
                            <img src="<?= $deal->retailer->logo_url ?>" alt="" />
                        </div>
                    </div>
					<div class="sepline"></div>
                </a>
                <div style="display:none;">
                    <div class="popup_wrap" id="popup<?= $deal->id ?>">
                        <div class="deal_popup" style="cursor: pointer;">
                            <div class="right">
                                <h3 class="title"><?= $deal->title ?><?= $deal->offer_type_id ?></h3>
                                <div class="description">
                                    <p><?= $deal->retailer->description ?></p>
                                    <br />
                                    
                                    
                                    <h4 class="title">Hot Deal</h4>
                                    <p><?= $deal->body ?></p>
                                    <br />
                                    <?
                                    if(isset($deal->retailer->affiliateCoupons) && count($deal->retailer->affiliateCoupons)>0) {
                                    echo '<h4 class="title">Coupons</h4>';
                                    foreach($deal->retailer->affiliateCoupons as $coupon) {
                                    ?>
                                    
                                    <p><?= $coupon->description ?></p>
                                    <br />
                                    <? } }?>
                                </div>
                            </div>
                            <div class="left">
                                <img src="<?= $deal->retailer->logo_url ?>" alt="" />
                                <h4><?= $deal->summary ?></h4><br />
                                <div style="border:1px black solid;vertical-align: middle;float: left; width: 95%;">
                                    <div style="float: left;padding: 5px;">
                                        <img style="width:50px !important;" src="<?= $BASE_URL ?>/skin/luckybuys/images/ic_online_blue.png" alt="" />
                                    </div>
                                    <div style="float: right;padding: 5px;padding-top: 15px; text-align: center;">
                                        Shop Online
                                    </div>
                                    <div style="float:left;width:100%;background-color:#003876;padding-top: 5px;padding-bottom: 5px;color: white;">
                                        <a>SHOP NOW</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(".popup<?= $deal->id ?>").colorbox({inline: true});
            </script>
				
            <? }?>

            <div class="clear"></div>

            <!--div class="hot-deals-paginator">
                <span><a href="#"> << </a></span>
                <span><a href="#"> < </a></span>
                <span><a href="#"> 1 </a></span>
                <span><a href="#"> 2 </a></span>
                <span><a href="#"> 3 </a></span>
                <span><a href="#"> > </a></span>
                <span><a href="#"> >> </a></span>
            </div -->
        </div>
    </div>
</div>

