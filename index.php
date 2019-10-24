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
    $sql_area = "SELECT area.area_id, area.area_name FROM area";
    $db_area   =   $MsDb->Query($sql_area);

    $sql_type = "SELECT * FROM `restaurant_type`";
    $db_type   =   $MsDb->Query($sql_type);
?>
<!doctype html>
<html lang="en">
<head>
    <title>GHT</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./config/app.css">
    <link rel="shortcut icon" href="./img/logo2.png" >
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
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-3 col-md-9 col-12">
                        <label for="sel_area">ย่าน</label>
                        <select class="form-control" name="sel_area" id="sel_area">
                            <?php while ($res_area   =   $MsDb->Result($db_area)) { ?>
                                <option value="<?php echo $res_area['area_id']; ?>"><?php echo $res_area['area_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-9 col-md-9 col-12">
                        <label for="search_text">ค้นหา</label>
                        <input class="form-control" name="search_text" id="search_text" placeholder="ชื่อร้าน / เมนูอาหาร"> 
                    </div>
                    <div class="col-12">
                        <a class="float-right" data-toggle="collapse" href="#collapse_detail" role="button" aria-expanded="false" aria-controls="collapse_detail"><i class="fas fa-info-circle"></i> ค้นหาขั้นสูง</a>
                    </div>
                </div>
                <div class="collapse" id="collapse_detail">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <label for="">ช่วงราคา <b id="price_min"></b> - <b id="price_max"></b> บาท</label>
                            <input type="text" class="js-range-slider" name="price_range" id="price_range" value=""/>
                            <hr>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">ประเภทอาหาร</label>
                                <select class="form-control" name="sel_res_type" id="sel_res_type">
                                    <option value="all">---ทุกประเภท---</option>
                                    <?php while ($res_type   =   $MsDb->Result($db_type)) { ?>
                                        <option value="<?php echo $res_type['res_type_id']; ?>"><?php echo $res_type['res_type_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <hr>
                <button class="btn btn-success float-right text-light" id="button-search" onclick="search()"><i class="fas fa-search"></i> ค้นหา</button>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body" id="search_result_area">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#price_range").ionRangeSlider({
                onStart: function (data) {
                    $("#price_min").text(data.from);
                    $("#price_max").text(data.to);
                },
                onChange: function (data) {
                    $("#price_min").text(data.from);
                    $("#price_max").text(data.to);
                },
                type: "double",
                min: 0,
                max: 5000,
                from: 0,
                to: 5000,
                grid: false
            });
        });
    </script>
</body>

</html>
