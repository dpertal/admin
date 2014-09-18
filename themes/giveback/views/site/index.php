<?php
    $BASE_URL = Yii::app ()->request->baseUrl;
?>
<div class="banner bannerhome hidden-phone">
    <div class="banner-detail">
       <!-- <img src="<?= $BASE_URL . $home->image_url; ?>" alt="" />-->
		<div id="bannerText">
			<div class="banner-title">Introducing Give Back</div>
			<div class="banner-tagline">The Donations Revolution</div>
			<a href="Join">Sign up & start donating today</a>
		</div>
    </div>
</div><!-- END BANNER -->
<div class="main-content">
	
	<div class="intro">
        <h2><?php echo $home->headline; ?></h2>
        <?php echo $home->tag_line; ?>
    </div>
	
	<!--<div class="bottom-blocks">
		<div class="blocks">
			<img src="<?= $BASE_URL ?>/skin/giveback/images/latest-news.jpg" />
			<div class="text">
				<h3>Lastest news</h3>
				<a href="#">read more ></a>
			</div>
		</div>	
		<div class="blocks">
			<img src="<?= $BASE_URL ?>/skin/giveback/images/hot-deal.jpg" />
			<div class="text">
				<h3>Hot deals</h3>
				<a href="#">read more ></a>
			</div>	
		</div>	
		<div class="blocks">
			<img src="<?= $BASE_URL ?>/skin/giveback/images/about.jpg" />
			<div class="text">
				<h3>What is give back</h3>
				<a href="#">read more ></a>
			</div>
		</div>
		<div class="clear"></div>	
	</div>-->	
	
    <div class="bottom-blocks">
        <div class="blocks about-us" id="homeAbout">
            <h3>About us &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/video.jpg" alt="" />
            </div>	
        </div>
		<div id="aboutHomeContent" class="blocks about-us home-box-second" style="display: none;">
			<h3>About us &gt;</h3>
			<div class="detail">
			<?php echo $about->tag_line ;?>
			
			</div>
		</div>
		
        <div class="blocks hot-deals" id="homeDeals">
            <h3>Hot Deals &gt; </h3>
            <div  class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/hot-deal.jpg" alt="" />
            </div>
			
        </div>
		<div id="homeDealsSecond" class="blocks hot-deals home-box-second" style="display: none;">
			<h3>Hot Deals &gt;</h3>
			<div  class="detail">
				<?php foreach ($offers as $offer):?>
				<div class="home_row_detail" onclick="showRetailerOverlay('<?= $BASE_URL ?>/index.php/site/ajax/<?=$offer->id ?>')">
					<div class="home-img-deal"></div>
					<div class="home-detail-deal">
						<p class="headline-deal"><?=$offer->title ?></p>
						<p><?=$offer->summary ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>	
		</div>	
        <div class="blocks latest-news" id="homeNews">
            <h3>Latest News &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/latest-news.jpg" alt="" />
            </div>
			
        </div>	
		<div class="blocks latest-news home-box-second" id="homeNewsSecond" style="display: none;">
			<h3>Latest News &gt;</h3>
            <div class="detail">
				<?php foreach($news as $new) :?>
					<div class="home_row_detail">
						<p class="headline-deal"><?php echo $new->title ;?></p>
						<p><?php echo substr($new->description ,0 , 75); ?></p>
					</div>	
				<?php endforeach; ?>
			</div>			
		</div>

        <div class="blocks online-store" id="homeOnline">
            <h3>Online Store &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/luckybuys/images/store.jpg" alt="" />
            </div>
        </div>
		<div id="homeOnlineSecond" class="blocks online-store home-box-second" style="display: none;">
			<h3>Online Store &gt;</h3>
            <div class="detail">
				<?php echo $welcome->tag_line ; ?>
			</div>	
		</div>	
        <div class="clear"></div>
    </div>

    <div class="clear"></div>
</div>

    <div class='overlay_bg hidden'> </div>
                <!-- Retailer Overlay -->
        <div class='overlay_fg hidden' align='center' id='overlayRetailer' >
            <div id='overlayRetailerClose' class="overlay-close" onclick="hideOverlay();">X</div>
            <!-- <iframe id="iframe_retailer" class='retailer' ></iframe> -->
            <div id='contentContainer' ></div>
        </div>
<script type="text/javascript">

    $(document).ready(function() {
        $("#aboutHomeContent").niceScroll({autohidemode: true});
        $("#homeDealsSecond").niceScroll({autohidemode: true});
        $("#homeNewsSecond").niceScroll({autohidemode: true});
        $("#homeOnlineSecond").niceScroll({autohidemode: true});
    });
	
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
	
	$("#homeNews").mouseenter(function() {
        $("#homeNews").toggle();
        $("#homeNews").hide();
        $("#homeNewsSecond").show();
    });
    $("#homeNewsSecond").mouseleave(function() {
        $("#homeNews").toggle();
        $("#homeNews").show();
        $("#homeNewsSecond").hide();
    });
	
	$("#homeOnline").mouseenter(function() {
        $("#homeOnline").toggle();
        $("#homeOnline").hide();
        $("#homeOnlineSecond").show();
    });
    $("#homeOnlineSecond").mouseleave(function() {
        $("#homeOnline").toggle();
        $("#homeOnline").show();
        $("#homeOnlineSecond").hide();
    });
	
</script>	