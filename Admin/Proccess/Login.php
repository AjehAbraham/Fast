<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location: Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST["email"])){


if(isset($_POST["password"])){



    if(empty($_POST["email"]) && empty($_POST["password"])){



die("Please enter your email and password to procceed.");


    }else{


$email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);


$email = htmlspecialchars($email);

$pass =htmlspecialchars($_POST["password"]);


require_once "db_connection.php";


$email = mysqli_real_escape_string($conn,$email);

//$password =mysqli_real_escape_string($conn,$password);

$email = stripslashes($email);

$fetch_data = "SELECT * FROM Admin_Register_db WHERE Email='$email'";



$resutls = mysqli_query($conn,$fetch_data);



if(mysqli_num_rows($resutls) > 0){



$result = mysqli_fetch_assoc($resutls);


//var_dump($result);

if(password_verify(htmlspecialchars($_POST["password"]),$result["Password"]) == "password_hash"){

    if($result["Admin_permit"] == "Granted"){


    }else{

        if($result["Admin_permit"] === "Suspend"){

            die("Your account has been <b>".$result["Admin_permit"]. "ed</b>,please contact Admin for futher assistance");
        }elseif($result["Admin_permit"] == "Deny"){


            die("Access to you account has been <b>".$result["Admin_permit"]."</b>,Please contact admin");
        }

        die("Your account has been <b>".$result["Admin_permit"]. "</b>,please contact Admin for futher assistance");
    }

//session_start();
session_regenerate_id();

$_SESSION["Admin_id"] = $result["id"];

$_SESSION["Admin_hash"] = uniqid(). rand(). uniqid();


//INSERT HASH TO DATABASE AND GENERATE OTP///
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

$insert = "INSERT INTO Admin_Login_otp(Admin_id,Admin_hash,Otp,Date,Time,Ip,User_agent)

VALUES('$_SESSION[Admin_id]','$hash','$otp','$date','$time','$ip','$user_agent')
";


if(mysqli_query($conn,$insert)){

//SEND ADMIN EMAIL OF THE OTP//


$to = $result["Email"];

$from ="Lazerwavesupport";

$fromName ="FastShop";
$subject ="New Login Alert";


$htmlcontent ="

<h1 style='text-align: center;color: white;background-color: rgb(0,102,123);padding: 10px 10px;margin: auto;'>

FastShop</h1>

<p style='margin-left: 5px;'>Hi Admin,

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
/*
if(mail($to,$subject,$htmlcontent,$headers)){


    //MAIL WAS SENT SUCCESSFULLY


}else{


//FAILED TO SEND MAIL//


}

*/

$satus = "Pending";

$admin_id = $result["id"];

require_once "Admin session.php";

die("ok");


}else{


die("Failed,please re-try.");



}





}else{


die("Invalid email or password");


}



}else{


    die("Invalid login credientials");



}


    }








}else{


//NO PASSWORD//




}




}else{

//NO EMAIL



}


mysqli_connect_close($conn);

}

?>