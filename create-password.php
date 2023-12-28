<?php
session_start();
//session_regenerate_id();


if(!isset($_SESSION["Reset_email"])){


    header("Location: Error");
    exit;
}



?>




<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/create-password.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>New password</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<?php require_once "Loader.php";

?>

<div class="form-container">


<p>Create password <i class="fa fa-cogs"></i></p>

<form id="forgot-password">
<label><b>New password</b></label><br>



<input type="password"  name="new-password" placeholder="Your new password...."autofocus="off" autocomplete="off">
<br>
<br>

<label><b>Confirm  password</b></label><br>



<input type="password"  name="confirm-password" placeholder="Re-enter new password...." autofocus="off" autocomplete="off">
<br>
<p class="error_message"></p>


<input type="submit" value="Change password">



</form>

  </div>


<script src="Js/create-password.js"></script>
</body>
</html>
