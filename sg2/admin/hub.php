<?php
require_once('header.php');
$hub = new Hub();
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$t = $hub->get_one();
$languages = new Languages();
$language_list = $languages->get_all_list();

if(isset($_POST['submit'])){
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    if($act == 'banner'){
        $arr_banner = array();
        $banner_aliasname = isset($_POST['banner_aliasname']) ? $_POST['banner_aliasname'] : '';
        $banner_filename = isset($_POST['banner_filename']) ? $_POST['banner_filename'] : '';
        $banner_link = isset($_POST['banner_link']) ? $_POST['banner_link'] : '';
        $banner_name = isset($_POST['banner_name']) ? $_POST['banner_name'] : '';
        $banner_language = isset($_POST['banner_language']) ? $_POST['banner_language'] : '';
        $banner_address = isset($_POST['banner_address']) ? $_POST['banner_address'] : '';
        $banner_orders = isset($_POST['banner_orders']) ? $_POST['banner_orders'] : '';
        if($banner_aliasname){
            foreach ($banner_aliasname as $key => $value) {
                array_push($arr_banner, array('filename' => $banner_filename[$key], 'aliasname' => $value,'name' => $banner_name[$key], 'address' => $banner_address[$key], 'link' => $banner_link[$key], 'orders' => $banner_orders[$key],'language' => $banner_language[$key]));
            }
        }

        $arr_logo = array();
        $logo_aliasname = isset($_POST['logo_aliasname']) ? $_POST['logo_aliasname'] : '';
        $logo_filename = isset($_POST['logo_filename']) ? $_POST['logo_filename'] : '';
        $logo_link = isset($_POST['logo_link']) ? $_POST['logo_link'] : '';
        $logo_name = isset($_POST['logo_name']) ? $_POST['logo_name'] : '';
        $logo_language = isset($_POST['logo_language']) ? $_POST['logo_language'] : '';
        $logo_orders = isset($_POST['logo_orders']) ? $_POST['logo_orders'] : '';
        if($logo_aliasname){
            foreach ($logo_aliasname as $key => $value) {
                array_push($arr_logo, array('filename' => $logo_filename[$key], 'aliasname' => $value,'name' => $logo_name[$key], 'link' => $logo_link[$key], 'orders' => $logo_orders[$key],'language' => $logo_language[$key]));
            }
        }
        $arr_banner = sort_array_1($arr_banner, 'orders', SORT_ASC);
        $arr_logo = sort_array_1($arr_logo, 'orders', SORT_ASC);

        $hub->banner = $arr_banner;
        $hub->logo = $arr_logo;
        if($hub->edit_banner()) transfers_to('hub.html?msg=Lưu Banner thành công');
    }
}

?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<!-- begin page-header -->
<h1 class="page-header">QUẢN LÝ TRANG CHỦ</h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" id="hubform" enctype="multipart/form-data">
<input type="hidden" name="act" value="banner">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-gears"></i> LOGO - BANNER</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh LOGO</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình LOGO tốt nhất (477px x 140px)...</span>
                            <input type="file" name="logo_files[]" multiple class="logo_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="logo_list">
                <?php
                if($t['logo']){
                    foreach($t['logo'] as $logo){
                        $orders = isset($logo['orders']) ? $logo['orders'] : 0;
                        $name = isset($logo['name']) ? $logo['name'] : '';
                        $language = isset($logo['language']) ? $logo['language'] : '';
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-1">
                            <input type="number" class="form-control" name="logo_orders[]" value="'.$orders.'" />
                          </div>';
                        echo '<div class="col-md-1">';
                        if($language_list){
                            echo '<select name="logo_language[]" class="form-control">';
                            foreach($language_list as $lang){
                                echo '<option value="'.$lang['code'].'"'.($lang['code']==$language ? ' selected' : '').'>'.$lang['code'].'</option>';
                            }
                            echo '</select>';
                        }
                        echo '</div>';
                        echo '<div class="col-md-3"><input type="text" name="logo_name[]" class="form-control" placeholder="Tên" value="'.$name.'"></div>';
                        echo '<div class="col-md-4"><input type="text" name="logo_link[]" value="'.$logo['link'].'" class="form-control" placeholder="Liên kết"></div>';
                        echo '<div class="col-md-3">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="logo_aliasname[]" value="'.$logo['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="logo_filename[]" value="'.$logo['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoalogo_hub.html?filename='.$logo['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
            	<div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh BANNER</label>
                    <div class="col-md-3">
						<span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình Banner tốt nhất (1920px x 1280px)...</span>
                            <input type="file" name="banner_files[]" multiple class="banner_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="banner_list">
                <?php
                if($t['banner']){
                    foreach($t['banner'] as $banner){
                        $orders = isset($banner['orders']) ? $banner['orders'] : 0;
                        $name = isset($banner['name']) ? $banner['name'] : '';
                        $address = isset($banner['address']) ? $banner['address'] : '';
                        $language = isset($banner['language']) ? $banner['language'] : '';
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-1">
                            <input type="number" class="form-control" name="banner_orders[]" value="'.$orders.'" />
                          </div>';
                        echo '<div class="col-md-1">';
                        if($language_list){
                            echo '<select name="banner_language[]" class="form-control">';
                            foreach($language_list as $lang){
                                echo '<option value="'.$lang['code'].'"'.($lang['code']==$language ? ' selected' : '').'>'.$lang['code'].'</option>';
                            }
                            echo '</select>';
                        }
                        echo '</div>';
                        echo '<div class="col-md-2"><input type="text" name="banner_name[]" class="form-control" placeholder="Tên" value="'.$name.'"></div>';
                          echo '<div class="col-md-3"><input type="text" name="banner_address[]" class="form-control" placeholder="Địa chỉ" value="'.$address.'"></div>';
                        echo '<div class="col-md-3"><input type="text" name="banner_link[]" value="'.$banner['link'].'" class="form-control" placeholder="Liên kết"></div>';
                        echo '<div class="col-md-2">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="banner_aliasname[]" value="'.$banner['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="banner_filename[]" value="'.$banner['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoabanner_hub.html?filename='.$banner['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-check-circle-o"></i> Lưu</button>
            </div>
        </div>
    </div>
</div>
</form>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script type="text/javascript" src="assets/js/hub.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        upload_banner();upload_logo();delete_file();
        <?php if(isset($msg) && $msg) : ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        App.init();
    });
</script>