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
        <title>Bonus Cash Home</title>
		<link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>/skin/bonuscash/css/main.css">

        <script src="<?= $BASE_URL ?>/skin/bonuscash/js/bootstrap.min.js"></script>
		<script src="<?= $BASE_URL ?>/skin/bonuscash/js/hover.zoom.conf.js"></script>
		<script src="<?= $BASE_URL ?>/skin/bonuscash/js/hover.zoom.js"></script>
    	<script src="<?= $BASE_URL ?>/skin/bonuscash/js/jquery-1.10.2.min.js"></script>

    </head>
    <body>
    <script type="text/javascript">
            jQuery(document).ready(function(){
                var myTimer;
                count = 0;
                var $img = $('#gallery'),
                image_length = $img.length;
                var image_id;
                var path;

                var myTimer2;
                count_2 = 0;
                var $img2 = $('#gallery_2 img'),
                image_2_lenght = $img2.length;
                var path2;
                var image_id2;

                var myTimer3;
                count_3 = 0;
                var $img3 = $('#gallery_3 img'),
                image_3_lenght = $img3.length;
                var path3;
                var image_id3;


                //$img.not(':eq('+c+')').hide();// hide all images but the one indexed 'c'
                $img.mouseover(function(){
                    myTimer = setInterval(function() {
                        count++;
                        if(count >= 8){
                            count = 1;
                        }
                        path = "assets/img/strip"+count+".png";
                        image_id = $("#gallery");
                        changeImage($img, count, image_length, path, image_id);
                    },200);
                });
                $img.mouseout(function(){
                    clearInterval(myTimer);
                });

                $img2.mouseover(function(){
                    myTimer2 = setInterval(function() {
                        count_2++;
                        if(count_2 >= 6){
                            count_2 = 1;
                        }
                        path2 = "assets/img/purple/strip"+count_2+".png";
                        image_id2 = $("#imagges_2");
                        changeImage($img2, count_2, image_2_lenght, path2, image_id2);
                    },200);
                });
                $img2.mouseout(function(){
                    clearInterval(myTimer2);
                });

                $img3.mouseover(function(){
                    myTimer3 = setInterval(function() {
                        count_3++;
                        if(count_3 >= 6){
                            count_3 = 1;
                        }
                        path3 = "assets/img/yellow/strip"+count_3+".png";
                        image_id3 = $("#imagges_3");
                        changeImage($img3, count_3, image_3_lenght, path3, image_id3);
                    },200);
                });
                $img3.mouseout(function(){
                    clearInterval(myTimer3);
                });

            });

            function changeImage(img, c, n, path, image_id){
                //                alert(c);
                image_id.attr("src",path);
                img.delay(100).show(400, 0).eq(++c%n).fadeTo(400, 1 );
            }



        </script>

    <!-- Static navbar -->
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html">
                        <img src="assets/img/Bonuscash_logo.png" >
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <!--<!--<ul class="nav navbar-nav navbar-right">
                        <li>
                            <div style="margin:0 auto; width:79px;" >
                                <img src="assets/img/for_customers.png" width="79" height="70">
                            </div>
                            <a href="#">For Customers</a></li>
                        <li>
                            <div style="margin:0 auto; width:79px;" >
                                <img src="assets/img/for_retailers.png" width="79" height="70">
                            </div>
                            <a href="#">For Retailers</a></li>
                        <li>
                            <div style="margin:0 auto; width:79px;" >
                                <img src="assets/img/member_card.png" width="79" height="70">
                            </div>
                            <a href="#">Member Card</a></li>
                        <li>
                            <div style="margin:0 auto; width:79px;" >
                                <img src="assets/img/launching.png" width="79" height="70">
                            </div>
                            <a href="#">Launching</a></li>
                        <li>
                            <div style="margin:0 auto; width:79px;" >
                                <img src="assets/img/summary.png" width="79" height="70">
                            </div>
                            <a href="#">Summary</a></li>
                    </ul>-->
                </div><!--/.nav-collapse -->
            </div>
        </div>




        <!-- +++++ Projects Section +++++ -->

        <div class="container pt">
            <div class="row mt centered">
                <div class="col-lg-6 outer_div">
                    <h1>Bonus Cash : At Last Real Rewards</h1>
                    <div  id="gallery" class="animate_img"><img id="imagges" src="assets/img/img_1.png"/></div>
                    <ul class="animat_txt">
                        <li>- real cash, not points</li>
                        <li>- up to 30% from our retailers</li>
                        <li>- at thousands of outlets online and instore</li>
                        <li>- hundreds of $ credited directly to your card each year</li>
                        <p class="retailers"> Check Out Our Retailers </p>
                    </ul>

                </div>
                <div class="col-lg-6 outer_div">
                    <h1>Bonus Cash : At Last Real Rewards</h1>
                    <div id="gallery_2" class="animate_img2"><img id="imagges_2" src="assets/img/img_2.png"/></div>
                    <ul class="animat_txt">
                        <li>- spend it when you want</li>
                        <li>- where you want</li>
                        <li>- how you want : even as cash</li>
                        <li>- or save it for that special thing</li>
                        <p class="retailers"> Try Before You Buy  </p>
                    </ul>

                </div>

            </div><!-- /row -->
            <div class="row mt centered">
                <div class="col-lg-6 outer_div">
                    <h1>The Bonus Cash Card </h1>
                    <div class="animate_img3" id="gallery_3">
                        <img id="imagges_3" src="assets/img/img_3.png"/>
                    </div>
                    <ul class="animat_txt">
                        <li>- an all in one shopping card</li>
                        <li>- a Visa card : can be used wherever Visa is accepte</li>
                        <li>- a PrePaid card : only uses $ you load … no credit</li>
                        <li>- 24 7 access via our websites and mobile apps</li>

                    </ul>

                </div>

                <div class="col-lg-6 outer_div">
                    <h1>And there’s more</h1>
                    <div class="animate_img4">
                        <img src="assets/img/img_4.png"/>
                    </div>
                    <ul class="animat_txt">
                        <li>- weekly special deals sent directly to you</li>
                        <li>- ikoupons</li>
                        <li>- cards for your teenagers</li>
                        <li>- friends and family links</li>

                    </ul>

                </div>
                <div class="col-lg-6 outer_div">
                    <h1>Simple to join and ready to go immediately</h1>
                    <div class="animate_img5">
                        <img src="assets/img/img_5.png"/></div>
                    <ul class="animat_txt">
                        <li>- apply online </li>
                        <li>- available to anyone over 13</li>
                        <li>- no credit checks, no bank account needed</li>
                        <li>- shop online and earn Bonus Cash before your card arrives</li>
                    </ul>
                </div>
            </div><!-- /row -->

        </div><!-- /container -->

        <!-- +++++ Welcome Section +++++ -->
        <div id="ww">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-6" style="float:right;">
                            <div class="bottam_banner"></div></div>
                        <div class="col-lg-6" >
                            <p class="Bottam_banner_hd">How Do I Get A Bonus Cash Card?<br/>
                                By joining with one of our partners</p>
                            <ul class="bottam_banner_txt">
                                <li>-GoShopNow : www.goshopnow.com.au</li>
                                <li>- Rider+ : www.riderplus.org</li>
                                <li>- LuckyBuys BonusCash : www.luckybuysbonuscash.com.au</li>
                                <li>- Give Back : www.givebackcard.com.au</li>
                                <li>- SportsCash : www.sportscash.com.au</li>
                            </ul></div>
                        <p>
                            <button type="button" class="btn btn-default btn-lg">Join Now</button>
                        </p>
                    </div>
                    <!-- /col-lg-8 -->
                </div><!-- /row -->
            </div> <!-- /container -->
        </div><!-- /ww -->
        <!-- +++++ Footer Section +++++ -->

        <div id="footer">
            <div class="container">


            </div>
        </div>


            </body>
</html>
