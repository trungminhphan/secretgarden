<?php
require_once('header_none.php');
$menu = new Menu();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$id_parent = isset($_POST['id_parent']) ? $_POST['id_parent'] : '';
$link = isset($_POST['link']) ? $_POST['link'] : '';
$mota = isset($_POST['mota']) ? $_POST['mota'] : '';
$language = isset($_POST['language']) ? $_POST['language'] : '';
$orders = isset($_POST['orders']) ? $_POST['orders'] : '';

$menu->ten = $ten;
$menu->id_parent = $id_parent;
$menu->link = $link;
$menu->mota = $mota;
$menu->orders = $orders;
$menu->language = $language;

$l = explode("?", $url); $url = $l[0];
if($act == 'edit'){
	$menu->id = $id;
	if($menu->edit()) {
		if($url) transfers_to($url . '?msg=Chỉnh sửa thành công.');
		else transfers_to('menu.htmlmsg=Chỉnh sửa thành công!');
	}
} else if($act == 'del'){
	$menu->id = $id;
	if($menu->check_dmmenu($id)){
		transfers_to('menu.html?msg=Không thể xoá, ràng buộc dữ liệu.');
	} else {
		if($menu->delete()){
			if($url) transfers_to($url . '?msg=Xoá thành công.');
			else transfers_to('menu.html?msg=Xoá thành công!');
		}
	}
} else {
	if($menu->insert()){
		if($url) transfers_to($url . '?msg=Thêm thành công.');
		else transfers_to('menu.html?msg=Thêm mới thành công!');
	}
}
?>