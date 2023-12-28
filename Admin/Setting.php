<?php
require_once "session.php";

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/setting.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Setting</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<div class="setting-container-fluid">
    <p><i class="fa fa-cogs"></i> Settings</p>

    <p class="open-change-password-btn"><i class="fa fa-lock" ></i> Change password</p>

    <p id="secretKey-btn"><i class="fa fa-key"></i> Change secret key</p>
    <p class="open-email-btn"><i class="fa fa-envelope"></i> Change Email</p>
</div>

  <div class="change-password-container-overlay">
    <p><i class="fa fa-lock"></i> Change password</p>

    <p class="error_message"></p>
<form id="FormData">
    <label><b>Old password </b></label><br>
    <input type="text" style="-webkit-text-security: disc" name="old_password" placeholder="your old password..."><br>

   
    <label><b>New password </b></label><br>
    <input type="text" style="-webkit-text-security: disc" name="new_password" placeholder="New password..."><br>


<input type="submit" value="Change password" ></form>

<p><i class="fa fa-close" id='close-change-password-btn'></i></p><br>
</div>




        
  <div class="change-secret-key-container-overlay">
    <p><i class="fa fa-key"></i> Change Secret key</p>
    <p class="secret_error_message"></p>
<form id="keyForm">
    <label><b>Old Key </b></label><br>
    <input type="text" style="-webkit-text-security: disc" name="old_key" placeholder="your old secret key..."><br>

   
    <label><b>New secret key </b></label><br>
    <input type="text" style="-webkit-text-security: disc" name="new_key" placeholder="New secret key..."><br>


<input type="submit" value="Change secret key" id="secret-btn"></form>

<p><i class="fa fa-close" id='close-secret-key-btn'></i></p><br>
</div>



<div class="change-email-container-overlay">
    <p><i class="fa fa-envelope"></i> Change Email</p>
    <p class="email_error_message"></p>
<form id="emailForm">
    <label><b>Password </b></label><br>
    <input type="text" style="-webkit-text-security: disc" name="password" placeholder="your password..."><br>

   
    <label><b>New E-mail </b></label><br>
    <input type="text"  name="email" placeholder="New mail..."><br>


<input type="submit" value="Change Email"></form>

<p><i class="fa fa-close" id="close-email"></i></p><br>
</div>
<?php require_once "Loader.php"; ?>


<script src="Js/settings.js"></script>


</body>
</html>