<?php
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



$hash = password_hash($_SESSION["Admin_hash"],PASSWORD_DEFAULT);

$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

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



$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$otp = rand(649273,927474);

$session_id = session_id();

$session_hash = $_SESSION["Admin_hash"];



$insert = "INSERT INTO Admin_Login_history(

Admin_id,Status,Hash,Session_id,Date,Time,Ip,User_agent
)
VALUES('$admin_id','$satus','$session_hash','$session_id','$date','$time','$ip','$user_agent')

";

if(mysqli_query($conn,$insert)){



}else{

//FAILED TO INSERT//

echo mysqli_error($conn);

}