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

if(isset($_POST["email"])){



$email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);

if(empty($email)){


    die("Please enter your email");
}else{


$email = htmlspecialchars($email);

}


$email = stripcslashes($email);

require_once "database_connection.php";


$email = mysqli_real_escape_string($conn,$email);


$check = "SELECT * FROM Register_db WHERE Email='$email'";


$result = mysqli_query($conn,$check);


if(mysqli_num_rows($result) > 0){


$_SESSION["Reset_email"] = $email;

die("success");


}else{



    die("User does not exist. <br>Email ". $email. " was not found,please Register");
}


}else{


    die("Invalid Request");
}


mysqli_close($conn);


}