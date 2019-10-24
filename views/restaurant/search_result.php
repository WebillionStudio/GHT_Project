<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql

    $res_area       =   $MsDb->Result($MsDb->Query("SELECT area.area_name FROM `area` WHERE area.area_id = '" . $_POST['area_id'] . "'"));

    $sql    =   "SELECT * FROM `restaurant` WHERE restaurant.restaurant_name LIKE '%" . $_POST['search_text'] . "%' AND restaurant.restaurant_area = '" . $_POST['area_id'] . "' AND restaurant.restaurant_show =   '1'";
    if($_POST['res_type']!="all"){
        $sql    .=  " AND restaurant.restaurant_type =   '".$_POST['res_type']."'";
    }
    $db     =   $MsDb->Query($sql);
    $numr   =   $MsDb->NumRows($db);
?>
<h4 class="text-info">ค้นหาร้านอาหาร ย่าน <b>"<?php echo $res_area['area_name']; ?>"</b></h4>
<?php
    if($numr>0){
        while ($res    =   $MsDb->Result($db)) {
?>
            <div class="card mb-3">
                <div class="card-body">
                <a href="./restaurant.php?id=<?php echo $res['restaurant_id']; ?>"><b class="text-primary"><i class="fas fa-store"></i> <?php echo $res['restaurant_name']; ?></b></a>
                </div>
            </div>
<?php
        }
    }else{
?>
        <div class="alert alert-warning h5 text-center" role="alert">
            <i class="fas fa-exclamation-triangle"></i> ไม่พบร้านร้านอาหารที่ค้นหา
        </div>
<?php
    }
?>
