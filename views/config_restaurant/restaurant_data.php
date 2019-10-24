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
    $sql_config     =   "SELECT `restaurant_name`,`restaurant_description`,`restaurant_type`,`restaurant_email`,`restaurant_tel`,`restaurant_facebook`,`restaurant_ig`,`restaurant_website`,`restaurant_time_open`,`restaurant_time_close`,`restaurant_date_open`,`restaurant_area`,`restaurant_address` FROM `restaurant` WHERE restaurant_id = '" . $_POST['res_id'] . "'";
    $db_config      =   $MsDb->Query($sql_config);
    $res_config     =   $MsDb->Result($db_config);

    $sql_area = "SELECT area.area_id, area.area_name FROM area";
    $db_area   =   $MsDb->Query($sql_area);

    $sql_type = "SELECT * FROM `restaurant_type`";
    $db_type   =   $MsDb->Query($sql_type);
?>
<div class="alert alert-secondary mb-3 h4" role="alert">
    <i class="fas fa-database"></i> จัดการข้อมูลร้านอาหาร
</div>
<form id="form_res_data">
    <div class="card mb-3 border border-dark">
        <div class="card-header h4">
            <u><b>ข้อมูลร้านอาหาร</b></u>
        </div>
        <div class="card-body table-info">
            <div class="form-group">
                <label for="restaurant_name"><b>ชื่อร้านอาหาร</b></label>
                <input type="text" class="form-control" name="restaurant_name" id="restaurant_name" aria-describedby="helpId" placeholder="" value="<?php echo $res_config['restaurant_name']; ?>">
            </div>
            <div class="form-group">
                <label for="restaurant_description"><b>อธิบายร้านอาหาร</b></label>
                <textarea class="form-control" name="restaurant_description" id="restaurant_description" rows="3"><?php echo $res_config['restaurant_description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="sel_res_type"><b>ประเภทอาหาร</b></label>
                <select class="form-control" name="sel_res_type" id="sel_res_type">
                    <option value="">---ทุกประเภท---</option>
                    <?php while ($res_type   =   $MsDb->Result($db_type)) { ?>
                        <option value="<?php echo $res_type['res_type_id']; ?>" <?php if ($res_config['restaurant_type'] == $res_type['res_type_id']) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $res_type['res_type_name']; ?></option>
                    <?php } ?>
                </select>
            </div> 
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="timepicker"><b>เวลาเปิด</b></label>
                        <input type="text" class="form-control" id="timepicker" name="restaurant_time_open" value="<?php echo substr($res_config['restaurant_time_open'],0,2).':'.substr($res_config['restaurant_time_open'],2,2); ?>" readonly/>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="timepicker2"><b>เวลาปิด</b></label>
                        <input type="text" class="form-control" id="timepicker2" name="restaurant_time_close" value="<?php echo substr($res_config['restaurant_time_close'],0,2).':'.substr($res_config['restaurant_time_close'],2,2); ?>" readonly/>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card mb-3 border border-dark">
        <div class="card-header h4">
            <u><b>ข้อมูลที่อยู่ร้านอาหาร</b></u>
        </div>
        <div class="card-body table-success">
            <div class="form-group">
                <label for="sel_area"><b>ย่าน</b></label>
                <select class="form-control" name="sel_area" id="sel_area">
                    <?php while ($res_area   =   $MsDb->Result($db_area)) { ?>
                        <option value="<?php echo $res_area['area_id']; ?>" <?php if ($res_config['restaurant_area'] == $res_area['area_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $res_area['area_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="restaurant_address"><b>อธิบายร้านอาหาร</b></label>
                <textarea class="form-control" name="restaurant_address" id="restaurant_address" rows="3"><?php echo $res_config['restaurant_address']; ?></textarea>
            </div>
        </div>
    </div>
    <div class="card mb-3 border border-dark">
        <div class="card-header h4">
            <u><b>ข้อมูลติดต่อร้านอาหาร</b></u>
        </div>
        <div class="card-body table-warning">
            <div class="form-group">
                <label for="restaurant_email"><b>อีเมล</b></label>
                <input type="text" class="form-control" name="restaurant_email" id="restaurant_email" aria-describedby="helpId" placeholder="" value="<?php echo $res_config['restaurant_email']; ?>">
            </div>
            <div class="form-group">
                <label for="restaurant_tel"><b>เบอร์โทร</b></label>
                <input type="text" class="form-control" name="restaurant_tel" id="restaurant_tel" aria-describedby="helpId" placeholder="" value="<?php echo $res_config['restaurant_tel']; ?>">
            </div>
            <div class="form-group">
                <label for="restaurant_facebook"><b>Facebook</b></label>
                <input type="text" class="form-control" name="restaurant_facebook" id="restaurant_facebook" aria-describedby="helpId" placeholder="" value="<?php echo $res_config['restaurant_facebook']; ?>">
            </div>
            <div class="form-group">
                <label for="restaurant_ig"><b>Instagram</b></label>
                <input type="text" class="form-control" name="restaurant_ig" id="restaurant_ig" aria-describedby="helpId" placeholder="" value="<?php echo $res_config['restaurant_ig']; ?>">
            </div>
            <div class="form-group">
                <label for="restaurant_website"><b>เว็บไซด์</b></label>
                <input type="text" class="form-control" name="restaurant_website" id="restaurant_website" aria-describedby="helpId" placeholder="" value="<?php echo $res_config['restaurant_website']; ?>">
            </div>
        </div>
    </div>
    <div class="alert alert-secondary text-right border border-dark" role="alert">
        <button type="reset" class="btn btn-warning"><i class="fas fa-reply"></i> รีเซ็ต</button>
        <button type="button" class="btn btn-success" data-id="<?php echo $_POST['res_id']; ?>" onclick="func_save_conf_res_data(this)"><i class="fas fa-save"></i> บันทึก</button>
    </div>
</form>
<script>
    $('#timepicker').timepicker({
        uiLibrary: 'bootstrap4',
        mode: '24hr'
    });
    $('#timepicker2').timepicker({
        uiLibrary: 'bootstrap4',
        mode: '24hr'
    });
</script>
