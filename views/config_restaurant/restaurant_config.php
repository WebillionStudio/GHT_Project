<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    $sql_config =   "SELECT restaurant_show FROM restaurant WHERE restaurant_id = '".$_POST['res_id']."'";
    $db_config  =   $MsDb->Query($sql_config);
    $res_config =   $MsDb->Result($db_config);
?>
<div class="alert alert-secondary mb-3 h4" role="alert">
    <i class="fas fa-cog"></i> ตั้งค่าขั้นสูง
</div>
<div class="card mb-3 border border-dark">
    <div class="card-body table-info">
        <p>
            สถานะการแสดงร้านอาหาร
            <label class="switch">
                <input type="checkbox" onclick="change_show_restaurant(this)" data-id="<?php echo $_POST['res_id']; ?>" <?php if($res_config['restaurant_show']=='1'){ echo "checked";} ?>>
                <span class="slider round"></span>
            </label>
        </p>
        <a href="javascript:del_res_btn()" class="text-danger"><i class="fas fa-trash"></i> ลบร้านอาหาร</a>
    </div>
</div>