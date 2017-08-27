<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
$url = $_SERVER['REQUEST_URI'];$a=explode("/", $url);$link=end($a);
$session = new SessionManager();
$users = new Users();
require_once('admin/inc/functions.inc.php');
require_once('admin/inc/config.inc.php');
$t = new TranslateVar(); $hub = new Hub(); $h = $hub->get_one();
$menu = new Menu();$languages = new Languages();$translatepath = new TranslatePath();
$_SESSION['language'] = isset($_GET['lang']) ? $_GET['lang'] : '';
if(isset($_SESSION['language']) && $_SESSION['language']){
  $lang = $_SESSION['language'];
} else {
  $lang = $languages->get_default();
  $_SESSION['language'] = $lang;
}
$background = '';$logo = '';
if($h['banner']){
  foreach($h['banner'] as $banner){
    if($banner['language'] == $lang){
      $background = $target_images . $banner['aliasname'];
    }
  }
}
if($h['logo']){
  foreach($h['logo'] as $l){
    if($l['language'] == $lang){
      $logo = $target_images . $l['aliasname'];
    }
  }
}
if(!$background) $background = 'assets/images/slider/secret.jpg';
if(!$logo) $logo = 'assets/images/logo.png';
$menu_list = $menu->get_all_list_lang($lang);
$languages_list = $languages->get_all_list();
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $t->get_var('TITLE', $lang); ?> </title>
    <meta name="description" content="<?php echo $t->get_var('KEYWORD', $lang); ?>">
    <meta name="keywords" content="<?php echo $t->get_var('DESCRIPTION', $lang); ?>">
    <!-- Bootstrap CSS-->
    <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!-- IE 9-->
    <!-- Vendors-->
    <link rel="stylesheet" href="assets/vendors/flexslider/flexslider.min.css">
    <link rel="stylesheet" href="assets/vendors/swipebox/css/swipebox.min.css">
    <link rel="stylesheet" href="assets/vendors/slick/slick.min.css">
    <link rel="stylesheet" href="assets/vendors/slick/slick-theme.min.css">
    <link rel="stylesheet" href="assets/vendors/animate.min.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/vendors/pageloading/css/component.min.css">
    <!-- Font-icon-->
    <link rel="stylesheet" href="assets/fonts/font-icon/style.css">
    <!-- Style-->
    <link rel="stylesheet" type="text/css" href="assets/css/layout.css">
    <link rel="stylesheet" type="text/css" href="assets/css/elements.css">
    <link rel="stylesheet" type="text/css" href="assets/css/extra.css">
    <link rel="stylesheet" type="text/css" href="assets/css/widget.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/color.css">-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
    <!-- Script Loading Page-->
    <script src="assets/vendors/html5shiv.js"></script>
    <script src="assets/vendors/respond.min.js"></script>
    <script src="assets/vendors/pageloading/js/snap.svg-min.js"></script>
    <script src="assets/vendors/pageloading/sidebartransition/js/modernizr.custom.js"></script>
  </head>
  <body>
    <div id="pagewrap" class="pagewrap">
      <div id="html-content" class="wrapper-content">
        <header class="header-transparent">
          <div class="header-top top-layout-02">
            <div class="container">
              <div class="topbar-left">
                <div class="topbar-content">
                  <div class="item"> 
                    <div class="wg-contact"><i class="fa fa-map-marker"></i><span><?php echo $t->get_var('DIA_CHI', $lang); ?></span></div>
                  </div>
                  <div class="item"> 
                    <div class="wg-contact">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-phone"></i><span><?php echo $t->get_var('DIEN_THOAI', $lang); ?></span></div>
                  </div>
                </div>
              </div>
              <div class="topbar-right">
                <div class="topbar-content">
                  <div class="item">
                    <ul class="socials-nb list-inline wg-social">
                    <?php
                    if($languages_list){
                      foreach($languages_list as $l){
                        $path = $translatepath->get_path($link, $lang, $l['code']);
                        if($path == 'index.html' || $path == ''){ $path = 'index.html?lang='.$l['code']; }
                        echo '<li style="padding-right:10px !important;"><a href="'.$path.'"><img src="image.html?id='.$l['icon'].'" /></a></li>';
                      }
                    }
                    ?>
                      <!--<li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>-->
                    </ul>
                  </div>
                  <div class="item">
                    <div class="wg-social"><i class="fa fa-user"></i><span><a href="admin/">Quản trị</a></span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="header-main" style="background-color:rgba(0, 0, 0, 0.5);">
            <div class="container">
              <div class="open-offcanvas">&#9776;</div>
              <!--<div class="utility-nav">
                <div class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="search-bar dropdown-toggle"><i class="fa fa-search"></i></a>
                  <div class="dropdown-menu">
                    <div class="search-form">
                      <form action="#">
                        <div class="input-group">
                          <input type="text" placeholder="Search" class="form-control">
                          <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>-->
              <div class="header-logo"><a href="index.html" class="logo logo-static"><img src="<?php echo $logo; ?>" alt="fooday" class="logo-img"  style="width:310px !important;padding:20px;"></a><a href="index.html" class="logo logo-fixed"><img src="<?php echo $logo; ?>" alt="fooday" class="logo-img" style="height:50px;"></a></div>
              <nav id="main-nav-offcanvas" class="main-nav-wrapper">
                <div class="close-offcanvas-wrapper"><span class="close-offcanvas">x</span></div>
                <div class="main-nav">
                  <ul id="main-nav" class="nav nav-pills">
                  <?php
                  if($menu_list){
                    foreach($menu_list as $m){
                      echo '<li><a href="'.$m['link'].'">'.$m['ten'].'</a></li>';
                    }
                  }
                  ?>
                    <!--<li class="dropdown current-menu-item"><a href="index.html" class="dropdown-toggle">Home</a><i class="fa fa-angle-down btn-open-dropdown"></i>
                      <ul class="dropdown-menu">
                        <li><a href="index.html">Home 1</a></li>
                        <li><a href="homepage2.html">Home 2</a></li>
                        <li><a href="homepage3.html">Home 3</a></li>
                        <li><a href="homesidebarmenu.html">Home Sidebar Menu</a></li>
                        <li><a href="home-one-page.html">Home One Page</a></li>
                      </ul>
                    </li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="reservation.html">Reservation</a></li>
                    <li class="dropdown"><a href="menu-grid-1.html">Menu</a>
                      <ul class="dropdown-menu">
                        <li><a href="menu-classic.html">Menu Classic</a></li>
                        <li><a href="menu-grid-1.html">Menu Grid 01</a></li>
                        <li><a href="menu-grid-2.html">Menu Grid 02</a></li>
                        <li><a href="menu-grid-3.html">Menu Grid 03</a></li>
                        <li><a href="product-single.html">Product Detail</a></li>
                      </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>-->
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </header>
        <div class="page-container">
          <div class="top-header top-bg-parallax">
            <div data-parallax="scroll" data-image-src="<?php echo $background; ?>" class="slides parallax-window">
              <div class="slide-content slide-layout-02">
                <div class="container">
                  <div class="slide-content-inner"><img src="assets/images/slider/slider2-icon.png" data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="500" alt="fooday" class="slide-icon img img-responsive animated">
                    <h3 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="1000" class="slide-title animated">Secret garden 1</h3>
                    <p data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="1500" class="slide-sub-title animated"><span class="line-before"></span><span class="line-after"></span><span class="text"><?php echo $t->get_var('KHAU_HIEU', $lang); ?></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <section class="about-us-session padding-top-100 padding-bottom-100">
            <div class="container">
              <div class="row">
                <div class="col-md-6 colsm-12"><img src="assets/images/pages/home1-about.jpg" alt="" class="img img-responsive wow zoomIn"></div>
                <div class="col-md-6 col-sm-12">
                  <div class="swin-sc swin-sc-title style-4 margin-bottom-20 margin-top-50">
                    <p class="top-title"><span>Discover</span></p>
                    <h3 class="title">Our Story</h3>
                  </div>
                  <p class="des font-bold text-center">WE HAVE THE GLORY BEGINING IN RESTAURANT BUSINESS</p>
                  <p class="des margin-bottom-20 text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis ullam laboris nisi ut aliquip ex ea commodo consequat.</p>
                  <div class="swin-btn-wrap center"><a href="javascript:void(0)" class="swin-btn center form-submit btn-transparent"> <span>	About Us</span></a></div>
                </div>
              </div>
            </div>
          </section>
          <section class="product-sesction-03-1 padding-top-100 padding-bottom-100"><img src="assets/images/product/product-decorate.jpg" alt="" class="img-responsive img-decorate">
            <div class="container">
              <div class="row">
                <div class="col-lg-6 col-md-4"></div>
                <div class="col-lg-6 col-md-8">
                  <div class="swin-sc swin-sc-title text-left light">
                    <p class="top-title"><span>chef choise</span></p>
                    <h3 class="title">Daily Special</h3>
                  </div>
                  <div class="swin-sc swin-sc-product products-01 style-04 light swin-vetical-slider">
                    <div class="row">
                      <div class="col-md-12">
                        <div data-height="200" class="products nav-slider">
                          <div class="item product-01">
                            <div class="item-left"><img src="assets/images/product/product-2a.jpg" alt="" class="img img-responsive">
                              <div class="content-wrapper"><a class="title">The Cracker Barrel's Country Boy Breakfast</a>
                                <div class="dot">.....................................................................</div>
                                <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                              </div>
                            </div>
                            <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>25.0</span></div>
                          </div>
                          <div class="item product-01">
                            <div class="item-left"><img src="assets/images/product/product-2b.jpg" alt="" class="img img-responsive">
                              <div class="content-wrapper"><a class="title">Uncle Herschel's Favorite </a>
                                <div class="dot">.....................................................................</div>
                                <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                              </div>
                            </div>
                            <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>45.0</span></div>
                          </div>
                          <div class="item product-01">
                            <div class="item-left"><img src="assets/images/product/product-2c.jpg" alt="" class="img img-responsive">
                              <div class="content-wrapper"><a class="title">Grandpa's Country Fried Breakfast </a>
                                <div class="dot">.....................................................................</div>
                                <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                              </div>
                            </div>
                            <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>30.0</span></div>
                          </div>
                          <div class="item product-01">
                            <div class="item-left"><img src="assets/images/product/product-2d.jpg" alt="" class="img img-responsive">
                              <div class="content-wrapper"><a class="title">Chinese Chicken Bread Spicy Soup</a>
                                <div class="dot">.....................................................................</div>
                                <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                              </div>
                            </div>
                            <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                          </div>
                          <div class="item product-01">
                            <div class="item-left"><img src="assets/images/product/product-2b.jpg" alt="" class="img img-responsive">
                              <div class="content-wrapper"><a class="title">Uncle Herschel's Favorite </a>
                                <div class="dot">.....................................................................</div>
                                <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                              </div>
                            </div>
                            <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>45.0</span></div>
                          </div>
                          <div class="item product-01">
                            <div class="item-left"><img src="assets/images/product/product-2a.jpg" alt="" class="img img-responsive">
                              <div class="content-wrapper"><a class="title">The Cracker Barrel's Country Boy Breakfast</a>
                                <div class="dot">.....................................................................</div>
                                <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                              </div>
                            </div>
                            <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>25.0</span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section class="product-sesction-01 padding-bottom-100 padding-top-100">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="swin-sc swin-sc-title">
                    <p class="top-title"><span>Our Menu</span></p>
                    <h3 class="title">Tasty And Good Price</h3>
                  </div>
                  <div class="swin-sc swin-sc-product products-01 style-02 woocommerce">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div data-slide-toshow="5" class="cat-wrapper-02 main-slider col-md-8">
                        <div class="item">
                          <div class="cat-icons"><i class="icons swin-icon-pasta"></i>
                            <h5 class="cat-title">Breakfast</h5>
                          </div>
                        </div>
                        <div class="item">
                          <div class="cat-icons"><i class="icons swin-icon-fish"></i>
                            <h5 class="cat-title">Lunch</h5>
                          </div>
                        </div>
                        <div class="item">
                          <div class="cat-icons"><i class="icons swin-icon-meat"></i></div>
                          <h5 class="cat-title">Dinner</h5>
                        </div>
                        <div class="item">
                          <div class="cat-icons"><i class="icons swin-icon-ice-cream"></i></div>
                          <h5 class="cat-title">Desset</h5>
                        </div>
                        <div class="item">
                          <div class="cat-icons"><i class="icons swin-icon-dinner"></i></div>
                          <h5 class="cat-title">Drink</h5>
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                      <div class="nav-slider">
                        <div class="tab-content">
                          <div class="col-md-5 col-sm-12">
                            <div class="cat-wrapper">
                              <div class="item"><img src="assets/images/product/pd-cat-dessert.png" alt="" class="img img-responsive img-full"></div>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-12">
                            <div class="products">
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">The Cracker Barrel's Country Boy Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>25.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Uncle Herschel's Favorite </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>45.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Grandpa's Country Fried Breakfast </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>30.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Old Timer's Meat Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Chinese Chicken Bread Spicy Soup</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-content">
                          <div class="col-md-5 col-sm-12">
                            <div class="cat-wrapper">
                              <div class="item"><img src="assets/images/product/pd-cat-lunch.png" alt="" class="img img-responsive img-full"></div>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-12">
                            <div class="products">
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">The Cracker Barrel's Country Boy Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>25.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Grandpa's Country Fried Breakfast </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>30.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Uncle Herschel's Favorite </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>45.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Chinese Chicken Bread Spicy Soup</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Old Timer's Meat Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-content">
                          <div class="col-md-5 col-sm-12">
                            <div class="cat-wrapper">
                              <div class="item"><img src="assets/images/product/pd-cat-dinner.png" alt="" class="img img-responsive img-full"></div>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-12">
                            <div class="products">
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Uncle Herschel's Favorite </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>45.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Old Timer's Meat Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">The Cracker Barrel's Country Boy Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>25.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Grandpa's Country Fried Breakfast </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>30.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Chinese Chicken Bread Spicy Soup</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-content">
                          <div class="col-md-5 col-sm-12">
                            <div class="cat-wrapper">
                              <div class="item"><img src="assets/images/product/pd-cat-dessert.png" alt="" class="img img-responsive img-full"></div>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-12">
                            <div class="products">
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">The Cracker Barrel's Country Boy Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>25.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Grandpa's Country Fried Breakfast </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>30.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Old Timer's Meat Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Uncle Herschel's Favorite </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>45.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Chinese Chicken Bread Spicy Soup</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-content">
                          <div class="col-md-5 col-sm-12">
                            <div class="cat-wrapper">
                              <div class="item"><img src="assets/images/product/pd-cat-lunch.png" alt="" class="img img-responsive img-full"></div>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-12">
                            <div class="products">
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Old Timer's Meat Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">The Cracker Barrel's Country Boy Breakfast</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>25.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Grandpa's Country Fried Breakfast </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>30.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Uncle Herschel's Favorite </h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>45.0</span></div>
                              </div>
                              <div class="item product-01">
                                <div class="item-left">
                                  <h5 class="title">Chinese Chicken Bread Spicy Soup</h5>
                                  <div class="des">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </div>
                                </div>
                                <div class="item-right"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">$</span>12.0</span></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section data-bottom-top="background-position: 50% 50px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -150px;" class="testimonial-section-01 padding-top-100 padding-bottom-100">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="swin-sc swin-sc-title">
                    <p class="top-title"><span>Testimonial</span></p>
                    <h3 class="title white-color">Our Customer Says</h3>
                  </div>
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <div class="swin-sc swin-sc-testimonial style-1">
                        <div class="main-slider flexslider">
                          <div class="slides">
                            <div class="testi-item item"><i class="testi-icon fa fa-quote-left"></i>
                              <div class="testi-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                              </div>
                              <div class="testi-info"><span class="name">Timothy Doe</span> <span class="position">Customer</span></div>
                            </div>
                            <div class="testi-item item"><i class="testi-icon fa fa-quote-left"></i>
                              <div class="testi-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                              </div>
                              <div class="testi-info"><span class="name">Sarah	Ruiz</span> <span class="position">Director</span></div>
                            </div>
                            <div class="testi-item item"><i class="testi-icon fa fa-quote-left"></i>
                              <div class="testi-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                              </div>
                              <div class="testi-info"><span class="name">Tracey Lewis</span> <span class="position">Designer</span></div>
                            </div>
                            <div class="testi-item item"><i class="testi-icon fa fa-quote-left"></i>
                              <div class="testi-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                              </div>
                              <div class="testi-info"><span class="name">Jamie	Erickson</span> <span class="position">Manager</span></div>
                            </div>
                          </div>
                        </div>
                        <div data-width="150" class="nav-slider">
                          <ul class="slides list-inline">
                            <li class="swin-transition"><a href="javascript:void(0)" class="testimonial-nav-item"><img src="assets/images/testi/testi-1.jpg" alt="fooday" class="img img-responsive swin-transition"></a></li>
                            <li class="swin-transition"><a href="javascript:void(0)" class="testimonial-nav-item"><img src="assets/images/testi/testi-2.jpg" alt="fooday" class="img img-responsive swin-transition"></a></li>
                            <li class="swin-transition"><a href="javascript:void(0)" class="testimonial-nav-item"><img src="assets/images/testi/testi-3.jpg" alt="fooday" class="img img-responsive swin-transition"></a></li>
                            <li class="swin-transition"><a href="javascript:void(0)" class="testimonial-nav-item"><img src="assets/images/testi/testi-4.jpg" alt="fooday" class="img img-responsive swin-transition"></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section class="team-section padding-top-100 padding-bottom-100">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="swin-sc swin-sc-title">
                    <p class="top-title"><span>Meet Our</span></p>
                    <h3 class="title">Awesome Master Chefs</h3>
                  </div>
                  <div class="swin-sc swin-sc-team-slider">
                    <div class="team-item swin-transition wow fadeInLeft">
                      <div class="team-img-wrap">
                        <div class="team-img"><img src="assets/images/team/team-1.png" alt="" class="img img-responsive"></div>
                      </div>
                      <p class="team-name">MICHAEL DOE</p>
                      <p class="team-position">Head Chef</p>
                      <hr>
                      <ul class="socials-nb list-inline">
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                    <div class="team-item swin-transition wow fadeInUp">
                      <div class="team-img-wrap">
                        <div class="team-img"><img src="assets/images/team/team-2.png" alt="" class="img img-responsive"></div>
                      </div>
                      <p class="team-name">Teresa Doe</p>
                      <p class="team-position">Head Chef</p>
                      <hr>
                      <ul class="socials-nb list-inline">
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                    <div class="team-item swin-transition wow fadeInRight">
                      <div class="team-img-wrap">
                        <div class="team-img"><img src="assets/images/team/team-3.png" alt="" class="img img-responsive"></div>
                      </div>
                      <p class="team-name">BENJAMIN MARK</p>
                      <p class="team-position">Head Chef</p>
                      <hr>
                      <ul class="socials-nb list-inline">
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                    <div class="team-item swin-transition">
                      <div class="team-img-wrap">
                        <div class="team-img"><img src="assets/images/team/team-4.png" alt="" class="img img-responsive"></div>
                      </div>
                      <p class="team-name">Teresa Doe</p>
                      <p class="team-position">Head Chef</p>
                      <hr>
                      <ul class="socials-nb list-inline">
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section class="reservation-section-02 padding-top-100 padding-bottom-100">
            <div class="container"><img src="assets/images/background/home2-img-deco.png" alt="" class="img-deco img-responsive">
              <div class="row">
                <div class="col-md-6 left-wrapper">
                  <div class="form-dark-wrapper">
                    <div class="swin-sc swin-sc-title style-3 light">
                      <p class="title"><span>Make A Reservation</span></p>
                      <p class="subtitle">You can call us directly at <span class="text-default"> 225-88888</span></p>
                    </div>
                    <div class="swin-sc swin-sc-contact-form dark mtl">
                      <form>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <div class="fa fa-phone"></div>
                            </div>
                            <input type="text" placeholder="Phone" class="form-control">
                          </div>
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-male"></i></div>
                            <select type="text" placeholder="People" class="form-control">
                              <option>1 person</option>
                              <option>2 People</option>
                              <option>3 People</option>
                              <option>4 People</option>
                              <option>5 People</option>
                              <option>6 People</option>
                              <option>7 People</option>
                              <option>8 People</option>
                              <option>9 People</option>
                              <option>10 People</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" placeholder="Date" class="form-control datepicker">
                          </div>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <div class="fa fa-clock-o"></div>
                            </div>
                            <select type="text" placeholder="Time" class="form-control">
                              <option>7:00 AM</option>
                              <option>8:00 AM</option>
                              <option>9:00 AM</option>
                              <option>10:00 AM</option>
                              <option>11:00 AM</option>
                              <option>12:00 AM</option>
                              <option>1:00 PM</option>
                              <option>2:00 PM</option>
                              <option>3:00 PM</option>
                              <option>4:00 PM</option>
                              <option>5:00 PM</option>
                              <option>6:00 PM</option>
                              <option>7:00 PM</option>
                              <option>8:00 PM</option>
                              <option>9:00 PM</option>
                              <option>10:00 PM</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="swin-btn-wrap center"><a href="javascript:void(0)" class="swin-btn center form-submit"> <span>	Find Table</span></a></div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="video-wrapper equal-height deco-abs">
              <div class="swin-sc swin-sc-video">
                <div class="play-wrap"><a href="https://vimeo.com/27814858" class="play-btn swipebox"><i class="play-icon fa fa-play"></i></a></div>
              </div>
            </div>
          </section>
          <section class="service-section-02 padding-top-100 padding-bottom-100">
            <div class="container">
              <div class="swin-sc swin-sc-title">
                <p class="top-title"><span>Our Service</span></p>
                <h3 class="title">What We Focus On</h3>
              </div>
              <div class="swin-sc swin-sc-iconbox">
                <div class="row">
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="item icon-box-02 wow fadeInUpShort">
                      <div class="wrapper-icon"><i class="icons swin-icon-dish"></i><span class="number">1</span></div>
                      <h4 class="title">Reservation</h4>
                      <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div data-wow-delay="0.5s" class="item icon-box-02 wow fadeInUpShort">
                      <div class="wrapper-icon"><i class="icons swin-icon-dinner-2"></i><span class="number">2</span></div>
                      <h4 class="title">Private Event</h4>
                      <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div data-wow-delay="1s" class="item icon-box-02 wow fadeInUpShort">
                      <div class="wrapper-icon"><i class="icons swin-icon-browser"></i><span class="number">3</span></div>
                      <h4 class="title">Online Order</h4>
                      <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div data-wow-delay="1.5s" class="item icon-box-02 wow fadeInUpShort">
                      <div class="wrapper-icon"><i class="icons swin-icon-delivery"></i><span class="number">4</span></div>
                      <h4 class="title">Fast Delivery</h4>
                      <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section class="gallery-section-01 padding-top-100">
            <div class="swin-sc swin-sc-title">
              <p class="top-title"><span>Our Gallery</span></p>
              <h3 class="title white-color">Fooday Hot Dishes</h3>
            </div>
            <div class="swin-sc swin-sc-isotope">
              <div class="grid">
                <div class="grid-sizer col-sm-1"></div>
                <div class="grid-item col-sm-3 grid-item-h2">
                  <div class="grid-wrap-item"><a href="#" class="gallery-title title">Chicago Beefsteak</a><a href="assets/images/gallery/gallery-1.jpg" data-lightbox="image" class="view-lightbox swipebox"><i class="fa fa-search-plus"></i></a><a href="#" class="view-more"><i class="fa fa-link"></i></a>
                    <div class="img-wrap"><img src="assets/images/gallery/gallery-1.jpg" alt="" class="img img-responsive"></div>
                  </div>
                </div>
                <div class="grid-item col-sm-4 grid-item-h1">
                  <div class="grid-wrap-item"><a href="#" class="gallery-title title">Chicago Beefsteak</a><a href="assets/images/gallery/gallery-2.jpg" data-lightbox="image" class="view-lightbox swipebox"><i class="fa fa-search-plus"></i></a><a href="#" class="view-more"><i class="fa fa-link"></i></a>
                    <div class="img-wrap"><img src="assets/images/gallery/gallery-2.jpg" alt="" class="img img-responsive"></div>
                  </div>
                </div>
                <div class="grid-item col-sm-2 grid-item-h1">
                  <div class="grid-wrap-item"><a href="#" class="gallery-title title">Chicago Beefsteak</a><a href="assets/images/gallery/gallery-3.jpg" data-lightbox="image" class="view-lightbox swipebox"><i class="fa fa-search-plus"></i></a><a href="#" class="view-more"><i class="fa fa-link"></i></a>
                    <div class="img-wrap"><img src="assets/images/gallery/gallery-3.jpg" alt="" class="img img-responsive"></div>
                  </div>
                </div>
                <div class="grid-item col-sm-3 grid-item-h2">
                  <div class="grid-wrap-item"><a href="#" class="gallery-title title">Chicago Beefsteak</a><a href="assets/images/gallery/gallery-4.jpg" data-lightbox="image" class="view-lightbox swipebox"><i class="fa fa-search-plus"></i></a><a href="#" class="view-more"><i class="fa fa-link"></i></a>
                    <div class="img-wrap"><img src="assets/images/gallery/gallery-4.jpg" alt="" class="img img-responsive"></div>
                  </div>
                </div>
                <div class="grid-item col-sm-2 grid-item-h1">
                  <div class="grid-wrap-item"><a href="#" class="gallery-title title">Chicago Beefsteak</a><a href="assets/images/gallery/gallery-5.jpg" data-lightbox="image" class="view-lightbox swipebox"><i class="fa fa-search-plus"></i></a><a href="#" class="view-more"><i class="fa fa-link"></i></a>
                    <div class="img-wrap"><img src="assets/images/gallery/gallery-5.jpg" alt="" class="img img-responsive"></div>
                  </div>
                </div>
                <div class="grid-item col-sm-4 grid-item-h1">
                  <div class="grid-wrap-item"><a href="#" class="gallery-title title">Chicago Beefsteak</a><a href="assets/images/gallery/gallery-6.jpg" data-lightbox="image" class="view-lightbox swipebox"><i class="fa fa-search-plus"></i></a><a href="#" class="view-more"><i class="fa fa-link"></i></a>
                    <div class="img-wrap"><img src="assets/images/gallery/gallery-6.jpg" alt="" class="img img-responsive"></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section class="blog-section padding-top-100 padding-bottom-100">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="swin-sc swin-sc-title">
                    <p class="top-title"><span>Updated from</span></p>
                    <h3 class="title">our featured blog</h3>
                  </div>
                  <div class="swin-sc swin-sc-blog-grid"></div>
                </div>
                <div class="col-md-12">
                  <div class="swin-sc swin-sc-blog-grid">
                    <div class="row">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div data-wow-delay="0s" class="blog-item swin-transition item wow fadeInUpShort">
                          <div class="blog-info clearfix">
                            <div class="blog-info-item blog-view">
                              <p><i class="fa fa-eye"></i><span>18</span></p>
                              <p></p>
                            </div>
                            <div class="blog-info-item blog-comment">
                              <p><i class="fa fa-comment"></i><span>18</span></p>
                              <p></p>
                            </div>
                            <div class="blog-info-item blog-author">
                              <p><span>Post By </span><a href="javascript:void(0)">Admin</a></p>
                              <p></p>
                            </div>
                          </div>
                          <div class="blog-featured-img"><img src="assets/images/blog/blog-grid-1.jpg" alt="fooday" class="img img-responsive"></div>
                          <div class="blog-content">
                            <div class="blog-date"><span class="day">12</span><span class="month">Jun</span></div>
                            <h3 class="blog-title"><a href="javascript:void(0)" class="swin-transition">How To Cook The Spicy Chinese Noodle For Cold Weather</a></h3>
                            <p class="blog-description">Lorem ipsum dolor sit amet, consectetur, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="blog-readmore"><a href="javascript:void(0)" class="swin-transition">Read More <i class="fa fa-angle-double-right"></i></a></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div data-wow-delay="0.5s" class="blog-item swin-transition item wow fadeInUpShort">
                          <div class="blog-info clearfix">
                            <div class="blog-info-item blog-view">
                              <p><i class="fa fa-eye"></i><span>18</span></p>
                              <p></p>
                            </div>
                            <div class="blog-info-item blog-comment">
                              <p><i class="fa fa-comment"></i><span>18</span></p>
                              <p></p>
                            </div>
                            <div class="blog-info-item blog-author">
                              <p><span>Post By </span><a href="javascript:void(0)">Admin</a></p>
                              <p></p>
                            </div>
                          </div>
                          <div class="blog-featured-img"><img src="assets/images/blog/blog-grid-1-1.jpg" alt="fooday" class="img img-responsive"></div>
                          <div class="blog-content">
                            <div class="blog-date"><span class="day">12</span><span class="month">Jun</span></div>
                            <h3 class="blog-title"><a href="javascript:void(0)" class="swin-transition">How To Cook The Spicy Chinese Noodle For Cold Weather</a></h3>
                            <p class="blog-description">Lorem ipsum dolor sit amet, consectetur, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="blog-readmore"><a href="javascript:void(0)" class="swin-transition">Read More <i class="fa fa-angle-double-right"></i></a></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12">
                        <div data-wow-delay="1s" class="blog-item swin-transition item wow fadeInUpShort">
                          <div class="blog-info clearfix">
                            <div class="blog-info-item blog-view">
                              <p><i class="fa fa-eye"></i><span>18</span></p>
                              <p></p>
                            </div>
                            <div class="blog-info-item blog-comment">
                              <p><i class="fa fa-comment"></i><span>18</span></p>
                              <p></p>
                            </div>
                            <div class="blog-info-item blog-author">
                              <p><span>Post By </span><a href="javascript:void(0)">Admin</a></p>
                              <p></p>
                            </div>
                          </div>
                          <div class="blog-featured-img"><img src="assets/images/blog/blog-grid-1-2.jpg" alt="fooday" class="img img-responsive"></div>
                          <div class="blog-content">
                            <div class="blog-date"><span class="day">12</span><span class="month">Jun</span></div>
                            <h3 class="blog-title"><a href="javascript:void(0)" class="swin-transition">How To Cook The Spicy Chinese Noodle For Cold Weather</a></h3>
                            <p class="blog-description">Lorem ipsum dolor sit amet, consectetur, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="blog-readmore"><a href="javascript:void(0)" class="swin-transition">Read More <i class="fa fa-angle-double-right"></i></a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <footer>
          <div class="subscribe-section"><img src="assets/images/background/bg5.png" alt="" class="img-subscribe">
            <div class="container">
              <div class="subscribe-wrapper">
                <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                    <div class="subscribe-heading">
                      <h3 class="title">Subcribe Us Now</h3>
                      <div class="des">Get more news and delicious dishes everyday from us</div>
                    </div>
                    <form class="widget-newsletter">
                      <input placeholder="Email" class="form-control"><span class="submit"><i class="fa fa-paper-plane"></i></span>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-top"></div>
          <div class="footer-main">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="ft-widget-area">
                    <div class="ft-area1">
                      <div class="swin-wget swin-wget-about">
                        <div class="clearfix"><a class="wget-logo"><img src="assets/images/logo-ft.png" alt="" class="img img-responsive"></a>
                          <ul class="socials socials-about list-unstyled list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                          </ul>
                        </div>
                        <div class="wget-about-content">
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor.</p>
                        </div>
                        <div class="about-contact-info clearfix">
                          <div class="address-info">
                            <div class="info-icon"><i class="fa fa-map-marker"></i></div>
                            <div class="info-content">
                              <p>157 White Oak Drive Kansas City </p>
                              <p>689 Lynn Street South Boston</p>
                            </div>
                          </div>
                          <div class="phone-info">
                            <div class="info-icon"><i class="fa fa-mobile-phone"></i></div>
                            <div class="info-content">
                              <p>(617)-276-8031</p>
                              <p>(617)-276-8031</p>
                            </div>
                          </div>
                          <div class="email-info">
                            <div class="info-icon"><i class="fa fa-envelope"></i></div>
                            <div class="info-content">
                              <p>admin@fooday.com</p>
                              <p>support@fooday.com</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="ft-fixed-area wow fadeInRight">
                    <div class="reservation-box">
                      <div class="reservation-wrap">
                        <h3 class="res-title">Open Hour</h3>
                        <div class="res-date-time">
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Tuesday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>7AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Wednesday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>7AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Thursday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>7AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Friday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>7AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Saturday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>7AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Sunday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>7AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Monday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>Close</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <h3 class="res-title">Reservation Numbers</h3>
                        <p class="res-number">(617)-276-8031</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer><a id="totop" href="#" class="animated"><i class="fa fa-angle-double-up"></i></a>
      </div>
      <div id="loader" data-opening="m -5,-5 0,70 90,0 0,-70 z m 5,35 c 0,0 15,20 40,0 25,-20 40,0 40,0 l 0,0 C 80,30 65,10 40,30 15,50 0,30 0,30 z" class="pageload-overlay">
        <div class="loader-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewbox="0 0 80 60" preserveaspectratio="none">
            <path d="m -5,-5 0,70 90,0 0,-70 z m 5,5 c 0,0 7.9843788,0 40,0 35,0 40,0 40,0 l 0,60 c 0,0 -3.944487,0 -40,0 -30,0 -40,0 -40,0 z"></path>
          </svg>
          <div class="sk-circle">
            <div class="sk-circle1 sk-child"></div>
            <div class="sk-circle2 sk-child"></div>
            <div class="sk-circle3 sk-child"></div>
            <div class="sk-circle4 sk-child"></div>
            <div class="sk-circle5 sk-child"></div>
            <div class="sk-circle6 sk-child"></div>
            <div class="sk-circle7 sk-child"></div>
            <div class="sk-circle8 sk-child"></div>
            <div class="sk-circle9 sk-child"></div>
            <div class="sk-circle10 sk-child"></div>
            <div class="sk-circle11 sk-child"></div>
            <div class="sk-circle12 sk-child"></div>
          </div>
          <div class="sk-circle sk-circle-out">
            <div class="sk-circle1 sk-child"></div>
            <div class="sk-circle2 sk-child"></div>
            <div class="sk-circle3 sk-child"></div>
            <div class="sk-circle4 sk-child"></div>
            <div class="sk-circle5 sk-child"></div>
            <div class="sk-circle6 sk-child"></div>
            <div class="sk-circle7 sk-child"></div>
            <div class="sk-circle8 sk-child"></div>
            <div class="sk-circle9 sk-child"></div>
            <div class="sk-circle10 sk-child"></div>
            <div class="sk-circle11 sk-child"></div>
            <div class="sk-circle12 sk-child"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery-->
    <script src="assets/vendors/jquery-1.10.2.min.js"></script>
    <!-- Bootstrap JavaScript-->
    <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <!-- Vendors-->
    <script src="assets/vendors/flexslider/jquery.flexslider-min.js"></script>
    <script src="assets/vendors/swipebox/js/jquery.swipebox.min.js"></script>
    <script src="assets/vendors/slick/slick.min.js"></script>
    <script src="assets/vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/vendors/jquery-countTo/jquery.countTo.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/parallax/parallax.min.js"></script>
    <script src="assets/vendors/gmaps/gmaps.min.js"></script>
    <script src="assets/vendors/audiojs/audio.min.js"></script>
    <script src="assets/vendors/vide/jquery.vide.min.js"></script>
    <script src="assets/vendors/pageloading/js/svgLoader.min.js"></script>
    <script src="assets/vendors/pageloading/js/classie.min.js"></script>
    <script src="assets/vendors/pageloading/sidebartransition/js/sidebarEffects.min.js"></script>
    <script src="assets/vendors/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/vendors/wowjs/wow.min.js"></script>
    <script src="assets/vendors/skrollr.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Own script-->
    <script src="assets/js/layout.js"></script>
    <script src="assets/js/elements.js"></script>
    <script src="assets/js/widget.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>
  </body>
</html>