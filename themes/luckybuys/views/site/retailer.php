<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>/assets/jquery/jquery.colorbox.js"></script>
<div class="banner hidden-phone">
    <div class="banner-detail">
        <img src="<?= $BASE_URL . $content->image_url; ?>" alt="" />
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
            
			<?php if($layout){ ?>
				<div class="left-categories">
				<?php foreach ($categories as $category) { ?>
					<div class="cattitle"><a href="<?= $BASE_URL . "/index.php/site/retailers?cat=1" ?>"><?= $category->name ?></a><span class="check"></span></div>
                <? }?>
				</div>
				<div class="right-categories">
					<div class="clear"></div>
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
						<?php foreach ($model as $retailer) {
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
													<a>SHOP NOW</a>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$(".popup<?= $retailer->id ?>").colorbox({inline: true});
							</script>
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
				
			<?php }else { ?>
			<?php foreach ($categories as $category) { ?>
                <div class="category"><a href="<?= $BASE_URL . "/index.php/site/retailers?cat=1" ?>"><?= $category->name ?></a></div>
                <? }?>


                <div class="clear"></div>
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
                    <?php foreach ($model as $retailer) {
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
                                                <a>SHOP NOW</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(".popup<?= $retailer->id ?>").colorbox({inline: true});
                </script>
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
        <?php } ?>
		</div>
		<div class="clear"></div>
    </div>
</div>