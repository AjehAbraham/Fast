<?php

if(!isset($_COOKIE["Remember-admin"]) && !isset($_COOKIE["Admin_hash_key"])){


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
    


$cookie_name = "Remember-admin";

$cookie_value = $_SESSION["Admin_key"];

$cookie2_name = "Admin_hash_key";

$cookie_2_value = rand(). uniqid(). rand().uniqid();

//SETCOOKIE FOR JUST FIVE HOURS//

setcookie($cookie_name,$cookie_value, time() + 86400 * 7, "/");

setcookie($cookie2_name,$cookie_2_value, time() + 86400 * 7,"/" );

$hash = password_hash($cookie_2_value,PASSWORD_DEFAULT);

$expire = 0;

require_once "db_connection.php";

$insert_data = "INSERT INTO Admin_Auth_table(
Admin_id,Hash_id,Cookie_hash,Expire,Date,Time,Ip,User_agent
)
VALUES('$_SESSION[Admin_key]','$hash','$cookie_2_value','$expire','$date','$time','$ip','$user_agent')
";


if(mysqli_query($conn,$insert_data)){


//DO NOTHING//


}else{


echo "<p style='text-align: center;color: red;'>Errro occur trying to save device info</p>";


}


}else{


//DO NOTHING//


}