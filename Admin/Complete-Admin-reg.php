<?php
if(!isset($_SESSION["Log_hash"])){

  header("Location: Error");
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

?>



<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/Login.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>FastShop Admin Login</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>




<div class="form-container">

<h1>Admin Register</h1>
<p>Welcome <?php echo $email;?>,Please complete your registeration.<b>Note:</b>Secret key must contain number that will be 6 in length,while password must be 8 in length with at least one uppercase,one lowercase and one special character.</p>
<p style='color: red';>Page will Timeout in 12 minutes.</p>

<form id="FormID">

<lable><b>Secret key:</b></lable><br>

<input type="text" name="secret-key" placeholder="at least 6 digit secret key...." style="-webkit-text-security: disc"><br>


<br>
<lable><b>Password:</b></lable><br>

<input type="password" name="password"  style="-webkit-text-security: disc" placeholder="your password...."><br>

<label class="switch">
        <input type="checkbox" value="yes" name="agree">
        <span class="round slider">
          
        </span></label><b class="remember_me">I agree to terms</b>
      <br>
          
<p class="error_message"></p>
<input type="submit" value="Register" id="Login">


<script src="Js/complete-admin-reg.js"></script>
</body>
</html>