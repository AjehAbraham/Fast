<?php

require_once "session.php";

//var_dump($_COOKIE);


if($result["Status"] == "Master"){


}else{
  
  die("<p>You cannot view this page,Access denied!</p>");
}

?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/create-admin.css">
    
    <link rel="stylesheet" href="Css/view-admin.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Create Admin</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php";

?>


<div class="form-container-o">
  <form id="search-admin">

  <label><b>Search Admin</b></label><br>
  <input type="search" name="Admin-info" placeholder="Enter Admin email,Admin id,Admin pickup Location...">
  <br>
  <br>
  <input type="submit" value="Find Admin">
  </form>
  <p class="error_messages"></p>
</div>


<div class="container-fluid-box">
</div>




<div class="form-container">

<h1>Create Admin </h1>

<form  id="AdminForm">

<lable for="Mail"><b>E-mail:</b></lable><br>

<input type="text" name="email" placeholder="mail...."><br>


<br>

<label><b>Category</label>
<select name="category">

 <option></option>
 <option>Customer care</option>
 <option>Pickup Agent</option>
 <option>Master</option>
</select>
<br>
<p class="open-transaction-pin">Proceeed</p>

</div>
<?php 
require_once "transaction-pin-box.php";
require_once "view-admin.php";
require_once "Loader.php"; ?>
<script src="Js/create-admin.js"></script>
</body>

</html>