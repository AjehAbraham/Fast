<?php
//session_start();

if(isset($_SESSION["User"])){


  header("location: home");
  exit;
}else if(!$_SESSION["Refresh-session"]){

  header("Location: home");
  exit;
}

?>




<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Css/Login.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
          <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>

<!--link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">
-->

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>Login</title>



<!--link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">
-->

<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">

      </head>
      <body>
<?php

require_once "Network.php";

require_once "Loader.php";

?>


  

    <div class="form-container">
      <h1>Login</h1>
     
      <p style="text-align: center">Hi <?php echo $name;?>,Welcome back.
      <br> Your session has Expire,Please Login.</p>
      <form method="post" id="form_id">
      
      <label for="email"><b>Email:</b></label>
      <br>
      <input type="email" value="<?php echo $email; ?>" name="email" id="form_email" autofocus="off" size="25"   placeholder="Enter mail...">
      
      <br>
      
      <label for="password"><b>Password</b></label>
      <br>
      <input type="password" name="password" id="password" autofocus="off" autocomplete="off" size="25"  placeholder="password">
       <br>
   
      <label class="switch">
        <input type="checkbox"  onclick="show_password_text()">
        <span class="round slider">
          
        </span></label><b class="password-message"> show password</b>
      <br>
      

        <p class="error_message" style="color: red;text-align: center"></p>

          <input type="submit"  onclick="submit_form(event)">
      
      </form>
    
      </div>

      <script>  
  $(document).ready(function (e) {

$("#form_id").on('submit', (function(e){


e.preventDefault();

document.querySelector(".loader-container-overlay").style.display= "block";

$.ajax({

url: 'Process/Login',
type : 'POST',
data: new FormData(this),
cache: false,
contentType: false,
processData: false,
success:function(Data){

document.querySelector(".loader-container-overlay").style.display= "none";

document.querySelector(".error_message").innerHTML = Data;



if(Data == "ok"){

document.querySelector("#form_id").reset();

  alert("success");

  window.location.href="home";

}else if(Data == "\r\nok"){

  document.querySelector("#form_id").reset();

  alert("success");
  
  window.location.href="home";

}



},
error:function(Data){
document.querySelector(".loader-container-overlay").style.display= "none";

document.querySelector(".error_message").innerHTML = Data;

}

});



}));


});


function  show_password_text(){

  var password = document.querySelector("#password");

if (password.type === "password"){

password.type =("text");

document.querySelector(".password-message").innerHTML="Hide password";



}else{


    password.type =("password");

    document.querySelector(".password-message").innerHTML="Show password";


}

}


</script>
   
</body>
</html>



