<?php session_start(); //Session Start
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    // print_r($_POST);
    // exit;
    if($_POST['type']=="add"){
        $sql    =   "INSERT INTO `restaurant` (`restaurant_name`, `restaurant_description`, `restaurant_modify`, `restaurant_area`, `restaurant_created`) VALUES ('".$_POST['name']."', '".$_POST['description']."', '".date('Y-m-d H:i:s')."', '".$_POST['area']."', '".$_SESSION['User_id']."')";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }else if($_POST['type']=="del"){
        $sql    =   "DELETE FROM `restaurant` WHERE `restaurant`.`restaurant_id` = '".$_POST['res_id']."'";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }else if($_POST['type']=="check"){
        $sql    =   "UPDATE `restaurant` SET `restaurant_show` = '".$_POST['check']."' WHERE `restaurant`.`restaurant_id` = '".$_POST['res_id']."'";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }else if($_POST['type']=="update"){
        if($_POST['type_update']=="res_data"){
            $data = array();
            foreach ($_POST['data'] as $key => $value) {
                $data[$value['name']]=$value['value'];
            }
            $time_open_arr      =   explode(":",$data['restaurant_time_open']);
            $time_open          =   $time_open_arr[0].$time_open_arr[1];
            $time_close_arr      =   explode(":",$data['restaurant_time_close']);
            $time_close          =   $time_close_arr[0].$time_close_arr[1];

            $sql    =   "UPDATE `restaurant` SET `restaurant_name` = '".$data['restaurant_name']."',`restaurant_description` = '".$data['restaurant_description']."',`restaurant_type` = '".$data['sel_res_type']."',`restaurant_time_open` = '".$time_open."',`restaurant_time_close` = '".$time_close."',`restaurant_area` = '".$data['sel_area']."',`restaurant_address` = '".$data['restaurant_address']."',`restaurant_email` = '".$data['restaurant_email']."',`restaurant_tel` = '".$data['restaurant_tel']."',`restaurant_facebook` = '".$data['restaurant_facebook']."',`restaurant_ig` = '".$data['restaurant_ig']."',`restaurant_website` = '".$data['restaurant_website']."' WHERE `restaurant`.`restaurant_id` = '".$_POST['res_id']."'";
            $db    =   $MsDb->Query($sql);
            if($db){
                echo "Success";
            }else{
                echo "Error_Query";
            }
        }
    }
?>
