<?php
	//DEFINE QUYEN CHO TUNG NGUOI
	define("ADMIN", 1);
	define("MANAGER", 2);
	define("UPDATER", 4);

	
	$uploads_folder = 'uploads/';
	$files_extension = array('pdf', 'zip', 'rar', 'doc', 'docx', 'xls', 'png', 'gif', 'jpg', 'jpeg', 'bmp', 'rtf');
	$images_extension = array('png', 'gif', 'jpg', 'jpeg', 'bmp');
	$valid_formats = array("jpg", "png", "gif", "zip", "bmp", "doc", "docx", "pdf", "xls", "xlsx", "ppt", "pptx", 'zip', 'rar');
	$max_file_size = 50*1024*1024*1024; //50MB
	
	$arr_gioitinh = array('M' => 'Nam', 'F' => 'Nữ');
	$arr_dungdenngay = array('D' => 'Ngày', 'M' => 'Tháng', 'Y' => 'Năm');
	$arr_tinhtrang = array(
		0 => 'Đang chờ duyệt',
		1 => 'Đã duyệt',
		2 => 'Không duyệt'
	);
?>