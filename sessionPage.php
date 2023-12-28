<?php
session_start();

    
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}else if(isset($_SESSION["User"])){


require_once "database_connection.php";

require_once "check session id.php";


if(!isset($_COOKIE["TokenID"]) && !isset($_COOKIE["UserID"])){

    require_once "save remember me.php";
    
    }else{
    
    
    }

$user_record = "SELECT * FROM Register_db WHERE id = '$_SESSION[User]'";


$user_result = mysqli_query($conn,$user_record);


$New_user = mysqli_fetch_assoc($user_result);




}else{

//SET LAST VISITED PAGE//

$cookie_name = "Last_visited";

$page = ($_SERVER["PHP_SELF"]);

//$page =str_replace('/',"",$page);


$cookie_value = htmlspecialchars($page);


setcookie($cookie_name,$cookie_value, time() + 86400 * 7,"/");


    if(isset($_COOKIE["UserID"]) && isset($_COOKIE["TokenID"])){

if(!empty($_COOKIE["UserID"]) && !empty($_COOKIE["TokenID"])){



header("Location: Auth");

exit;




}



}



header("Location: Login-user");
exit;

}