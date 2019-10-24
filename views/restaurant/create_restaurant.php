<?php session_start(); //Session Start
date_default_timezone_set('Asia/Bangkok');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // Noi Cache
require_once '../../config/wbsclass.php'; // import function
$MsDb = new MSClass(); // Connenct MySql
$sql_area  =   "SELECT area.area_id, area.area_name FROM `area`";
$db_area   =   $MsDb->Query($sql_area);
?>
<div class="modal-header">
    <h5 class="modal-title"><i class="fas fa-plus"></i> สร้างร้านอาหารของฉัน</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="modal_add_res">
    <div class="form-group">
        <label for="restaurant_name"><b>ชื่อร้านอาหาร</b> <b class="text-danger">*จำเป็น*</b></label>
        <input type="text" class="form-control" name="restaurant_name" id="restaurant_name" aria-describedby="helpId" placeholder="ตัวอย่าง :: ร้านป้าเพิ่มอาหารตามส่ง">
    </div>
    <div class="form-group">
        <label for="restaurant_description"><b>คำอธิบาย</b></label>
        <textarea class="form-control" name="restaurant_description" id="restaurant_description" rows="3" placeholder="ตัวอย่าง :: ร้านอาหารตามสั่งในแบบฉบับทันสมัย เปิดพร้อมให้บริการแล้ววันนี้"></textarea>
    </div>
    <hr>
    <div class="form-group">
        <label for="sel_area"><b>ย่านที่ตั้งร้าน</b></label>
        <select class="form-control" name="sel_area" id="sel_area">
            <?php while ($res_area   =   $MsDb->Result($db_area)) { ?>
                <option value="<?php echo $res_area['area_id']; ?>">
                    <?php echo $res_area['area_name']; ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary float-right" onclick="create_res_btn()"><i class="fas fa-plus-square"></i> สร้าง</button>
</div>
