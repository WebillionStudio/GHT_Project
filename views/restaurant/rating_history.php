<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    // print_r($_REQUEST);
    $sql_rating_his     =   "SELECT `rating_star`,`rating_user`,`rating_modify`,`user_fname`,`user_lname`  FROM `restaurant_rating`INNER JOIN `user` ON restaurant_rating.rating_user = user.user_id WHERE rating_restaurant = '".$_POST['res_id']."' ORDER BY rating_modify DESC  LIMIT 10";
    $db_rating_his      =   $MsDb->Query($sql_rating_his);
    $numr_rating_his    =   $MsDb->NumRows($db_rating_his);
    if($numr_rating_his>0){
    while($res_rating_his   =   $MsDb->Result($db_rating_his)){
?>
<div class="card mb-3">
    <div class="card-body">
        <i class="fas fa-user"></i> <?php echo $res_rating_his['user_fname'].' '.$res_rating_his['user_lname']; ?>
        <small class="float-right"><?php echo $res_rating_his['rating_modify']; ?></small>
        <br>
            <?php
            $color=0;
            for($i_star=1;$i_star<=5;$i_star++){
                $color  =   $i_star/5;
                if($i_star<=$res_rating_his['rating_star']){
            ?>
                        <i class="fas fa-star text-success"></i>
                        <?php
                }else{
            ?>
                        <i class="fas fa-star text-secondary"></i>
                        <?php
                }
            }
            ?>
    </div>
</div>
<?php
        }
    }else{
?>
        <div class="alert alert-warning text-center" role="alert">
            <strong><i class="fas fa-exclamation-triangle"></i> ยังไม่มีการให้เรตติ้งร้านนี้</strong>
        </div>
<?php
    }
?>