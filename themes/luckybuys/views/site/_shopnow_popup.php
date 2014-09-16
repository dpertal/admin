<?php
$BASE_URL = Yii::app()->request->baseUrl;
$network = Affiliatenetwork::model()->findByPk($retailer->affiliate_network_id);
$url = $retailer->url.$network->tracking.'=';

?>

<div class="popup_wrap" id="popup<?= $retailer->id ?>">
    <div class="deal_popup" style="cursor: pointer;">
        <div class="right">
            <h3 class="title"><?= $retailer->name ?></h3>
            <div class="description">
                <p><?= $retailer->description ?></p>
                <br />
                <?
                if(isset($retailer->affiliateCoupons) && count($retailer->affiliateCoupons)>0) {
                echo '<h4 class="title">Coupons</h4>';
                foreach($retailer->affiliateCoupons as $coupon) {
                ?>

                <p><?= $coupon->description ?></p>
                <br />
                <? } }?>
            </div>
        </div>
        <div class="left">
            <img src="<?= $retailer->logo_url ?>" alt="" />
            <h4><?= $retailer->bonus_cash ?> Bonus Cash</h4><br />
            <div style="border:1px black solid;vertical-align: middle;float: left; width: 95%;">
                <div style="float: left;padding: 5px;">
                    <img style="width:50px !important;" src="<?= $BASE_URL ?>/skin/luckybuys/images/ic_online_blue.png" alt="" />
                </div>
                <div style="float: right;padding: 5px;padding-top: 15px; text-align: center;">
                    Shop Online
                </div>
                <div style="float:left;width:100%;background-color:#003876;padding-top: 5px;padding-bottom: 5px;color: white;">
                    <form method="post" action=<?=$BASE_URL . "/index.php/Login/index"?>>
                        <input type="hidden" name="url" value="<?=$url?>"/>
                        <input type="submit" value="SHOP NOW" />
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
