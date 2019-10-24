<?php session_start(); //Session Start
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    $sql_menu   =   "SELECT Menu_id,Menu_name,Menu_price FROM `restaurant_menu` where restaurant_id = '".$_POST['res_id']."'";
    $db_menu    =   $MsDb->Query($sql_menu);
?>
<input type="hidden" name="res_id" id="res_id" value="<?php echo $_POST['res_id']; ?>">
<div class="alert alert-secondary mb-3 h4" role="alert">
    <b><i class="fas fa-bars"></i> จัดการเมนูอาหาร</b>
</div>
<div class="alert alert-success text-center" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_create_menu">
    <h4 class="mb-0" style="cursor:pointer"><i class="fas fa-plus"></i> เพิ่มเมนูอาหาร</h4>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="text-center table-primary">
            <tr>
                <th>ชื่อเมนู</th>
                <th>ราคา</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody class="table-primary">
        <?php while($res_menu   =   $MsDb->Result($db_menu)){ ?>
            <tr>
                <td class="text-center"><?php echo $res_menu['Menu_name']; ?></td>
                <td class="text-center"><?php echo $res_menu['Menu_price']; ?></td>
                <td class="text-center">
                    <button class="btn btn-warning" data-id="<?php echo $res_menu['Menu_id']; ?>" onclick="func_conf_menu(this)"><i class="fas fa-wrench"></i></button>
                    <button class="btn btn-danger" data-id="<?php echo $res_menu['Menu_id']; ?>" onclick="func_del_menu(this)"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal_create_menu" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus"></i> เพิ่มเมนูอาหาร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Menu_Name"><b>ชื่อเมนู</b></label>
                    <input type="text" class="form-control" name="Menu_Name" id="Menu_Name">
                </div>
                <div class="form-group">
                    <label for="Menu_Price"><b>ราคาเมนู</b></label>
                    <input type="text" class="form-control" name="Menu_Price" id="Menu_Price">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary float-right" onclick="create_menu_btn()">
                    <i class="fas fa-plus-square"></i> เพิ่ม
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_config_menu" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="load_conf_menu">

        </div>
    </div>
</div>
