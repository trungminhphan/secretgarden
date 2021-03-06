<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
$url = $_SERVER['REQUEST_URI'];$a=explode("/", $url);$link=end($a);
$session = new SessionManager();
$users = new Users();
require_once('admin/inc/functions.inc.php');
require_once('admin/inc/config.inc.php');
$languages = new Languages();$hub = new Hub();
$_SESSION['language'] = isset($_GET['lang']) ? $_GET['lang'] : '';
if(isset($_SESSION['language']) && $_SESSION['language']){
  $lang = $_SESSION['language'];
} else {
  $lang = $languages->get_default();
  $_SESSION['language'] = $lang;
}

$logo = '';
$t = $hub->get_one();
if(isset($t['logo']) && $t['logo']){
  foreach($t['logo'] as $l){
    if($l['language'] == $lang){
      $logo = $target_images . $l['aliasname'];
    }
  }
}
if(!$logo) $logo = 'assets/images/logo.png';

$background = '';
if(isset($t['background']) && $t['background']){
  foreach($t['background'] as $b){
    if($b['language'] == $lang){
      $background = $target_images . $b['aliasname'];
    }
  }
}
if(!$background) $background = 'assets/images/bg.jpg';
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secret Garden Group Vietnam</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="title" content="Secret Garden Group Vietnam"/>
    <meta name="description" content="Hệ thống nhà hàng Secret Garden, Mountain Retrear, Ngọc Châu Garden, Secret House, The Huế House tại Sài Gòn, TPHCM, Việt Nam" />
    <meta name="keywords" content="Secret Garden restaurant, Mountain Retreat restaurant, Ngoc Chau garden Vietnamese restaurant, Secret House Restaurant, The Hue House restaurant." />
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
    <div id="pagewrap" class="pagewrap" style="background:#294b37;">
      <div id="html-content" class="wrapper-content">
         <!--style="background:url(<?php //echo $background; ?>); padding-top:0px; min-height:100vh;background-size: cover;"-->
        <section class="featured-section padding-bottom-100">
            <div class="container" style="margin:0px !important; padding:0px !important;width:100%;text-align:center;background:#294b37;">
              <img src="assets/images/hub_1920.png" />
            </div>
          </section>
      </div>
      <div id="loader" data-opening="m -5,-5 0,70 90,0 0,-70 z m 5,35 c 0,0 15,20 40,0 25,-20 40,0 40,0 l 0,0 C 80,30 65,10 40,30 15,50 0,30 0,30 z" class="pageload-overlay">
        <div class="loader-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewbox="0 0 80 60" preserveaspectratio="none">
            <path d="m -5,-5 0,70 90,0 0,-70 z m 5,5 c 0,0 7.9843788,0 40,0 35,0 40,0 40,0 l 0,60 c 0,0 -3.944487,0 -40,0 -30,0 -40,0 -40,0 z"></path>
          </svg>
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
    <script type="text/javascript">
      $(document).ready(function(){
        $(".hub-icon").mouseover(function(){
          var index = $(this).index();
          $('#myCarousel').carousel(index);
        });
      });
    </script>
  </body>
</html>
