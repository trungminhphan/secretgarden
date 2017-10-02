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
    <div id="pagewrap" class="pagewrap" >
      <div id="html-content" class="wrapper-content">
        <section class="featured-section padding-bottom-100" style="background:url(<?php echo $background; ?>); padding-top:0px; min-height:100vh;background-size: cover;">
            <div class="container" style="margin:0px !important; padding:0px !important;width:100%;">
              <div class="row">
                <div class="col-md-12" >
                  <!--<div class="swin-sc swin-sc-title">
                    <?php //if($users->isLoggedIn() && $users->is_admin()): ?>
                      <a href="admin/hub.html?url=<?php //echo $_SERVER['REQUEST_URI']; ?>" class="edit-icon" title="Edit Logo" alt="Edit Logo"><i class="fa fa-pencil-square"></i></a>
                    <?php //endif; ?>
                    <img src="<?php //echo $logo; ?>" alt="Secret Garden" style="width:350px;">
                  </div>-->
                  <div class="row">
                    <div class="col-md-12">
                      <!--<img src="assets/images/banner.png" width="100%" />-->
                      <?php if(isset($t['banner']) && $t['banner']) : ?>
                      <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        <?php
                          $i = 0;
                          foreach($t['banner'] as $b){
                            if($b['language'] == $lang){
                              echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.($i == 0 ? 'class="active"' : '').'></li>';
                              $i++;
                            }
                          }
                        ?>
                        </ol>
                        <div class="carousel-inner">
                        <?php
                        $i=0;
                        foreach($t['banner'] as $key => $value){
                          if($value['language'] == $lang){
                            echo '<div class="item '.($i == 0? 'active' : '').'">
                              <img src="'.$target_images.$value['aliasname'].'" alt="'.$value['name'].'" style="width:100%;">
                            </div>';$i++;
                          }
                        }
                        ?>
                        </div>
                         <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    <?php endif; ?>
                    </div>
                  </div>
                  <div class="row" style="padding: 20px;">
                      <div class="col-md-12">
                          <img src="assets/images/service.png" style="width:100%;" />
                      </div>
                  </div>
                  <?php if(isset($t['icon']) && $t['icon']): ?>
                  <div class="row">
                    <div class="col-md-12">
                      <?php
                      $i=1;
                      foreach($t['icon'] as $key => $value){
                        if($value['language'] == $lang){
                          echo '<div class="hub-icon hub-icon-'.$i.'">
                          <a href="'.$value['link'].'">
                            <img src="'.$target_images.$value['aliasname'].'" width="80%" />
                          </a>
                          </div>';
                          $i++;
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="hub-icon-text">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
                        </div>
                        <div class="hub-icon-text">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
                        </div>
                        <div class="hub-icon-text">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
                        </div>
                        <div class="hub-icon-text">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
                        </div>
                        <div class="hub-icon-text">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 copyright" style="text-align:center;padding-top:50px;">
                      <p>Copyright &copy; 2017 by SecretGarden Group <br />
                      Designed by JAYbranding - <a href="mailto:info@jaybranding.com">info@jaybranding.com</a> - 0989 971131</p>
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                  </div>
                </div>
              </div>
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
