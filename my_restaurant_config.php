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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.6/dist/sweetalert2.all.min.js"
        integrity="sha256-mQeZz+CpS7tBjPCIuN+XEJYBovV7f2d0MJn+yy0jqLU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"></script>
    <script src="./plugin/Loading/jquery.loadingModal.min.js"></script>
    <script src="./plugin/Datepicker/js/bootstrap-datepicker.js"></script><!--เพิ่มส่วนนี้-->
    <script src="./plugin/Datepicker/js/bootstrap-datepicker-thai.js"></script><!--เพิ่มส่วนนี้-->
    <script src="./plugin/Datepicker/js/bootstrap-datepicker.th.js"></script><!--เพิ่มส่วนนี้-->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="./config/app.js"></script>
    <style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #0080ff;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #ec282e;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    </style>
</head>

<body>
    <?php include_once './includes/navbar.php'; ?>
    <div class="container">
        <div class="alert alert-light border border-secoundary mt-3 mb-0" role="alert">
            <a href="my_restaurant_config.php"><i class="fas fa-cog"></i> จัดการร้านอาหารของฉัน</a>
        </div>
        <div id="show_restaurant_config">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="alert alert-success mb-0" role="alert" onclick="func_call_restaurant_create()"
                        style="cursor:pointer">
                        <h2 class="alert-heading text-center"><b><i class="fas fa-plus"></i> สร้างร้านอาหารของฉัน</b>
                        </h2>
                    </div>
                </div>
            </div>
            <div id="show_restaurant_list">

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_restaurant" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal_restaurant">

            </div>
        </div>
    </div>
    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
        func_load_my_restaurant();
    });
    </script>
</body>

</html>
