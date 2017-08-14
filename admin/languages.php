<?php 
require_once('header.php');
check_permis($users->is_admin());
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$languages = new Languages();
$languages_list = $languages->get_all_list();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> Danh sách Ngôn ngữ</h4>
            </div>
            <div class="panel-body">
            <a href="#modal-languages" data-toggle="modal" class="btn btn-primary m-10 themlanguages"><i class="fa fa-plus"></i> Thêm mới</a>
            <table id="data-table" class="table table-striped table-bordered table-hovered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th class="text-center">Icon</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Ngôn ngữ</th>
                        <th class="text-center">Mặc định</th>
                        <th class="text-center"><i class="fa fa-trash"></i></th>
                        <th class="text-center"><i class="fa fa-pencil"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($languages_list){
                    $i=1;
                    foreach($languages_list as $lang){
                        if($lang['default'] == 1) $default = '<i class="fa fa-check-circle-o text-primary"></i>';
                        else $default = '';
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td class="text-center">'.($lang['icon'] ? '<img src="image.html?id='.$lang['icon'].'" width="32" height="32" />' : '').'</td>';
                        echo '<td class="text-center">'.$lang['code'].'</td>';
                        echo '<td>'.$lang['name'].'</td>';
                        echo '<td class="text-center">'.$default.'</td>';
                        echo '<td class="text-center"><a href="get.languages.html?id='.$lang['_id'].'&act=edit#modal-languages" data-toggle="modal" class="sualanguages"><i class="fa fa-pencil"></a></td>';
                        echo '<td class="text-center"><a href="get.languages.html?id='.$lang['_id'].'&act=del" onclick="return confirm(\'Chắc chắn xóa?\');"><i class="fa fa-trash"></a></td>';
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
<div class="modal fade" id="modal-languages">
<form action="post.languages.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="languagesform" enctype="multipart/form-data">
	<input type="hidden" name="id" id="id" />
    <input type="hidden" name="act" id="act" />
    <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Thêm ngôn ngữ</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Code</label>
                    <div class="col-md-9">
                        
                        <input type="text" name="code" id="code" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tên ngôn ngữ</label>
                    <div class="col-md-9">
                        <input type="text" name="name" id="name" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Mặc định</label>
                     <div class="col-md-3" id="macdinh">
                        <input type="checkbox" data-render="switchery" data-theme="default" name="default" id="default" value="1" checked/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Icon:</label>
                    <div class="col-md-6">
                        <span class="btn btn-success fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Chọn hình ảnh...</span>
                            <input type="file" name="icon" id="icon" accept="*/image">
                        </span>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" name="old_icon" id="old_icon" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/table-manage-default.demo.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/js/form-slider-switcher.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
    	 $(".themlanguages").click(function(){
            $("#id").val("");$("#act").val("");
            $("#macdinh").html('<input type="checkbox" data-render="switchery" data-theme="default" name="default" value="1" checked/>');
            FormSliderSwitcher.init();
        });
        $(".sualanguages").click(function(){
            var _this = $(this); var _link = $(this).attr("href");
            $.getJSON(_link, function(data){
                $("#id").val(data.id);$("#act").val(data.act);
                $("#code").val(data.code);$("#name").val(data.name);
                $("#macdinh").html(data.macdinh);FormSliderSwitcher.init();
            });
        });
        App.init();TableManageDefault.init();
    });
</script>