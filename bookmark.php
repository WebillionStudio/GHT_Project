<?php session_start(); //Session Start
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once 'config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    $sql    =   "SELECT * FROM restaurant_bookmark inner join restaurant on restaurant_bookmark.restaurant_id = restaurant.restaurant_id  where user_id = '".$_SESSION['User_id']."'";
    $db     =   $MsDb->Query($sql);
?>
<!doctype html>
<html lang="en">

<head>
    <title>GHT</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./config/app.css">
    <script src="./plugin/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.6/dist/sweetalert2.all.min.js" integrity="sha256-mQeZz+CpS7tBjPCIuN+XEJYBovV7f2d0MJn+yy0jqLU=" crossorigin="anonymous"></script>
    <script src="./plugin/Loading/jquery.loadingModal.min.js"></script>
    <script src="./config/app.js"></script>
</head>

<body>
    <?php include_once './includes/navbar.php'; ?>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                <i class="far fa-bookmark"></i> บุ๊กมาร์คร้านอาหาร
            </div>
            <div class="card-body">
                <?php
                    while($res     =   $MsDb->Result($db)){
                        if(date('Hi')>=$res['restaurant_time_open']&&date('Hi')<=$res['restaurant_time_close']){
                            $open_status    =   '<b class="text-success">เปิดอยู่ในขณะนี้</b>';
                        }else{
                            $open_status    =   '<b class="text-danger">ปิดอยู่ในขณะนี้</b>';
                        }
                        if($res['restaurant_time_open']==""||$res['restaurant_time_close']==""){
                            $show_time  =   "<b class='text-danger'>ไม้ได้กำหนดเวลาเปิด-ปิด</b>";
                        }else{
                            $res['restaurant_time_open']    =   substr($res['restaurant_time_open'],0,2).':'.substr($res['restaurant_time_open'],2,2);
                            $res['restaurant_time_close']   =   substr($res['restaurant_time_close'],0,2).':'.substr($res['restaurant_time_close'],2,2);
                            $show_time  =   $res['restaurant_time_open'].' น. - '.$res['restaurant_time_close'].' น.';
                        }
                ?>
                        <div class="alert alert-info border border-dark" role="alert">
                            <p><a href="./restaurant.php?id=<?php echo $res['restaurant_id']; ?>"><i class="fas fa-store"></i> <b class="text-primary"><?php echo $res['restaurant_name']; ?></b></a></p>
                            <p><i class="far fa-clock"></i> เวลาเปิด-ปิด : <b class="text-info"><?php echo $show_time; ?></b></p>
                            <p><i class="fas fa-store-alt"></i> สถานะเปิด-ปิด : <?php echo $open_status; ?></p>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
