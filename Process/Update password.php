<?php
require_once "sessionPage.php";
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


//$session_id = session_id();


if(isset($_POST["Old_password"])){


if(isset($_POST["New_password"])){


    $old_password = htmlspecialchars($_POST["Old_password"]);

$new_password = htmlspecialchars($_POST["New_password"]);



if(empty($old_password)){



die("Please enter your old password");




}else{



$old_password = htmlspecialchars($old_password);


}


if(empty($new_password)){


die("New password cannot be empty");



}else if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$new_password)){


die("New password must contain at least one uppercase,one lowercase,one special charaters and at least must be 8 in length.");


}else{


    $new_password =htmlspecialchars($new_password);




}



//CHECK PASSWORD WITH DATABASE//


$fetch = "SELECT * FROM Register_db WHERE id ='$_SESSION[User]'";


$password_result = mysqli_query($conn,$fetch);


$pass_result = mysqli_fetch_assoc($password_result);



if(password_verify($new_password,$pass_result["Password"]) == "password_hash"){

    die("Old password and New password cannot be thesame.");



}else if(password_verify($old_password,$pass_result["Password"]) == "password_hash"){


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



$hash = password_hash($new_password,PASSWORD_DEFAULT);

    //UPDATE PASSWORD//

require_once "database_connection.php";


$update = "UPDATE Register_db SET Password='$hash' WHERE id='$_SESSION[User]'";

if(mysqli_query($conn,$update)){

//UPDATE CHANGE PASSWORD HISTORY//


$insert = "INSERT INTO Change_password_history(User_id,Session_id,Date,Time,
Ip_addr,User_agent)
VALUES('$_SESSION[User]','$session_id','$date,''$time','$ip','$user_agent')

";


if(mysqli_query($conn,$insert)){




    
    die("ok");




}else{



die("Network error,please tyr again.");


}




}else{


die("Server erorr,please try again.");


}





}else{




    die("Old password is inncorrect");



}



}



}


