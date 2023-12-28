<?php
session_start();

    
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

///header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}elseif(isset($_SESSION["User"])){


    require_once "database_connection.php";

    $fetch ="SELECT * FROM Register_db WHERE id='$_SESSION[User]'";

    $result = mysqli_query($conn,$fetch);

    $user = mysqli_fetch_assoc($result);


}else{

    die("Please Login or refresh page");
}




