
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(0);
require_once 'class.php';
require_once 'func.php';
define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'xperfume');
session_start();
$DB = new DB();
$conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE) or die('Không Thể Kết Nối Database');
$info  = $DB->fetch_assoc("SELECT * FROM `system_info` WHERE 1",1); // thông tin cấu hình hệ thống

$time = date("H:i d-m-Y");
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
$users = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `account` WHERE `username` = '$username'"));
}
?>

