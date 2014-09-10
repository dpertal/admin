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
            <p>Search our retailers for the latest deals</p>
            <br/>
            <p>Here you will find the details all of our retailers offering Bonus Cash. Whether you want to shop instore, online or buy a voucher to shop later, or even take advantage of our special offers through ikoupons, they are all listed here for you to explore. It's simple to shop, Either scroll through the retailer logos below or filter your search by selecting one of the categories. Then click on the logo for more information and details of how to access the Bonus Cash offers</p>
            <br/>
            <p>Filter search by selecting one or more of the following categories</p>
        </div>
        <div class="retailer-categories">
            
            
            
            <div class="clear"></div>
            
            <div class="retailer-boxes">
                <?php foreach ($model as $retailer) {
                    ?>
                <div class="retailer-box" onclick="" style="cursor:pointer;">
                        <p class="image"><img src="<?= $retailer->logo_url ?>" alt="" /></p>
                        <div class="cash-precent">
                            <div class="left">
                                <p><img src="<?=$BASE_URL?>/skin/luckybuys/images/ic_online_blue.png" /></p>
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
                    <? }?>
                    
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