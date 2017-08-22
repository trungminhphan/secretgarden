<?php
require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

$languages = new Languages();
$translatevar = new TranslateVar();
$languages_list = $languages->get_all_list();
$arr_translate = array();
if($id && $act == 'del'){
	$translatevar->id = $id;
	if($translatevar->delete()) transfers_to('translatevar.html?msg=Xóa thành công!');
}
if(isset($_POST['submit'])){
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$act = isset($_POST['act']) ? $_POST['act'] : '';
	$translate = isset($_POST['translate']) ? $_POST['translate'] : '';
	$var_code = isset($_POST['var_code']) ? $_POST['var_code'] : '';
	$code = isset($_POST['code']) ? $_POST['code'] : '';

	if($translate){
		foreach ($translate as $key => $value) {
			$arr_translate[$code[$key]] = $value;
		}
	}
	$translatevar->id = $id;
	$translatevar->var = $var_code;
	$translatevar->translate = $arr_translate;
	
	if($translatevar->edit()) transfers_to('translatevar.html?msg=Chỉnh sửa thành công.&var='.$var_code.'&submit=OK');
}
if($id && $act == 'edit'){
	$translatevar->id = $id; $var = $translatevar->get_one();
}
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" name="translatepathform" >
	<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ''; ?>"/>
	<input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>" />
	<input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
	<input type="hidden" name="var_code" id="var_code" value="<?php echo $var['var']; ?>" />
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-list"></i> Variables translate Info</h4>
        </div>
        <div class="panel-body">
        	<h3 class="text-center"><?php echo $var['var']; ?></h3>
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
                    <textarea name="translate[]" class="form-control" data-parsley-required="true"><?php echo isset($var['translate'][$lang['code']]) ? $var['translate'][$lang['code']] : ''; ?></textarea>
                    
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