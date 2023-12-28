<?php
session_start();
session_regenerate_id();

if(isset($_SESSION["Admin_key"])){

header("Location: Home");
exit;

}else{

    if(isset($_COOKIE["Remember-admin"]) && isset($_COOKIE["Admin_hash_key"])){
    
    
    
      if(!empty($_COOKIE["Remember-admin"]) && !empty($_COOKIE["Admin_hash_key"])){
    
    
    header("Location: Auth");
    exit;
      
      }
    
    //COOKIE VALUE IS EMPTY JUST UNSET COOKIE//
    
    
    unset($_COOKIE["Remember-admin"]);
    unset($_COOKIE["Admin_hash_key"]);
    
    setcookie("Remember-admin","", time() - 86400,"/");
    
    setcookie("Admin_hash_key","", time() - 86400, "/");
    
    
    
    }
    
    
    



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

<h1>Admin Login</h1>

<p>Hi Admin.</p>

<form method="post" id="form_id">

<lable for="email"><b>E-mail:</b></lable><br>

<input type="email" name="email" placeholder="mail...."><br>


<br>
<lable for="email"><b>Password:</b></lable><br>

<input type="password" name="password"  style="-webkit-text-security: disc" placeholder="your password...."><br>

<p class="error_message"></p>
<input type="submit" value="Login" id="Login">
<p><a href='forgot-password'>Forgot password?</a></p>
</div>

<?php

require_once "Loader.php";

?>

<script>
  
document.querySelector("#Login").addEventListener("click",Login);
function Login(event){
  
    event.preventDefault();
  
 document.querySelector(".loader-container-overlay").style.display ="block";
  
  var form = $("#form_id");
  
  var url = "Proccess/Login";
  
  $.ajax({
  
  type : 'POST',
  url : url,
  data: form.serialize(),
  dataType: 'json',
  encode: true,
  success: function(data){
  
  console.log();
  
  document.querySelector(".loader-container-overlay").style.display ="none";
  
  
  var error_message = document.querySelector(".error_message");
  
  error_message.innerHTML = data.responseText;
  
  if(data.responseText === "\r\nok"){

    document.querySelector("#form_id").reset();
  
window.location.href ="Verify login";

alert("success");
  }
    
  
  },
  error: function(data){
  
   document.querySelector(".loader-container-overlay").style.display ="none";
  
  
  
   var error_message = document.querySelector(".error_message");
  
 error_message.innerHTML = data.responseText;

  //error_message.innerHTML = JSON.stringify(data);
  
  if(data.responseText === "ok"){

    error_message.innerHTML = "";
    alert("sucess");

    document.querySelector("#form_id").reset();
  
window.location.href ="Verify login";


  }
  
  
  
  
  
  }
  });
   
    }
    </script>

<!--script src="Js/Login.js"></script-->
</body>

</html>