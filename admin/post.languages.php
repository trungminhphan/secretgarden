<?php
require_once('header_none.php');
$languges = new Languages();
if(isset($_POST['submit'])){
	$id = isset($_POST['id']) ? $_POST['id'] : '';
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    $url = isset($_POST['url']) ? $_POST['url'] : '';

    $icon_file = isset($_FILES["icon"]["name"]) ? strtolower($_FILES["icon"]["name"]) : '';
    $icon_size = isset($_FILES["icon"]["size"]) ? $_FILES["icon"]["size"] : 0;
    $icon_type = isset($_FILES["icon"]["type"]) ? $_FILES["icon"]["type"]  : '';
    $icon_tmp = isset($_FILES['icon']['tmp_name']) ? $_FILES['icon']['tmp_name'] : '';
    $old_icon = isset($_POST['old_icon']) ? $_POST['old_icon'] : '';
    $temp = explode(".", $icon_file);
    if($icon_file){
        $ext = end($temp);
        if($icon_size < $max_file_size && in_array($ext, $images_extension)){
            $gridfs->filename = $icon_file;
            $gridfs->filetype = $icon_type;
            $gridfs->tmpfilepath = $icon_tmp;
            $gridfs->caption = $icon_file;
        } else {
            $msg = 'Dung lượng hình ảnh quá lớn hoặc không đúng định dạng';
        }
    } else {
        $icon = $old_icon;
    }
    $code = isset($_POST['code']) ? $_POST['code'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $default = isset($_POST['default']) ? $_POST['default'] : '';

    $languges->code = $code;
    $languges->name = $name;
    $languges->icon = $icon;
    $languges->default = $default;

    if($languges->insert()){
    	if($url) transfers_to($url);
    	else transfers_to('languages.html');
    }
}
?>