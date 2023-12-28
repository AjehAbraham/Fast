<?php  
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

$date = htmlspecialchars(date("Y/m/d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
//$User_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);


$selectF = "SELECT * FROM Register_db WHERE id='$_SESSION[User]'";

$userResult = mysqli_query($conn,$selectF);
$results = mysqli_fetch_assoc($userResult);


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



$UniqueID = $results["uniqueID"];

$cookieName = "UserID";
$cookieValue = $UniqueID;

$cookieName2 = "TokenID";
$cookievalue2 =rand(123,9854). uniqid(). rand(123492,1029845). uniqid(). rand();

setcookie($cookieName,$cookieValue, time() + 86400 * 7, "/");

setcookie($cookieName2,$cookievalue2, time() + 86400 * 7, "/");

$hash = password_hash($cookievalue2,PASSWORD_DEFAULT);


$status = "Null";
$hash= password_hash($hash,PASSWORD_DEFAULT);

$auth = "INSERT INTO Authentication(
User_id,uniqueID,HashID,Date,Ip_add,Status,User_agent)

VALUES('$_SESSION[User]','$UniqueID','$hash','$date','$ip','$status','$user_agent')
";

if(mysqli_query($conn,$auth)){

//DO NOTHING//


}else{


    //DO NOTHIN..

    //echo mysqli_connect_error();
die("Error");

}