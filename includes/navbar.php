<?php 
if(!isset($_SESSION)){session_start();} //Session Start
// session_destroy();
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once 'config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
?>
<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-success" style="background-color:#ac695e">
    <a class="navbar-brand" href="index.php"><img src="./img/logo.png" style="height:5vh"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
    <?php
        if(!isset($_SESSION['User_id'])){
    ?>
            <li class="nav-item">
                <a class="nav-link text-center" onclick="func_call_nav_modal()" style="cursor:pointer"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>
            </li>
    <?php
        }else{
    ?>
            <li class="nav-item">
                <a class="nav-link text-center"  href="index.php" style="cursor:pointer"><i class="fas fa-search"></i> ค้นหาร้านอาหาร</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> <?php echo $_SESSION['User_fname'].' '.$_SESSION['User_lname']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profile.php"><i class="fas fa-user-cog"></i> บัญชีของฉัน</a>
                <a class="dropdown-item" href="my_restaurant_config.php"><i class="fas fa-store"></i> ร้านของฉัน</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="bookmark.php"><i class="far fa-bookmark"></i> บุ๊กมาร์คร้านอาหาร</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-center" onclick="logout_btn()" style="cursor:pointer"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
            </li>
    <?php
        }
    ?>
        </ul>
    </div>

</nav>

<!-- Modal -->
<div class="modal fade" id="NavbarModal" tabindex="-1" role="dialog" aria-labelledby="NavbarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="show_nav_modal">

        </div>
    </div>
</div>
