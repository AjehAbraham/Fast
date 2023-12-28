<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if(isset($_SESSION["Admin_id"]) && isset($_SESSION["Admin_key"])){




    require_once "db_connection.php";

    $admin_id = htmlspecialchars($_SESSION["Admin_id"]);

    $hash = htmlspecialchars($_SESSION["Admin_hash"]);

$hash = mysqli_real_escape_string($conn,$hash);

$admin_id =mysqli_real_escape_string($conn,$admin_id);


    $fetch = "SELECT * FROM Admin_Login_history WHERE User_id='$_SESSION[Admin_key]' ORDER BY id DESC LIMIT 1 ";
    





}else{



header("Location: Error");
exit;

}