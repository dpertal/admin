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
        <div class="blocks about-us" id="homeAbout">
            <h3>About us &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/video.jpg" alt="" />
            </div>	
        </div>
		<div id="aboutHomeContent" class="blocks about-us" style="display: none;">
			<?php echo $about->tag_line ;?>
		</div>
		
        <div class="blocks hot-deals" id="homeDeals">
            <h3>Hot Deals &gt;</h3>
            <div  class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/hot-deal.jpg" alt="" />
            </div>
			
        </div>
		<div id="homeDealsSecond" class="blocks hot-deals home-box-second">
			<h3>Hot Deals &gt;</h3>
			<div  class="detail">
				<?php foreach ($offers as $offer):?>
				<div class="home_row_detail">
					<div class="home-img-deal"></div>
					<div class="home-detail-deal">
						<h4><?=$offer->title ?></h4>
						<p><?=$offer->summary ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>	
		</div>	
        <div class="blocks latest-news">
            <h3>Latest News &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/latest-news.jpg" alt="" />
            </div>
			
        </div>	
		<!--<div class="blocks latest-news">
			<h3>Latest News &gt;</h3>
            <div class="detail">
				<?php foreach($news as $new) :?>
					<div class="home_row_detail">
						<p class="news_title"><?php echo $new->title ;?></p>
						<p><?php echo $new->description ; ?></p>
					</div>	
				<?php endforeach; ?>
			</div>			
		</div>
		-->
        <div class="blocks online-store">
            <h3>Online Store &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/store.jpg" alt="" />
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<script>
	
    $("#homeAbout").click(function() {
        $("#homeAbout").toggle();
        $("#homeAbout").hide();
        $("#aboutHomeContent").show();
    });
	
	 $("#homeDeals").mouseenter(function() {
        $("#homeDeals").toggle();
        $("#homeDeals").hide();
        $("#homeDealsSecond").show();
    });
    $("#homeDealsSecond").mouseleave(function() {
        $("#homeDeals").toggle();
        $("#homeDeals").show();
        $("#homeDealsSecond").hide();
    });
</script>	