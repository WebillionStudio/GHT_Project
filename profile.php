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
    $sql_area  =   "SELECT area.area_id, area.area_name FROM `area`";
    $db_area   =   $MsDb->Query($sql_area);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.6/dist/sweetalert2.all.min.js"
        integrity="sha256-mQeZz+CpS7tBjPCIuN+XEJYBovV7f2d0MJn+yy0jqLU=" crossorigin="anonymous"></script>
    <script src="./plugin/Loading/jquery.loadingModal.min.js"></script>
    <script src="./config/app.js"></script>
</head>

<body>
    <?php include_once './includes/navbar.php'; ?>
    <div class="container">
        โปรไฟล์
    </div>
</body>

</html>
