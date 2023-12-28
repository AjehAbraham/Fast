<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if($_SERVER["REQUEST_METHOD"] =="POST"){

if(isset($_SESSION["Admin_hash"]) && isset($_SESSION["Admin_id"])){

if(isset($_POST["pin"]) && isset($_POST["otp"])){


$pin = htmlspecialchars($_POST["pin"]);

$admin_id = htmlspecialchars($_SESSION["Admin_id"]);

$hash = htmlspecialchars($_SESSION["Admin_hash"] );

$otp = (int) filter_var($_POST["otp"],FILTER_VALIDATE_INT);


require_once "db_connection.php";


$otp = mysqli_real_escape_string($conn,$otp);

$pin = mysqli_real_escape_string($conn,$pin);


//VERIFY OTP AND SECRET PIN//

$verify_otp =  "SELECT * FROM Admin_Login_otp WHERE Admin_id ='$admin_id' 

AND NOW() <= DATE_ADD(DATE,INTERVAL 12 MINUTE) ORDER BY id DESC LIMIT 1";

$results = mysqli_query($conn,$verify_otp);


if(mysqli_num_rows($results) > 0){


$result = mysqli_fetch_assoc($results);


if($otp === $result["Otp"] && password_verify($hash,$result["Admin_hash"]) == "password_hash"){

   // session_start();

    session_regenerate_id();

    $_SESSION["Admin_key"] = $result["Admin_id"];

//INSERT SESSION ID INTO DATABASE AND KEEP TRACK OF USER ACTIVITIES//
$satus ="success";


$admin_id = $result["id"];

require_once "Admin session.php";

require_once "Remember-me.php";


$_SESSION["Admin_id"] = $_SESSION["Admin_key"];

die("ok");


}else{

    die("Invalid Login credentials,please check your otp and secret pin");

//die("okk");


}





}else{


die("Invalid otp");



}





}else{



    die("Please enter your secret pin");

}




}else{


header("Location: Error");
exit;

}









}
