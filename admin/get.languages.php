<?php
require_once('header_none.php');
$languages = new Languages();$gridfs = new GridFS();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$languages->id = $id; $lang = $languages->get_one();
if($id && $act == 'del'){
	$lang = $languages->get_one();
	if($lang['icon']){
		$gridfs->id = $lang['icon']; $gridfs->delete();
	}
	if($languages->delete()) transfers_to('languages.html?msg=Xóa thành công.');
}
if($act == 'edit'){
	$arr = array(
		'id' => strval($lang['_id']),
		'act' => $act,
		'code' => $lang['code'],
		'name' => $lang['name'],
		'icon' => strval($lang['icon']),
		'macdinh' => '<input type="checkbox" data-render="switchery" data-theme="default" name="default" value="1" '.($lang['default'] == 1 ? 'checked' : '').'/>'
	);

	echo json_encode($arr);
}
?>