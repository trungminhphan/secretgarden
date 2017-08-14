<?php
require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$languages = new Languages(); $translatepath = new TranslatePath();
if($id && $act == 'del'){
	$translatepath->id = $id;
	if($translatepath->delete()) transfers_to('translatepath.html?msg=Xóa thành công!');
}
$languages_list = $languages->get_all_list();
$path = ''; $arr_path = array();
if(isset($_POST['submit'])){
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$act = isset($_POST['act']) ? $_POST['act'] : '';
	$path = isset($_POST['path']) ? $_POST['path'] : '';
	$code = isset($_POST['code']) ? $_POST['code'] : '';
	if($path){
		foreach ($path as $key => $value) {
			$arr_path[$code[$key]] = $value;
			$query = array('path.' . $code[$key] => $value);
			if($translatepath->check_path($query)){
				$msg = 'Có liên kết đã tồn tại...';
			}
		}
	}
	$translatepath->path = $arr_path;
	if($id && $act == 'edit'){
		$translatepath->id = $id;
		if($translatepath->edit()) transfers_to('translatepath.html?msg=Chỉnh sửa thành công.');
	} else {
		if(!$msg){
			if($translatepath->insert()) transfers_to('translatepath.html?msg=Thêm thành công.');
		}
	}
}
if($id && $act == 'edit'){
	$translatepath->id = $id; $p = $translatepath->get_one(); $arr_path = $p['path'];
}
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" name="translatepathform" >
	<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ''; ?>"/>
	<input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>" />
	<input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-list"></i> Tranlates Path Info</h4>
        </div>
        <div class="panel-body">
    		<?php if($languages_list): ?>
    		<?php $i = 0; foreach($languages_list as $lang): ?>
    		<div class="form-group">
                <label class="col-md-3 control-label">
                <?php
                	if($lang['icon']){
            			echo '<img src="image.html?id='.$lang['icon'].'" height="32" width="32" />';
            		} else { echo $lang['code']; }
                ?>
                </label>
                <div class="col-md-9">
                	<input type="hidden" name="code[]" value="<?php echo $lang['code']; ?>">
                    <input type="text" name="path[]" class="form-control" data-parsley-required="true" value="<?php echo $arr_path ? $arr_path[$lang['code']] : ''; ?>"/>
                </div>
            </div>
        	<?php $i++; endforeach; ?>
        	<?php endif; ?>
        </div>
    	<div class="panel-footer">
            <a href="translatepath.html" class="btn btn-white"><i class="fa fa-mail-reply-all"></i> Trở về</a>
            <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fa fa-save"></i> Lưu</button>
        </div>
    </div>
</div>
</form>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
    	<?php if(isset($msg) && $msg): ?>
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