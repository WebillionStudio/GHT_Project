<?php session_start(); //Session Start
date_default_timezone_set('Asia/Bangkok');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // Noi Cache
require_once '../../config/wbsclass.php'; // import function
$MsDb = new MSClass(); // Connenct MySql
?>
<h4 class="text-info">ร้านอาหาร เป็นที่นิยม 10 อันดับ</h4>
<?php for ($i=0;$i<10;$i++) { ?>
    <div class="card mb-3">
        <div class="card-body">
        <b class="text-primary"><i class="fas fa-store"></i> ร้านแนะนำที่ <?php echo $i; ?></b>
        </div>
    </div>
<?php } ?>
