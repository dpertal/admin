<?php
$BASE_URL = Yii::app()->request->baseUrl;
$bodyClass = '';
$user = Yii::app()->user;
$roleActive = "";
$promoActive = "";
$userActive = "";
$programActive = "";
$categoryActive = "";
$offers = "";
$news = "";
$retailer = "";
$faq = "";
$cont = "";
if ($this->uniqueid == 'content') {
    $cont = "active";
} else if ($this->uniqueid == 'faq') {
    $faq = "active";
} else if ($this->uniqueid == 'retailer') {
    $retailer = "active";
} else if ($this->uniqueid == 'news') {
    $news = "active";
} else if ($this->uniqueid == 'role') {
    $userActive = "active";
} else if ($this->uniqueid == 'promo') {
    $promoActive = "active";
} else if ($this->uniqueid == 'user') {
    $userActive = "active";
} else if ($this->uniqueid == 'program') {
    $programActive = "active";
} else if ($this->uniqueid == 'category') {
    $categoryActive = "active";
} else if ($this->uniqueid == 'offerType' || $this->uniqueid == 'offer') {
    $offers = "active";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <title>Cash Rewards Global Admin Panel</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/assets/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/assets/font-awesome/css/font-awesome.min.css" />
            <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/css/flaty.css" />
            <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/css/flaty-responsive.css" />
    </head>


    <body>
        <!-- BEGIN Navbar -->
        <?if(isset(Yii::app()->user->user_name)) {?>
        <div id="navbar" class="navbar">
            <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="#">                <small>                    <i class="fa fa-desktop"></i>                    Cash Rewards Global Admin Panel                </small>            </a>
            <!-- BEGIN Navbar Buttons -->            <ul class="nav flaty-nav pull-right">                <!-- BEGIN Button User -->
                <li class="user-profile">
                    <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                        <img class="nav-user-photo" src="img/demo/avatar/avatar1.jpg" alt="Penny's Photo" />
                        <span class="hhh" id="user_info">
                            <?  {echo Yii::app()->user->user_name; }?>
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </a>

                    <!-- BEGIN User Dropdown -->
                    <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                        <li class="nav-header">
                            <i class="fa fa-clock-o"></i>
                            <?php if (!Yii::app()->user->isGuest && isset(Yii::app()->user->last_login)) { ?>Last login: <?php echo date('F j, Y \a\t h:i a', Yii::app()->user->last_login); ?><?php } ?>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                Account Settings
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                Edit Profile
                            </a>
                        </li>




                        <li class="divider"></li>

                        <li>
                            <a href="<?= $BASE_URL . "/index.php/site/logout" ?>">
                                <i class="fa fa-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <!-- BEGIN User Dropdown -->
                </li>
                <!-- END Button User -->
            </ul>
            <!-- END Navbar Buttons -->
        </div>
        <?}?>
        <!-- END Navbar -->

        <!-- BEGIN Container -->
        <div class="container" id="main-container">

            <!-- BEGIN Sidebar -->
            <?if(isset(Yii::app()->user->user_name)) {?>
            <div id="sidebar" class="navbar-collapse collapse">
                <!-- BEGIN Navlist -->
                <ul class="nav nav-list">

                    <li class="">
                        <a href="<?= $BASE_URL ?>/">
                            <i class="fa fa-dashboard"></i>
                            <span>Home</span>
                        </a>
                    </li>



                    <li class="<?= $userActive ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-desktop"></i>
                            <span>Permission</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <!-- BEGIN Submenu -->
                        <ul class="submenu">
                            <li><a href="<?= $BASE_URL ?>/index.php/role/">Manage Roles</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/role/roleAccess">Manage Permissions</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/user/">Manage Users</a></li>
                        </ul>
                        <!-- END Submenu -->
                    </li>
                    <li class="<?= $promoActive ?>">
                        <a href="<?= $BASE_URL ?>/index.php/promo/" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span>Promo Box</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                    </li>

                    <li class="<?= $programActive ?>">
                        <a href="<?= $BASE_URL ?>/index.php/program/" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span>Manage Program</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                    </li>

                    <li class="<?= $categoryActive ?>">
                        <a href="<?= $BASE_URL ?>/index.php/category/" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span>Manage Category</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                    </li>

                    <li class="<?= $offers ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-desktop"></i>
                            <span>Offers</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <!-- BEGIN Submenu -->
                        <ul class="submenu">
                            <li><a href="<?= $BASE_URL ?>/index.php/offerType/">Manage Type</a></li>
                            <li><a href="<?= $BASE_URL ?>/index.php/offer">Manage Offer</a></li>
                        </ul>
                        <!-- END Submenu -->
                    </li>

                    <li class="<?= $retailer ?>">
                        <a href="<?= $BASE_URL ?>/index.php/retailer/" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span>Manage Retailer</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                    </li>

                    <li class="<?= $news ?>">
                        <a href="<?= $BASE_URL ?>/index.php/news/" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span>Manage News</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                    </li>
                    <li class="<?= $faq ?>">
                        <a href="<?= $BASE_URL ?>/index.php/faq/" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span>Manage FAQ</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                    </li>

                    <li class="<?= $cont ?>">
                        <a href="<?= $BASE_URL ?>/index.php/content/" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span>Manage Content</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                    </li>
                </ul>
                <!-- END Navlist -->

                <!-- BEGIN Sidebar Collapse Button -->
                <div id="sidebar-collapse" class="visible-lg">
                    <i class="fa fa-angle-double-left"></i>
                </div>
                <!-- END Sidebar Collapse Button -->
            </div>
            <?}?>
            <!-- END Sidebar -->


            <!-- BEGIN Content -->
            <div id="main-content">

                <?php echo $content; ?>

                <footer>
                    <p><?php echo date('Y');?> &copy; Cash Rewards Global.</p>
                </footer>

                <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
            </div>
            <!-- END Content -->

        </div>
        <!-- END Container -->

        <!--basic scripts-->
        <?php if ($news == "") { ?>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="assets/jquery/jquery-2.0.3.min.js"><\/script>')</script>
            <? }?>
            <script src="<?php echo $BASE_URL; ?>/assets/bootstrap/js/bootstrap.min.js"></script>            <script src="<?php echo $BASE_URL; ?>/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>            <script src="<?php echo $BASE_URL; ?>/assets/jquery-cookie/jquery.cookie.js"></script>            <!--page specific plugin scripts-->        	<script type="text/javascript" src="<?php echo $BASE_URL; ?>/assets/data-tables/jquery.dataTables.js"></script>        	<script type="text/javascript" src="<?php echo $BASE_URL; ?>/assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>
            <!--page specific plugin scripts-->
            <script src="<?php echo $BASE_URL; ?>/assets/flot/jquery.flot.js"></script>
            <script src="<?php echo $BASE_URL; ?>/assets/flot/jquery.flot.resize.js"></script>
            <script src="<?php echo $BASE_URL; ?>/assets/flot/jquery.flot.pie.js"></script>
            <script src="<?php echo $BASE_URL; ?>/assets/flot/jquery.flot.stack.js"></script>
            <script src="<?php echo $BASE_URL; ?>/assets/flot/jquery.flot.crosshair.js"></script>
            <script src="<?php echo $BASE_URL; ?>/assets/flot/jquery.flot.tooltip.min.js"></script>
            <script src="<?php echo $BASE_URL; ?>/assets/sparkline/jquery.sparkline.min.js"></script>

            <!--flaty scripts-->
            <script src="<?php echo $BASE_URL; ?>/js/flaty.js"></script>
            <script src="<?php echo $BASE_URL; ?>/js/flaty-demo-codes.js"></script>

    </body>
</html>