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
    $sql_list   =   "SELECT restaurant.restaurant_id, restaurant.restaurant_name FROM `restaurant` WHERE restaurant.restaurant_created = '".$_SESSION['User_id']."'";
    $db_list    =   $MsDb->Query($sql_list);
    $num_list   =   $MsDb->NumRows($db_list);
?>
<div class="card mt-3">
    <div class="card-body">
<?php
    if($num_list==0){
?>
        <div class="alert alert-warning text-warning text-center alert-res mb-0" role="alert">
            ไม่มีรายชื่อร้านอาหาร
        </div>
        <?php
    }else{
        while($res_list    =   $MsDb->Result($db_list)){
?>
        <div class="alert alert-info text-info h3 " role="alert">
            <a href="restaurant.php?id=<?php echo $res_list['restaurant_id']; ?>" data-toggle="tooltip"
                data-placement="top" title="คลิ๊กเพื่อดูข้อมูลร้าน"><i class="fas fa-store"></i>
                <?php echo $res_list['restaurant_name']; ?></a>
            <a class="float-right"
                href="javascript:func_conf_restaurant('<?php echo $res_list['restaurant_id']; ?>')"><i
                    class="fas fa-cog" data-toggle="tooltip" data-placement="top" title="คลิ๊กเพื่อจัดการร้าน"></i></a>
        </div>
        <?php
        }
    }
?>
    </div>
</div>
<script>
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
