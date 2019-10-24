<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    $sql_res        =   "SELECT `restaurant_name` FROM `restaurant` WHERE restaurant_id = '".$_POST['res_id']."'";
    $db_res         =   $MsDb->Query($sql_res);
    $res_res        =   $MsDb->Result($db_res);
?>
<input type="hidden" id="res_id" name="res_id" value="<?php echo $_POST['res_id']; ?>">
<div class="alert alert-light border border-secoundary text-dark mt-3 mb-0 h3" role="alert">
    <i class="fas fa-store"></i> <?php echo $res_res['restaurant_name']; ?>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-12">
        <div class="card mt-3">
            <div class="card-body">
                <p>
                    <a href="javascript:func_menu_conf_restaurant('restaurant_data')">
                        <i class="fas fa-database"></i> ข้อมูลร้านอาหาร
                    </a>
                </p>
                <p>
                    <a href="javascript:func_menu_conf_restaurant('restaurant_img')">
                        <i class="fas fa-images"></i> รูปภาพ
                    </a>
                </p>
                <p>
                    <a href="javascript:func_menu_conf_restaurant('restaurant_menu')">
                        <i class="fas fa-bars"></i> เมนูอาหาร
                    </a>
                </p>
                <p>
                    <a href="javascript:func_menu_conf_restaurant('restaurant_promotion')">
                        <i class="fas fa-percent"></i> โปรโมชั่น
                    </a>
                </p>
                <p>
                    <a href="javascript:func_menu_conf_restaurant('restaurant_review')">
                        <i class="fas fa-comments"></i> รีวิว
                    </a>
                </p>
                <p>
                    <a href="javascript:func_menu_conf_restaurant('restaurant_rating')">
                        <i class="fas fa-star"></i> เรตติ้ง
                    </a>
                </p>
                <p>
                    <a href="javascript:func_menu_conf_restaurant('restaurant_config')">
                        <i class="fas fa-cog"></i> ตั้งค่าขั้นสูง
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-12">
        <div class="mt-3 mb-3" id="show_config">

        </div>
    </div>
</div>