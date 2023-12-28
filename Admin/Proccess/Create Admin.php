<?php

require_once "session.php";



   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){



if(isset($_POST["email"]) /*&& isset($_POST["secret_key"])*/){


if(isset($_POST["category"])){


$email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);


if(empty($email)){


die("Please enter email");


}else{


    $email = htmlspecialchars($email);


}

/*
if(empty($_POST["secret_key"])){


die("Please enter secret key");


}

$secret_key = htmlspecialchars($_POST["secret_key"]);
*/


$category = filter_var($_POST["category"],FILTER_SANITIZE_STRING);

if(empty($category)){


die("Please enter category");

}


if($category  == "Tech support" || $category == "Vendor Agent" || $category == "Master" || $category == "Store Agent"

|| $category == "Pickup Agent" || $category == "Resolution Team" || $category == "Customer care"

){

require_once "db_connection.php";

//CHECK IF EMAL EXIT IN DATBASE OR NOT;

$mail_check = "SELECT * FROM Admin_Register_db WHERE Email ='$email'";



$email_result = mysqli_query($conn,$mail_check);


if(mysqli_num_rows($email_result) > 0){


die("User with this email ".$email." already exits,please delete user if you want to recreate or change user category.");


}else{


//DO NOTHIN//



}


//CHECK SECRET KEY//

if(isset($_POST["secret-key"]) && !empty($_POST["secret-key"])){


$OldKey = htmlspecialchars($_POST["secret-key"]);


$select = "SELECT * FROM Admin_Register_db WHERE id='$_SESSION[Admin_key]'";

$Results = mysqli_query($conn,$select);

$UserPass = mysqli_fetch_assoc($Results);

if(password_verify(htmlspecialchars($OldKey),$UserPass["Pin"]) == "password_hash"){



}else{

    die("Invalid secret key");
}


}else{

    die("Please enter your secret key");
}



$email = mysqli_real_escape_string($conn,$email);

$category = mysqli_real_escape_string($conn,$category);

/*$secret_key = mysqli_real_escape_string($conn,$secret_key);


$secret_key = password_hash($secret_key,PASSWORD_DEFAULT);*/

$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

//$user_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);



$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"tablet"));


$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"mobile"));



$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"windows"));


$isAndriod = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"andriod"));


$isIphone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"iphone"));


$isIpad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"ipad"));


$isIos= $isIpad || $isIphone;



if($isMob){

if($isTab){

    $agent = "Tablet";

}else{


    $agent = "Mobile";
}

}else{

    $agent = "Desktop";
}

if($isIos){

    $user_agent = $agent. " Iphone IOS";
}else if($isAndriod){

$user_agent = $agent . " Andriod";

}else{

$user_agent = $agent. " Windows";

}




  $hash= uniqid().rand().uniqid();

  $log_hash = password_hash($hash,PASSWORD_DEFAULT);



$insert = "INSERT INTO Admin_Register_Temp(
    Email,Admin_id,Category,Hash_id,Hash,Date,Time,Ip,User_agent
)

VALUES('$email','$_SESSION[Admin_key]','$category','$hash','$log_hash','$date','$time','$ip','$user_agent')

";

if(mysqli_query($conn,$insert)){


    die("https//:fast9shop.000webhostapp.com/Admin/Admin-reg-portal?key=".$hash. "<br> share link with user as mail function is off.");


}else{


die("Error creating admin,Please try again later.");


}




}else{

    die("Please enter a valid category,category <b>".$category. "</b> is not valid");




}




}else{



    //CATEGORY NOT FOUND


}




}else{


//INVALID OR UNKNOWN REQUEST


}




}