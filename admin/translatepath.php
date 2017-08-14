<?php
require_once('header.php');
$languages = new Languages();
$translatepath = new TranslatePath();
$languages_list = $languages->get_all_list();
$translatepath_list = $translatepath->get_all_list();
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-list"></i> Tranlates Path List</h4>
        </div>
        <div class="panel-body">
        	<a href="themtranslatepath.html" class="btn btn-primary m-10 themtranslatepath"><i class="fa fa-plus"></i> Thêm mới</a>
        	<table id="data-table" class="table table-striped table-bordered table-hovered">
        	<thead>
                    <tr>
                        <th width="15">STT</th>
                    <?php
                    if($languages_list){
                    	foreach($languages_list as $lang){
                    		echo '<th style="text-align:center">';
                    		if($lang['icon']){
                    			echo '<img src="image.html?id='.$lang['icon'].'" height="32" width="32" />';
                    		} else {
                    			echo $lang['code'];
                    		}
                    		echo '</th>';
                    	}
                    }
                    ?>
                    <th width="30">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($translatepath_list){
                	$i = 1;
                	foreach($translatepath_list as $path){
	                	echo '<tr>';
	                	echo '<td>'.$i.'</td>';
	                	if($languages_list){
	                		foreach($languages_list as $lang){
	                			echo '<td>'.$path['path'][$lang['code']].'</td>';
	                		}
	                	}
	                	echo '<td class="text-center">';
	                	echo '<a href="themtranslatepath.html?id='.$path['_id'].'&act=edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;';
	                	echo '<a href="themtranslatepath.html?id='.$path['_id'].'&act=del" onclick="return confirm(\'Chắc chắn xóa?\');"><i class="fa fa-trash"></i></a>';
	                	echo '</td>';
	                	echo '</tr>';$i++;
	                
	                }
                }
                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/table-manage-default.demo.min.js"></script>
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
        App.init();TableManageDefault.init();
    });
</script>