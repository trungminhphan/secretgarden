<?php
require_once('header.php');
$translatevar = new TranslateVar();
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
            <h4 class="panel-title"><i class="fa fa-list"></i> Tranlates Vars List</h4>
        </div>
        <div class="panel-body">
        <table id="data-table" class="table table-striped table-bordered table-hovered">
        	<thead>
        		<tr>
        			<th>STT</th>
        			<th>VARS</th>
        			<th>ACTIONS</th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        	if($arr_vars){
        		$i=1;
        		foreach($arr_vars as $var){
        			if(!$translatevar->check_exists($var)){
        				$action = 'ADD NEW';
        				$translatevar->var = $var;$translatevar->translate = array();$translatevar->insert();
        			} else {
        				$action = 'OLD TEXT';
        			}
        			echo '<tr>';
        			echo '<td>'.$i.'</td>';
        			echo '<td>'.$var.'</td>';
        			echo '<td>'.$action.'</td>';
        			echo '</tr>'; $i++;
        		}
        	}
        	?>
        	</tbody>
       	</table>
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