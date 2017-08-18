<?php
require_once('header_none.php');
$danhmuctintuc = new DanhMucTinTuc();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';

$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$language = isset($_POST['language']) ? $_POST['language'] : '';
$orders = isset($_POST['orders']) ? $_POST['orders'] : 0;

if(!$id) $id = new MongoId();
$path = 'tintuc.html?id='.$id;
$danhmuctintuc->id = $id;
$danhmuctintuc->ten = $ten;
$danhmuctintuc->orders = $orders;
$danhmuctintuc->language = $language;
$danhmuctintuc->path = $path;

if($act == 'edit'){
	if($danhmuctintuc->edit()) {
		if($url) transfers_to($url);
		else transfers_to('danhmuctintuc.html?msg=Chỉnh sửa thành công!');
	}
} else {
	if($danhmuctintuc->insert()){
		if($url) transfers_to($url);
		else transfers_to('danhmuctintuc.html?msg=Thêm nơi thành công!');
	}
}
?>
