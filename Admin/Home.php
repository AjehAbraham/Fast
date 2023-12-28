<?php
require_once "session.php";

//var_dump($_COOKIE);
require_once "Remember-me.php";


if(!isset($_SESSION["Admin_key"])){

if(isset($_COOKIE["Remember-admin"]) && isset($_COOKIE["Admin_hash_key"])){



  if(!empty($_COOKIE["Remember-admin"]) && !empty($_COOKIE["Admin_hash_key"])){


header("Location: Auth");
exit;
  
  }

//COOKIE VALUE IS EMPTY JUST UNSET COOKIE//


unset($_COOKIE["Remember-admin"]);
unset($_COOKIE["Admin_hash_key"]);

setcookie("Remember-admin","", time() - 86400);

setcookie("Admin_hash_key","", time() - 86400);



}

}

?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/Home.css">  
    <link rel="stylesheet" href="Css/header.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>FastShop Admin</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php 
require_once "header.php"; 

require_once "Loader.php";

if($result["Status"] == "Master"){


}else{
  
  die("<h3 style='color: red; text-align: center;'> You cannot view this page content,Access denied!</h3>");
}
?>

<div class="form-container">

<h1>Add shopping items</h1>

<form method="post" id="Upload-items-form" >

<label><b>Items name</b></label>
<br>
<input type="text" name ="item-name"  placeholder="Enter item name"...>
<br>


<label><b>Items price(naira)</b></label>
<br>
<input type="number" name ="item-price"  placeholder="Enter item price"...>
<br>


<label><b>Items old price</b></label>
<br>
<input type="number" name ="item-discount-price"  placeholder="Enter item old price...">
<br>




<label><b>Item description:</b></label>
<br>
<textarea cols='12' rows='7' name="item-description" placeholder="describe or give more info about this item.."></textarea>

<br>

<br>
<label><b>Quantity:</b></label>
<br>
<input type="number" name="quantity" placeholder="How many of this items do you have...." >
<br>

<label><b>Add item image</b></label>
<br>
<p class="Upload-btn"><label for="file">Add Image</p>
<input type="file" name="item-image"  onchange ="loadFile(event)"
style="display:none;" id="file">

<img id="output" width="130px">

<br>


<p class="open-transaction-pin">Proceed</p>

<?php require_once "transaction-pin-box.php"; ?>
</div>



<script>

  
$(document).ready(function (e) {

$("#Upload-items-form").on('submit', (function(e){


  e.preventDefault();

document.querySelector(".loader-container-overlay").style.display ="block";


   $.ajax({
 
    url: 'Upload item',
type : 'POST',
data: new FormData(this),
cache: false,
contentType: false,
processData: false,
    success:function(Data){

  

document.querySelector(".loader-container-overlay").style.display ="none";

     
     document.querySelector(".error_message").innerHTML = Data;


if(Data == "\r\nok"){
  
  document.querySelector("#Upload-items-form").reset();
  
  document.querySelector(".error_message").innerHTML = "";
  
  document.querySelector("#output").innerHTML = "";

    alert("uplopaded");

}else if(Data == "ok"){

  document.querySelector("#Upload-items-form").reset();
  
  document.querySelector(".error_message").innerHTML = "";

  document.querySelector("#output")= " ";
  
  alert("Uploaded");
}

    },
    error:function(Data){
      document.querySelector(".error_message").innerHTML = Data;


document.querySelector(".loader-container-overlay").style.display ="none";


    }
  
   });



}));


  });

var loadFile = function(event){
var image = document.querySelector("#output");
image.src = URL.createObjectURL(event.target.files[0]);

};
</script>

<script src="Js/Home."></script>

<script src="Js/header.js"></script>
