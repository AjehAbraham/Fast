<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}
if(isset($_SESSION["Reset_email"]) && isset($_SESSION["Password"]) && isset($_SESSION["UserID"])){


if($_SERVER["REQUEST_METHOD"] == "POST"){



    if(isset($_POST["otp"]) && !empty($_POST["otp"])){


        $otp = (int) filter_var($_POST["otp"],FILTER_SANITIZE_NUMBER_INT);

$userid = $_SESSION["UserID"];
$password = $_SESSION["Password"];

$email = $_SESSION["Reset_email"];
require_once "database_connection.php";

$otp = mysqli_real_escape_string($conn,$otp);
$otp = stripslashes($otp);
$otp = trim($otp);


        //CHECK FOR OTP MACTH IN DATABASE//

        $select = "SELECT * FROM Auth_otp_table WHERE User_id='$userid' AND NOW() <= DATE_ADD(Date,INTERVAL 10 MINUTE) ORDER BY id DESC LIMIT 1";


        $result = mysqli_query($conn,$select);


        if(mysqli_num_rows($result) > 0){


            //CHECK IF OTP MATCHES//
$results = mysqli_fetch_assoc($result);

if(password_verify($otp,$results["Hash"]) == "password_hash"){

    //CHECK IF OTP HAS BEEN USED//

    if($results["Expire"] >= 1){

        //OTP HAS BEEN USED//
        die("otp has expired");

    }

    //UPDATE USER PASSWORD SAFELY//

    $update = "UPDATE Register_db SET Password ='$_SESSION[Password]' WHERE id='$results[User_id]'";

    if(mysqli_query($conn,$update)){


        //UDPATE OTP TABLE AND MAKE OTP INVALID SO THAT USER CANNOT USE IT AGAIN//

        $updats = "UPDATE Auth_otp_table SET Expire='1' WHERE User_id='$results[User_id]' AND Otp='$otp'";

        if(mysqli_query($conn,$updats)){


            //DO NOTHING
        }else{

            //STILL DO NOTHING//

        }
        //DESTROY SESSION SO THAT USER CANNOT ACCCESS THE PAGE AGAIN//

        session_destroy();

        die("success");


    }else{


        die("Error occured updating your password");

    }


}else{

    //OTP DOES NOT MATCH

    die("Invalid OTP");
}

        }else{


            //NOT OTP HAS BEEN GENERATED//

            die("Your session has expire,please click <a href='forgot-password'>here</a> to restart");

        }

    }else{


        die("Please enter your OTP");
    }


}else{

    die("Invalid request type");
}





}else{


    die("Your session has expire");
}