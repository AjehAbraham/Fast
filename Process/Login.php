<?php
session_start();
session_regenerate_id();
if($_SERVER["REQUEST_METHOD"] == "POST"){


    if(isset($_POST["email"]) && !empty($_POST["email"])){

$email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);

        if(empty($email)){

            die("Invalid email");
        }else{


            $email = htmlspecialchars($email);
        }


    }else{

        die("Please enter your email");
    }

if(isset($_POST["password"]) && !empty($_POST["password"])){

$password = htmlspecialchars($_POST["password"]);

}else{

    die("please enter password");
}

//require_once "database_connection.php";


$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Fastshop_db";


$conn = mysqli_connect($servername,$username,$password,$database_name);

if (!$conn){

    die("error". mysqli_connect_error());
}else{
   /* echo "connected sucessfully";*/
}


$email = mysqli_real_escape_string($conn,$email);
$email = trim($email);
$email = stripslashes($email);

$password = mysqli_real_escape_string($conn,$password);
$password = stripslashes($password);

$select = "SELECT * FROM Register_db WHERE Email='$email'";

$result = mysqli_query($conn,$select);

if(mysqli_num_rows($result) > 0){


    $results = mysqli_fetch_assoc($result);

    if(password_verify(htmlspecialchars($_POST["password"]), 
    $results["Password"]) == "password_hash"){

$_SESSION["User"] = $results["id"];

$checkBlockID= $results["id"];

require_once "check-block-acct.php";


$_SESSION["User"] = $results["id"];

require_once "Login history.php";
require_once "save remember me.php";
require_once "save session id.php";

die("ok");



    }else{

        die("Invalid username or password");
    }


}else{

    die("User does not exits");
}



}else{

    header("Location: Error");
    exit;
}