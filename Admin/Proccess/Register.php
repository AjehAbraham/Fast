<?php
session_start();
session_regenerate_id();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){



if(isset($_POST["secret-key"]) && !empty($_POST["secret-key"])){


    if(isset($_POST["password"]) && !empty($_POST["password"])){


        if(isset($_POST["agree"]) && !empty($_POST["agree"])){


$key = htmlspecialchars($_POST["secret-key"]);

$pass = htmlspecialchars($_POST["password"]);

$terms = filter_var($_POST["agree"],FILTER_SANITIZE_STRING);

$key = (int) filter_var($key,FILTER_SANITIZE_NUMBER_INT);

if(empty($key)){

    die("Please enter secret key");

}else if(strlen($key) <= 5){

    die("seceret key must be 6 in length");
}else{

    $key = htmlspecialchars($key);
}

if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$pass)){


    die("Password must contain at least one uppercase,one lowercase,one special character and at least 8 in length.");





}/*else if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{4,}$/",$key)){


        die("Secret key must contain at least one uppercase,one lowercase,one special character and at least 4 in length.");
    




}*/else{

//session_start();

if(!isset($_SESSION["Log_hash"])){

die("Authorization Failed");
//header("Location: Error");
exit;

}

    require_once "db_connection.php";

//FETCH ADMIN DATA// 

$select = "SELECT * FROM Admin_Register_Temp WHERE Hash_id='$_SESSION[Log_hash]'
 AND NOW() <= DATE_ADD(Date, INTERVAL 30 MINUTE)";


$datas = mysqli_query($conn,$select);


if(mysqli_num_rows($datas) > 0){


$data = mysqli_fetch_assoc($datas);

if(!password_verify($_SESSION["Log_hash"],$data["Hash"]) == "password_hash"){


    die("Authorization Failed");



}




$created_by = $data["Admin_id"];

$category = $data["Category"];

$email = $data["Email"];

$terms = "Yes";
$permit = "Granted";

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



    $pass = mysqli_real_escape_string($conn,$pass);

    $key = mysqli_real_escape_string($conn,$key);
    
    $terms = mysqli_real_escape_string($conn,$terms);
    
    $terms = stripcslashes($terms);
    
$key = password_hash($key,PASSWORD_DEFAULT);

$pass = password_hash($pass,PASSWORD_DEFAULT);



    $inert = "INSERT INTO Admin_Register_db(
Email,Password, Pin ,Admin_permit ,Created_by ,Status ,Date_created ,Time ,Ip ,User_agent ) 

VALUES('$email','$pass','$key','$permit','$created_by','$category','$date','$time','$ip','$user_agent')";



if(mysqli_query($conn,$inert)){

die("ok");


}else{


echo "Registration Failed,Please try again.";



}





}else{



    die("Failed,please ask for a new link to complte this action");


}





}






        }else{
        
        
        //NO SECRET KEY//
        
        die("Please agree to our terms");
        
        }







    }else{
    
    
    //NO PASSWORD//
    
    die("Please enter password");
    
    }





}else{


//NO SECRET KEY//

die("Please enter secret key");

}





}