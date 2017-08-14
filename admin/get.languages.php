<?php
require_once('header_none.php');
$languages = new Languages();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$languages->id = $id; $lang = $languages->get_one();

if($act == 'edit'){
	$arr = array(
		'id' => strval($lang['_id']),
		'act' => $act,
		'code' => $lang['code'],
		'name' => $lang['name'],
		'macdinh' => '<input type="checkbox" data-render="switchery" data-theme="default" name="default" value="1" '.($lang['default'] == 1 ? 'checked' : '').'/>'
	);

	echo json_encode($arr);
}
?>