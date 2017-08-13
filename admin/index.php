<?php
require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<!-- begin page-header -->
<h1 class="page-header">CHỌN CHỨC NĂNG QUẢN LÝ HỆ THỐNG</h1>
<div class="row">
<div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>HƯỚNG DẪN</p>    
            </div>
            <div class="stats-link">
                <a href="huongdan.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon"><i class="ion-calendar"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>TIN TỨC</p>   
            </div>
            <div class="stats-link">
                <a href="tintuc.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><i class="fa fa-video-camera"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>VIDEO</p>    
            </div>
            <div class="stats-link">
                <a href="video.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-red">
            <div class="stats-icon"><i class="fa fa-dropbox"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>SẢN PHẨM</p>    
            </div>
            <div class="stats-link">
                <a href="sanpham.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-map-marker"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>DANH MỤC THÀNH PHỐ</p>    
            </div>
            <div class="stats-link">
                <a href="danhmucthanhpho.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon"><i class="ion-speakerphone"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>DANH MỤC TIN TỨC</p>   
            </div>
            <div class="stats-link">
                <a href="danhmuctintuc.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><i class="fa fa-play-circle"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>DANH MỤC VIDEO</p>    
            </div>
            <div class="stats-link">
                <a href="danhmucvideo.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-red">
            <div class="stats-icon"><i class="ion-bag"></i></div>
            <div class="stats-info">
                <h4>QUẢN LÝ</h4>
                <p>DANH MỤC SẢN PHẨM</p>    
            </div>
            <div class="stats-link">
                <a href="danhmucsanpham.html">Quản lý <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();
    });
</script>