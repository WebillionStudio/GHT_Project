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
// if(isset($_SESSION['User_id'])){
$sql_ck_admin    =   "SELECT * FROM `restaurant` WHERE restaurant.restaurant_created = '".$_SESSION['User_id']."' and restaurant.restaurant_id = '".$_GET['id']."'";
$numr_ck_admin     =   $MsDb->NumRows($MsDb->Query($sql_ck_admin));
// }
$sql    =   "SELECT * FROM `restaurant` INNER JOIN area ON restaurant.restaurant_area = area.area_id WHERE restaurant.restaurant_id = '" . $_GET['id'] . "'";
$db     =   $MsDb->Query($sql);
$numr   =   $MsDb->NumRows($db);
if ($numr > 0) {
    $res    =   $MsDb->Result($db);
    if (date('Hi') >= $res['restaurant_time_open'] && date('Hi') <= $res['restaurant_time_close']) {
        $open_status    =   '<h5><span class="badge badge-success">เปิดอยู่</span><b class="text-info"> จนถึง ' . substr($res['restaurant_time_close'], 0, 2) . ':' . substr($res['restaurant_time_close'], 2, 2) . '</h5>';
    } else {
        $open_status    =   '<h5><span class="badge badge-danger">ปิดอยู่</span><b class="text-success"> เปิดเวลา ' . substr($res['restaurant_time_open'], 0, 2) . ':' . substr($res['restaurant_time_open'], 2, 2) . '</h5>';
    }
    $res['restaurant_time_open']    =   substr($res['restaurant_time_open'], 0, 2) . ':' . substr($res['restaurant_time_open'], 2, 2);
    $res['restaurant_time_close']   =   substr($res['restaurant_time_close'], 0, 2) . ':' . substr($res['restaurant_time_close'], 2, 2);

    $day_arr    =   explode(",", $res['restaurant_date_open']);
    if (count($day_arr) == 7) {
        $show_day   =   "<b class='text-success'>ทุกวัน</b>";
    } else {
        for ($i = 1; $i < 8; $i++) {
            if (in_array($i, $day_arr)) {
                $show_day   .=  '<b class="text-success">' . day_thai($i, "2") . '</b> ';
            } else {
                $show_day   .=  '<b class="text-danger">' . day_thai($i, "2") . '</b> ';
            }
        }
    }

    // ***** Get My Rating *****
    if (isset($_SESSION['User_id'])) {
        $sql_rating     =   "SELECT rating_id , rating_star FROM `restaurant_rating` WHERE rating_restaurant = '" . $_GET['id'] . "' AND rating_user = '" . $_SESSION['User_id'] . "'";
        $db_rating      =   $MsDb->Query($sql_rating);
        $numr_rating    =   $MsDb->NumRows($db_rating);
        if ($numr_rating > 0) {
            $res_rating    =   $MsDb->Result($db_rating);
        }
    }
    // ***** Get My Rating *****

    // ***** Bookmark *****
    if (isset($_SESSION['User_id'])) {
        $sql_bookmark     =   "SELECT bookmark_id FROM `restaurant_bookmark` WHERE restaurant_id = '" . $_GET['id'] . "' AND user_id = '" . $_SESSION['User_id'] . "'";
        $db_bookmark      =   $MsDb->Query($sql_bookmark);
        $numr_bookmark    =   $MsDb->NumRows($db_bookmark);
        if ($numr_bookmark > 0) {
            $res_bookmark    =   $MsDb->Result($db_bookmark);
        }
    }
    // ***** Bookmark *****

    // ***** Countstar *****
    $sql_star_all       =   "SELECT * FROM `restaurant_rating` WHERE `rating_restaurant` = '" . $_GET['id'] . "'";
    $db_star_all        =   $MsDb->Query($sql_star_all);
    $numr_star_all      =   $MsDb->NumRows($db_star_all);
    $sum_star = 0;
    while ($res_star_all =   $MsDb->Result($db_star_all)) {
        $sum_star += $res_star_all['rating_star'];
    }
    for ($i_cou_sql_star = 1; $i_cou_sql_star <= 5; $i_cou_sql_star++) {
        $sql_star   =   "SELECT * FROM `restaurant_rating` WHERE `rating_restaurant` = '" . $_GET['id'] . "' AND `rating_star` ='" . $i_cou_sql_star . "'";
        $numr_star[$i_cou_sql_star]    =   $MsDb->NumRows($MsDb->Query($sql_star));
    }
    if ($numr_star_all > 0) {
        $restaurant_rating  =    number_format((float) $sum_star / $numr_star_all, 1, '.', '');
    } else {
        $restaurant_rating  =   0;
    }
    // ***** Countstar *****


    $sql_price_rate     =   "SELECT MIN(Menu_price) as min_price , MAX(Menu_price) as max_price FROM `restaurant_menu` WHERE `restaurant_menu`.`restaurant_id` = '".$_GET['id']."'";
    $db_price_rate      =   $MsDb->Query($sql_price_rate);
    $res_price_rate     =   $MsDb->Result($db_price_rate);
    if($res_price_rate['min_price']==""&&$res_price_rate['max_price']==""){
        $res_price_rate['min_price']    =   0;
        $res_price_rate['max_price']    =   0;
    }

    $sql_menu       =   "SELECT Menu_name,Menu_price  FROM `restaurant_menu` WHERE `restaurant_menu`.`restaurant_id` = '".$_GET['id']."'";
    $db_menu        =   $MsDb->Query($sql_menu);
    $numr_menu      =   $MsDb->NumRows($db_menu);
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>GHT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./config/app.css">
    <script src="./plugin/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.6/dist/sweetalert2.all.min.js" integrity="sha256-mQeZz+CpS7tBjPCIuN+XEJYBovV7f2d0MJn+yy0jqLU=" crossorigin="anonymous"></script>
    <script src="./plugin/Loading/jquery.loadingModal.min.js"></script>
    <script src="./config/app.js"></script>
</head>

<body>
    <?php include_once './includes/navbar.php'; ?>
    <?php if ($numr > 0) { ?>
        <?php
            if($res['restaurant_show']==0){
        ?>
            <div class="container">
                <div class="alert alert-warning h4 text-center mt-3" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> กำลังปิดปรับปรุงร้าน
                </div>
            </div>
        <?php
                exit;
            }
        ?>
        <input type="hidden" id="res_id" name="res_id" value="<?php echo $_GET['id']; ?>">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3>
                        <i class="fas fa-store"></i> <?php echo $res['restaurant_name']; ?>
                        <?php
                            if (isset($_SESSION['User_id'])) {
                                if ($numr_bookmark > 0) {
                                    ?>
                                <input type="hidden" id="bookmark_id" name="bookmark_id" value="<?php echo $res_bookmark['bookmark_id']; ?>">
                                <a href="javascript:func_del_bookmark()" data-toggle="tooltip" data-placement="top" title="บันทึกลงบุ๊กมาร์คแล้ว">
                                    <i class="fas fa-bookmark"></i>
                                </a>
                            <?php
                                    } else {
                                        ?>
                                <a href="javascript:func_add_bookmark()" data-toggle="tooltip" data-placement="top" title="ยังไม่ได้บันทึกลงบุ๊กมาร์ค">
                                    <i class="far fa-bookmark"></i>
                                </a>
                        <?php
                                }
                            }
                            ?>
                    </h3>
                    <p>
                        <span class="badge badge-danger"><i class="fas fa-star"></i>
                            <?php echo $restaurant_rating; ?></span>
                        <b class="text-success"><i class="fas fa-star"></i> <?php echo $numr_star_all; ?> เรตติ้ง</b>
                        <b class="text-primary"><i class="fas fa-comment"></i> 99 รีวิว</b>
                    </p>
                    <?php
                        if (array_search(date('w'), $day_arr)) {
                            echo $open_status;
                        } else {
                    ?>
                        <h5><span class="badge badge-danger">วันนี้ปิดทั้งวัน</span></h5>
                    <?php
                        }
                        ?>


                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">

                    <!-- ***** ***** ***** ***** Restaurant Data ****** ***** ***** ***** -->
                    <div class="card mt-3">
                        <div class="card-body text-dark">
                            <h5><b><i class="fas fa-store"></i> <u>ข้อมูลร้านอาหาร</u></b></h5>
                            <hr>
                            <b>เวลาเปิด - ปิดร้าน</b>
                            <p><?php echo $show_day . '<br><font class="text-info">เวลา ' . $res['restaurant_time_open'] . '-' . $res['restaurant_time_close'] . '</font>'; ?>
                            </p>
                            <b>ช่วงราคา</b>
                            <p>
                                <font class="text-info"><?php echo $res_price_rate['min_price']; ?> - <?php echo $res_price_rate['max_price']; ?> บาท</font>
                            </p>
                            <b>จำนวนที่นั่ง</b>
                            <p>
                                <font class="text-info">20 ที่นั่ง</font>
                            </p>
                            <b>แนะนำร้าน</b>
                            <p>
                                <font class="text-info"><?php echo $res['restaurant_description']; ?></font>
                            </p>
                            <button class="btn btn-info w-100" data-toggle="modal" data-target="#modal_menu"><i class="fas fa-bars"></i> เมนูอาหาร</button>
                        </div>
                    </div>
                    <!-- ***** ***** ***** ***** Restaurant Data ****** ***** ***** ***** -->

                    <div class="card mt-3">
                        <div class="card-body text-dark">
                            <h5><b><i class="fas fa-map-marked-alt"></i> <u>ข้อมูลที่อยู่</u></b></h5>
                            <hr>
                            <iframe src="https://maps.google.com/maps?q=<?php echo $res['restaurant_location']; ?>&z=15&output=embed" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" frameborder="0" style="border:0"></iframe>
                            <hr>
                            <i class="fas fa-map-marker-alt"></i> <?php echo $res['restaurant_address']; ?>
                        </div>
                    </div>


                </div>
                <div class="col-lg-8 col-md-8 col-12">

                    <!-- ***** ***** ***** ***** Picture ****** ***** ***** ***** -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="text-dark"><b><i class="fas fa-images"></i> <u>รูปภาพ</u></b></h5>
                            <hr>
                        </div>
                    </div>
                    <!-- ***** ***** ***** ***** Picture ****** ***** ***** ***** -->

                    <!-- ***** ***** ***** ***** Promotion ****** ***** ***** ***** -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="text-dark"><b><i class="fas fa-percent"></i> <u>โปรโมชั่น</u></b></h5>
                            <hr>
                        </div>
                    </div>
                    <!-- ***** ***** ***** ***** Promotion ****** ***** ***** ***** -->

                    <!-- ***** ***** ***** ***** Rating ****** ***** ***** ***** -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="text-dark"><b><i class="star fas fa-star"></i> <u>เรตติ้ง</u></b></h5>
                            <hr>
                            <h4 class="text-center text-success">ให้คะแนนร้านอาหาร</h4>
                            <h3 class="text-center">
                                <?php
                                    if (isset($_SESSION['User_id'])) {
                                        if ($numr_rating == 0) {
                                            ?>
                                        <font class="star_rating" onclick="func_accept_rating(this)" data-id="1" style="cursor:pointer;color:rgba(10,255,10,0.2);"><i id="star1" class="star far fa-star"></i></font>
                                        <font class="star_rating" onclick="func_accept_rating(this)" data-id="2" style="cursor:pointer;color:rgba(10,255,10,0.4);"><i id="star2" class="star far fa-star"></i></font>
                                        <font class="star_rating" onclick="func_accept_rating(this)" data-id="3" style="cursor:pointer;color:rgba(10,255,10,0.6);"><i id="star3" class="star far fa-star"></i></font>
                                        <font class="star_rating" onclick="func_accept_rating(this)" data-id="4" style="cursor:pointer;color:rgba(10,255,10,0.8);"><i id="star4" class="star far fa-star"></i></font>
                                        <font class="star_rating" onclick="func_accept_rating(this)" data-id="5" style="cursor:pointer;color:rgba(10,255,10,1);"><i id="star5" class="star far fa-star"></i></font>
                                        <?php
                                                } else {
                                                    $color = 0;
                                                    for ($i_star = 1; $i_star <= 5; $i_star++) {
                                                        $color  =   $i_star / 5;
                                                        if ($i_star <= $res_rating['rating_star']) {
                                                            ?>
                                                <font style="color:rgba(10,255,10,<?php echo $color; ?>);">
                                                    <i class="star fas fa-star"></i>
                                                </font>
                                            <?php
                                                            } else {
                                                                ?>
                                                <font style="color:rgba(10,255,10,<?php echo $color; ?>);">
                                                    <i class="star far fa-star"></i>
                                                </font>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                                        <br>
                                        <br>
                                        <button class="btn btn-danger" onclick="func_cancel_rating(this)" data-id="<?php echo $res_rating['rating_id']; ?>">ยกเลิกเรตติ้ง</button>
                                    <?php
                                            }
                                            ?>
                                <?php
                                    } else {
                                        ?>
                                    <center>
                                        <button class="btn btn-info" onclick="func_call_nav_modal()">
                                            <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
                                    </center>
                                <?php
                                    }
                                    ?>
                            </h3>
                            <hr>
                            <?php
                                $i_s_cou = 0;
                                $darkstar = 0;
                                $persent = 0;
                                for ($i_s = 5; $i_s > 0; $i_s--) {
                                    $darkstar   =   $i_s - $i_s_cou;
                                    $persent    = (100 / $numr_star_all) * $numr_star[$i_s];
                                    ?>

                                <p>
                                    <?php for ($star = 0; $star < $i_s; $star++) { ?>
                                        <i class="fas fa-star text-success"></i>
                                    <?php } ?>
                                    <?php for ($star = 0; $star < $i_s_cou; $star++) { ?>
                                        <i class="fas fa-star text-secondary"></i>
                                    <?php } ?>
                                    <b class="float-right text-dark"><?php echo $numr_star[$i_s]; ?> เรตติ้ง</b>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $persent; ?>%" aria-valuenow="<?php echo $persent; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </p>
                            <?php
                                    $i_s_cou++;
                                }
                                ?>
                            <hr>
                            <div id="rating_history">
                            </div>
                        </div>
                    </div>
                    <!-- ***** ***** ***** ***** Rating ****** ***** ***** ***** -->

                    <!-- ***** ***** ***** ***** Review ****** ***** ***** ***** -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="text-dark"><b><i class="fas fa-comments"></i> <u>รีวิว</u></b></h5>
                            <hr>
                        </div>
                    </div>
                    <!-- ***** ***** ***** ***** Review ****** ***** ***** ***** -->
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal_menu" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-bars"></i> เมนูอาหาร</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body p-0" style="height:70vh;overflow:auto;">
                    <?php
                        if($numr_menu>0){
                    ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>ชื่อเมนู</th>
                                            <th>ราคา</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while($res_menu   =   $MsDb->Result($db_menu)){
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $res_menu['Menu_name']; ?></td>
                                            <td class="text-right"><?php echo $res_menu['Menu_price']; ?> บาท</td>
                                        </tr>
                                    <?php
                                        }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                    <?php
                        }else{
                    ?>
                            <div class="alert alert-warning text-center" role="alert">
                                <strong>ไม่มีรายการเมนูอาหาร</strong>
                            </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('[data-toggle="tooltip"]').tooltip();
            loading_func('กำลังโหลดข้อมูล');
            $('#rating_history').load('./views/restaurant/rating_history.php', {
                res_id: $('#res_id').val()
            }, function() {
                $('body').loadingModal('destroy');
            });
            $(".star_rating")
                .mouseover(function() {
                    for (i = 1; i <= $(this).attr('data-id'); i++) {
                        $("i#star" + i).removeClass("far fa-star").addClass("fas fa-star");
                    }
                })
                .mouseout(function() {
                    $(".star").removeClass("fas fa-star").addClass("far fa-star");
                });
        </script>
    <?php } else { ?>
        <div class="container">
            <div class="alert alert-warning text-center mt-3" role="alert">
                <i class="fas fa-exclamation-triangle"></i> ไม่มีข้อมูลร้านค้าที่คุณต้องการ
            </div>
        </div>
    <?php } ?>
</body>

</html>
