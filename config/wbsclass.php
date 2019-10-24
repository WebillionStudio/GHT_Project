<?php
if(!isset($_SESSION)){session_start();}
class MSClass{
    private $result;
    // private $hostname = "localhost";
    private $hostname = "localhost";
    private $dbname = "xxxx";
    private $username = "xxxx";
    private $password = "xxxx";
    public function __construct($dbname = 'db59143249'){
        $this->result = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname) or die('Not Connect MYSQL!!!!');
        mysqli_set_charset($this->result,"utf8");
        return $this->result;
    }
    public function Query($sql){
        return mysqli_query($this->result, $sql);
    }
    public function Result($db){
        return mysqli_fetch_array($db);
    }
    public function NumRows($db){
        return mysqli_num_rows($db);
    }
}
function conv_utf_tis($string){
    return iconv('UTF-8', 'TIS-620', $string);
}
function conv_tis_utf($string){
    return iconv('TIS-620', 'UTF-8', $string);
}
function month_thai($month){
    $showmonth = array(
        '01' => 'มกราคม',
        '02' => 'กุมภาพันธ์',
        '03' => 'มีนาคม',
        '04' => 'เมษายน',
        '05' => 'พฤษภาคม',
        '06' => 'มิถุนายน',
        '07' => 'กรกฏาคม',
        '08' => 'สิงหาคม',
        '09' => 'กันยายน',
        '10' => 'ตุลาคม',
        '11' => 'พฤศจิกายน',
        '12' => 'ธันวาคม',
    );
    return $showmonth[$month];
}
function month_thai_arr($month){
    $showmonth = array(
        '1' => 'มกราคม',
        '2' => 'กุมภาพันธ์',
        '3' => 'มีนาคม',
        '4' => 'เมษายน',
        '5' => 'พฤษภาคม',
        '6' => 'มิถุนายน',
        '7' => 'กรกฏาคม',
        '8' => 'สิงหาคม',
        '9' => 'กันยายน',
        '10' => 'ตุลาคม',
        '11' => 'พฤศจิกายน',
        '12' => 'ธันวาคม',
    );
    return $showmonth[$month];
}

function day_thai($day,$type){
    if($type=="1"){
        $showday = array(
            '1' => 'จันทร์',
            '2' => 'อังคาร',
            '3' => 'พุธ',
            '4' => 'พฤหัสบดี',
            '5' => 'ศุกร์',
            '6' => 'เสาร์',
            '7' => 'อาทิตย์'
        );
    }else if($type=="2"){
        $showday = array(
            '1' => 'จ',
            '2' => 'อ',
            '3' => 'พ',
            '4' => 'พฤ',
            '5' => 'ศ',
            '6' => 'ส',
            '7' => 'อา'
        );
    }
    return $showday[$day];
}
//AllfunctionClass
// class AFClass{
function random_Hex($len){
    rand(0, (double) microtime() * 10000000);
    $chars = "ABCDEFabcdef0123456789";
    $ret_str = "";
    $num = strlen($chars);
    for ($i = 0; $i < $len; $i++) {
        $ret_str .= $char[rand() % $num];
        $ret_str .= "";
    }
    return $ret_str;
}
function thai_date($datetime, $format, $clock){
    list($date, $time) = split(' ', $datetime);
    list($H, $i, $s) = split(':', $time);
    list($Y, $m, $d) = split('-', $date);
    $Y = $Y + 543;
    $month = array(
        '0' => array(
            '01' => 'มกราคม',
            '02' => 'กุมภาพันธ์',
            '03' => 'มีนาคม',
            '04' => 'เมษายน',
            '05' => 'พฤษภาคม',
            '06' => 'มิถุนายน',
            '07' => 'กรกฏาคม',
            '08' => 'สิงหาคม',
            '09' => 'กันยายน',
            '10' => 'ตุลาคม',
            '11' => 'พฤศจิกายน',
            '12' => 'ธันวาคม',
        ),
        '1' => array(
            '01' => 'ม.ค.',
            '02' => 'ก.พ.',
            '03' => 'มี.ค.',
            '04' => 'เม.ย.',
            '05' => 'พ.ค.',
            '06' => 'มิ.ย.',
            '07' => 'ก.ค.',
            '08' => 'ส.ค.',
            '09' => 'ก.ย.',
            '10' => 'ต.ค.',
            '11' => 'พ.ย.',
            '12' => 'ธ.ค.',
        ),
    );
    if ($clock == false) {
        return $d . ' ' . $mouth[$format][$m] . ' ' . $Y;
    } else {
        return $d . ' ' . $mouth[$format][$m] . ' ' . $Y . ' ' . $time;
    }
}
function ConvHtmlEntities($str){
    $start_str = array("'");
    $start_re = array("\'");
    $txt = str_replace($start_str,$start_re,$str);
    return $txt;
}
