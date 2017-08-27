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
        $arr_banner = sort_array_1($arr_banner, 'orders', SORT_ASC);
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
        $arr_logo = sort_array_1($arr_logo, 'orders', SORT_ASC);

        $arr_icon = array();
        $icon_aliasname = isset($_POST['icon_aliasname']) ? $_POST['icon_aliasname'] : '';
        $icon_filename = isset($_POST['icon_filename']) ? $_POST['icon_filename'] : '';
        $icon_link = isset($_POST['icon_link']) ? $_POST['icon_link'] : '';
        $icon_name = isset($_POST['icon_name']) ? $_POST['icon_name'] : '';
        $icon_language = isset($_POST['icon_language']) ? $_POST['icon_language'] : '';
        $icon_orders = isset($_POST['icon_orders']) ? $_POST['icon_orders'] : '';
        if($icon_aliasname){
            foreach ($icon_aliasname as $key => $value) {
                array_push($arr_icon, array('filename' => $icon_filename[$key], 'aliasname' => $value,'name' => $icon_name[$key], 'link' => $icon_link[$key], 'orders' => $icon_orders[$key],'language' => $icon_language[$key]));
            }
        }
        $arr_icon = sort_array_1($arr_icon, 'orders', SORT_ASC);
        $arr_background = array();
        $background_aliasname = isset($_POST['background_aliasname']) ? $_POST['background_aliasname'] : '';
        $background_filename = isset($_POST['background_filename']) ? $_POST['background_filename'] : '';
        $background_link = isset($_POST['background_link']) ? $_POST['background_link'] : '';
        $background_name = isset($_POST['background_name']) ? $_POST['background_name'] : '';
        $background_language = isset($_POST['background_language']) ? $_POST['background_language'] : '';
        $background_orders = isset($_POST['background_orders']) ? $_POST['background_orders'] : '';
        if($background_aliasname){
            foreach ($background_aliasname as $key => $value) {
                array_push($arr_background, array('filename' => $background_filename[$key], 'aliasname' => $value,'name' => $background_name[$key], 'link' => $background_link[$key], 'orders' => $background_orders[$key],'language' => $background_language[$key]));
            }
        }
        $arr_background = sort_array_1($arr_background, 'orders', SORT_ASC);
        $hub->logo = $arr_logo;
        $hub->banner = $arr_banner;
        $hub->icon = $arr_icon;
        $hub->background = $arr_background;
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
                <h4 class="panel-title"><i class="fa fa-gears"></i> Banner</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh LOGO</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình Banner tốt nhất (477px x 140px)...</span>
                            <input type="file" name="logo_files[]" multiple class="logo_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="logo_list">
                <?php
                if(isset($t['logo']) && $t['logo']){
                    foreach($t['logo'] as $l){
                        $orders = isset($l['orders']) ? $l['orders'] : 0;
                        $name = isset($l['name']) ? $l['name'] : '';
                        $language = isset($l['language']) ? $l['language'] : '';
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
                        echo '<div class="col-md-4"><input type="text" name="logo_link[]" value="'.$l['link'].'" class="form-control" placeholder="Liên kết"></div>';
                        echo '<div class="col-md-3">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="logo_aliasname[]" value="'.$l['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="logo_filename[]" value="'.$l['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoabanner_hub.html?filename='.$l['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
            	<div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh BANNER (Slider)</label>
                    <div class="col-md-3">
						<span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình Banner tốt nhất (1510px x 565px)...</span>
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
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh ICON</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình icon tốt nhất (305px x 305x)...</span>
                            <input type="file" name="icon_files[]" multiple class="icon_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="icon_list">
                <?php
                if(isset($t['icon']) && $t['icon']){
                    foreach($t['icon'] as $ic){
                        $orders = isset($ic['orders']) ? $ic['orders'] : 0;
                        $name = isset($ic['name']) ? $ic['name'] : '';
                        $address = isset($ic['address']) ? $ic['address'] : '';
                        $language = isset($ic['language']) ? $ic['language'] : '';
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-1">
                            <input type="number" class="form-control" name="icon_orders[]" value="'.$orders.'" />
                          </div>';
                        echo '<div class="col-md-1">';
                        if($language_list){
                            echo '<select name="icon_language[]" class="form-control">';
                            foreach($language_list as $lang){
                                echo '<option value="'.$lang['code'].'"'.($lang['code']==$language ? ' selected' : '').'>'.$lang['code'].'</option>';
                            }
                            echo '</select>';
                        }
                        echo '</div>';
                        echo '<div class="col-md-3"><input type="text" name="icon_name[]" class="form-control" placeholder="Tên" value="'.$name.'"></div>';
                        echo '<div class="col-md-4"><input type="text" name="icon_link[]" value="'.$ic['link'].'" class="form-control" placeholder="Liên kết"></div>';
                        echo '<div class="col-md-3">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="icon_aliasname[]" value="'.$ic['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="icon_filename[]" value="'.$ic['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoabanner_hub.html?filename='.$ic['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh BACKGROUND</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình background tốt nhất (1600px x 1200x)...</span>
                            <input type="file" name="background_files[]" multiple class="background_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="background_list">
                <?php
                if(isset($t['background']) && $t['background']){
                    foreach($t['background'] as $background){
                        $orders = isset($background['orders']) ? $background['orders'] : 0;
                        $name = isset($background['name']) ? $background['name'] : '';
                        $address = isset($background['address']) ? $background['address'] : '';
                        $language = isset($background['language']) ? $background['language'] : '';
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-1">
                            <input type="number" class="form-control" name="background_orders[]" value="'.$orders.'" />
                          </div>';
                        echo '<div class="col-md-1">';
                        if($language_list){
                            echo '<select name="background_language[]" class="form-control">';
                            foreach($language_list as $lang){
                                echo '<option value="'.$lang['code'].'"'.($lang['code']==$language ? ' selected' : '').'>'.$lang['code'].'</option>';
                            }
                            echo '</select>';
                        }
                        echo '</div>';
                        echo '<div class="col-md-3"><input type="text" name="background_name[]" class="form-control" placeholder="Tên" value="'.$name.'"></div>';
                        echo '<div class="col-md-4"><input type="text" name="background_link[]" value="'.$background['link'].'" class="form-control" placeholder="Liên kết"></div>';
                        echo '<div class="col-md-3">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="background_aliasname[]" value="'.$background['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="background_filename[]" value="'.$background['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoabanner_hub.html?filename='.$background['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
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
        upload_banner();upload_logo();upload_icon();upload_background();delete_file();
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