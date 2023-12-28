<?php

require_once "sessionPage.php";



   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if(isset($_POST["Two-factor"])){



    $date = htmlspecialchars(date("Y/m/d H:i:s"));
    $time = htmlspecialchars(date("H:i:s"));
    $ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
  //  $User_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);
$session_id = session_id();




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



//CHECK STATSUS..


$status_r = "SELECT * FROM Two_factor_auth WHERE User_id='$_SESSION[User]' ORDER BY id DESC LIMIT 1";


$status_result = mysqli_query($conn,$status_r);

if(mysqli_num_rows($status_result) > 0){


    $stat = mysqli_fetch_assoc($status_result);

    if($stat["Status"] == "Off"){


        $status = "On";
        $response = "ok";
    }else{


$response ="okk";
        $status = "Off";
    }



}else{

$status = "On";

$response = "ok";

}



$insert = "INSERT INTO Two_factor_auth(
User_id,Status,Session_id,Date,Time,Ip_addr,User_agent
)
VALUES('$_SESSION[User]','$status','$session_id','$date','$time','$ip','$user_agent')
";

if(mysqli_query($conn,$insert)){


die($response);


}else{



die("An unkown error has occur,please try again.");


}




}else{


die("Please select to ON or OFF Two factor Authentication.");



}
