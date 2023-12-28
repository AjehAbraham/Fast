<?php
session_start();

if(!isset($_SESSION["Reset_email"]) && !isset($_SESSION["UserID"])){


    header("Location: forgot-password");
    exit;
}

?>




<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/verify-otp.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Verify OTP</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<?php 

require_once "Network.php";

require_once "Loader.php";

?>

<div class="form-container">


<p>Verify otp <i class="fa fa-cogs"></i></p>

<form id="forgot-password">
<label><b>Otp</b></label><br>



<input type="number" inputmode="numeric"  name="otp" placeholder="enter otp sent to your emai...."  
inputmode="numeric" style="-webkit-text-security: disc" autofocus="off">
<br>
<br>
<input type="submit" value="Verify Otp">

<p class="error_message"></p>

</form>

  </div>

<script src="Js/verify-otp.js"></script>
</body>
</html>
