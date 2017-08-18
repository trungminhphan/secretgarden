<?php
require_once('header.php');
$languages = new Languages();
$translatevar = new TranslateVar();
$languages_list = $languages->get_all_list();
$var = isset($_GET['var']) ? $_GET['var'] : '';
$translatevar_list = $translatevar->get_list_condition(array('var' => new MongoRegex('/'.$var.'/i')));
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET" class="form-horizontal" data-parsley-validate="true" name="translateform">
<div class="col-md-12">
	<div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-list"></i> Search Vars</h4>
        </div>
        <div class="panel-body">
        <div class="form-group">
                <div class="col-md-9">
                    <input type="text" name="var" id="var" value="<?php echo isset($var) ? $var : ''; ?>" class="form-control" data-parsley-required="true" placeholder="Tìm từ cần dịch" />
                </div>
                <div class="col-md-3">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-list"></i> Tranlates Vars List</h4>
        </div>
        <div class="panel-body">
        	<table id="data-table" class="table table-striped table-bordered table-hovered">
        	<thead>
                    <tr>
                        <th width="15">STT</th>
                        <th>VAR</th>
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
                if($translatevar_list){
                	$i = 1;
                	foreach($translatevar_list as $var){
	                	echo '<tr>';
	                	echo '<td>'.$i.'</td>';
	                	echo '<td>'.$var['var'].'</td>';
	                	if($languages_list){
	                		foreach($languages_list as $lang){
                                if(isset($var['translate'][$lang['code']])){
                                    echo '<td>'.$var['translate'][$lang['code']].'</td>';
                                } else {
                                    echo '<td></td>';
                                }
	                			
	                		}
	                	} 
	                	echo '<td class="text-center">';
	                	echo '<a href="translates.html?id='.$var['_id'].'&act=edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;';
	                	echo '<a href="translates.html?id='.$var['_id'].'&act=del" onclick="return confirm(\'Chắc chắn xóa?\');"><i class="fa fa-trash"></i></a>';
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