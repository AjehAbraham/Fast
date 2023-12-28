<?php
session_start();
//session_regenerate_id();


if(!isset($_SESSION["Reset_email"])){


   // header("Location: Error");

   die("Invalid request or an error has occured.");
    exit;
}




if($_SERVER["REQUEST_METHOD"] == "POST"){



if(isset($_POST["confirm-password"]) && isset($_POST["new-password"])){


$new_password = htmlspecialchars($_POST["new-password"]);


if(empty($_POST["new-password"])){



    die("Please enter New password");

}else if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$new_password)){
    
    
    die("New password must contain at least one uppercase,one lowercase,one special charaters and at least must be 8 in length.");
    
    
    }else{



$new_password = htmlspecialchars($new_password);


}





$confirm_password = htmlspecialchars($_POST["confirm-password"]);


if(empty($confirm_password)) {


    die("Please re-enter password");


}else if($confirm_password != $new_password){


    die("Confirm password and new password mismatch");


}else{



    $confirm_password = htmlspecialchars($confirm_password);
}








require_once "database_connection.php";


$new_password = mysqli_real_escape_string($conn,$new_password);

$confirm_password = mysqli_real_escape_string($conn,$confirm_password);



//FETCH USER ID USING THIER EMAIL IN SESSION//


$user = "SELECT * FROM Register_db WHERE Email ='$_SESSION[Reset_email]'";


$user_details = mysqli_query($conn,$user);


//NO NEED TO CHECK IF RECORD IS FOUND BECAUSE WE SET THE SESSION OURSELVES

$result = mysqli_fetch_assoc($user_details);



//INSERT OTP TO DATABASE //

$otp = rand(475934,1927362);

$hash = password_hash($otp,PASSWORD_DEFAULT);



$date = htmlspecialchars(date("Y/m/d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
// $User_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);

$exipre = 0;

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


$insert = "INSERT INTO Auth_otp_table(User_id,Otp,Expire,Hash,Date,Time,Ip,User_agent)
VALUES('$result[id]','$otp','$exipre','$hash','$date','$time','$ip','$user_agent')
";



if(mysqli_query($conn,$insert)){



    $user_name = $result["First_name"];


    $to = $result["Email"];

    $from ="Lazerwavesupport";
    
    $fromName ="FastShop";
    $subject ="Reset Password";
    
    
    $htmlcontent ="
    
    <h1 style='text-align: center;color: white;background-color: rgb(0,102,123);padding: 10px 10px;margin: auto;'>
    
    FastShop</h1>
    
    <p style='margin-left: 5px;'>Hi ". $user_name.",
    
    <p>New Login detected for your account<br>
    Your Otp is". $otp."Please do not share this code
    
    Ip: ". $ip."<br>
    Device: ". $user_agent."<br>
    
    <p>If you do not recognise this device/login details please click <a href='fast8shop.000webhostapp.com/Main/Forgot password'> Here</a>
     to Reset your password.
    
    ";
    
    
    $headers ="MIME-Version: 1.0". "\r\n";
    
    $headers .='From: '.$fromName.'<'.$from.'>'. "\r\n";
    /*
    $headers .= 'CC: LazerwaveHelp.com'."\r\n";
    
    $headers .="Bcc: L*/
    
  /*  if(mail($to,$subject,$htmlcontent,$headers)){
    
    
        //MAIL WAS SENT SUCCESSFULLY
    
    
    }else{
    
    
    //FAILED TO SEND MAIL//
    
    
    }*/




$_SESSION["UserID"] = $result["id"];


$password = password_hash($new_password,PASSWORD_DEFAULT);
$_SESSION["Password"] = $password;

die("success");

}else{


    die("Error occur while porcessing your request");


}



}else{


die("Request error");

}



}

