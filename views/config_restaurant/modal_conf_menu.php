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
$sql_conf_menu      =   "SELECT * FROM `restaurant_menu` WHERE `Menu_id` = '" . $_POST['Menu_id'] . "'";
$db_conf_menu       =   $MsDb->Query($sql_conf_menu);
$res_conf_menu      =   $MsDb->Result($db_conf_menu);
?>
<div class="modal-header">
    <h5 class="modal-title"><i class="fas fa-wrench"></i> แก้ไขเมนู</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="Menu_Name"><b>ชื่อเมนู</b></label>
        <input type="text" class="form-control" name="Menu_Name_conf" id="Menu_Name_conf" value="<?php echo $res_conf_menu['Menu_name']; ?>">
    </div>
    <div class="form-group">
        <label for="Menu_Price"><b>ราคาเมนู</b></label>
        <input type="text" class="form-control" name="Menu_Price_conf" id="Menu_Price_conf" value="<?php echo $res_conf_menu['Menu_price']; ?>">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary float-right" onclick="save_menu_btn(this)" data-id="<?php echo $res_conf_menu['Menu_id']; ?>">
        <i class="fas fa-plus-square"></i> บันทึก
    </button>
</div>
