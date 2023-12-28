<?php
session_start();
session_regenerate_id();

?>




<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/forgot-password.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Forgot password</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<?php require_once "Loader.php";

?>

<div class="form-container">


<p>Forgot password <i class="fa fa-cogs"></i></p>

<form id="forgot-password">
<label><b>Email</b></label><br>



<input type="email"  name="email" placeholder="Your Email....">
<br>
<br>
<input type="submit" value="Procced">

<p class="error_message"></p>

</form>

  </div>


<script src="Js/forgot-password.js"></script>

</body>
</html>
