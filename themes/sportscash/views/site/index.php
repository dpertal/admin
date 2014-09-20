<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<div class="banner hidden-phone">
    <div class="banner-detail">
        <img src="<?= $BASE_URL . $home->image_url; ?>" alt="" />
    </div>
</div><!-- END BANNER -->
<div class="main-content">
    <div class="intro">
        <h1><?php echo $home->headline; ?></h1> <BR />
        <?php echo $home->tag_line; ?>
    </div>
    <div class="bottom-blocks">
        <div class="blocks about-us" id="homeAbout">
            <h3>About us &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/sportscash/images/home_what.png" alt="" />
            </div>	
        </div>
        <div id="aboutHomeContent" class="blocks about-us home-box-second" style="display: none;">
            <h3>About us &gt;</h3>
            <div class="detail">
                <?php echo $about->tag_line; ?>

            </div>
        </div>

        <div class="blocks hot-deals" id="homeDeals">
            <h3>Hot Deals &gt; </h3>
            <div  class="detail">
                <img src="<?= $BASE_URL ?>/skin/sportscash/images/home_deals.png" alt="" />
            </div>

        </div>
        <div id="homeDealsSecond" class="blocks hot-deals home-box-second" style="display: none;">
            <h3>Hot Deals &gt;</h3>
            <div  class="detail">
                <?php foreach ($offers as $offer): ?>
                    <div class="home_row_detail" onclick="showRetailerOverlay('<?= $BASE_URL ?>/index.php/site/ajax/<?= $offer->id ?>')">
                        <div class="home-img-deal"></div>
                        <div class="home-detail-deal">
                            <p class="headline-deal"><?= $offer->title ?></p>
                            <p><?= $offer->summary ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>	
        </div>	
        <div class="blocks latest-news" id="homeNews">
            <h3>Latest News &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/sportscash/images/home_news.png" alt="" />
            </div>

        </div>	
        <div class="blocks latest-news home-box-second" id="homeNewsSecond" style="display: none;">
            <h3>Latest News &gt;</h3>
            <div class="detail">
                <?php foreach ($news as $new) : ?>
                    <div class="home_row_detail">
                        <p class="headline-deal"><?php echo $new->title; ?></p>
                        <p><?php echo substr($new->description, 0, 75); ?></p>
                    </div>	
                <?php endforeach; ?>
            </div>			
        </div>

        <div class="blocks online-store" id="homeOnline">
            <h3>Online Store &gt;</h3>
            <div class="detail">
                <img src="<?= $BASE_URL ?>/skin/sportscash/images/home_online.png" alt="" />
            </div>
        </div>
        <div id="homeOnlineSecond" class="blocks online-store home-box-second" style="display: none;">
            <h3>Online Store &gt;</h3>
            <div class="detail">
                <?php if (isset($welcome)) {
                    echo $welcome->tag_line;
                } ?>
            </div>	
        </div>	
        <div class="clear"></div>
    </div>

        <?php if ($products != NULL): ?>
        <div class="clear"></div>
        <div style="width: 940px;height: auto;">
            <?php
            $count = 0;
//        var_dump($productCount);exit;
            foreach ($products['data']->item as $product):
                if ($count >= intval($productCount))
                    break;
                ?>
                <div style="width: 200px;padding: 5px; height: 100px;margin: 10px;float:left;text-align: center;">
                    <img src="<?php echo $product->imageurl[0]; ?>" width="100px" height="70px" style="margin-left: 15px;" />
                    <div>
                        <a href="<?php echo $product->linkurl; ?>" target="_blank"><?php echo $product->productname; ?></a>
                    </div>
                    <div>
        <?php echo $product->price; ?>
                    </div>
                </div>
        <?php $count++;
    endforeach; ?>
        </div>
        <div class="clear"></div>
<?php endif; ?>
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