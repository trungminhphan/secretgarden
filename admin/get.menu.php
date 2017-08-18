<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$menu = new Menu();
$menu->id = $id; $dv = $menu->get_one();

if($act == 'del'){
	$arr = array(
		'id' => $id,
		'act' => $act
	);
	echo json_encode($arr);
}

if($act == 'edit'){
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $dv['ten'],
		'id_parent' => strval($dv['id_parent']),
		'link' => $dv['link'],
		'mota' => $dv['mota'],
		'language' => $dv['language'],
		'orders' => $dv['orders']
	);
	echo json_encode($arr);
}

?>