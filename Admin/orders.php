<?php

require_once "session.php";

?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/orders.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Customers Orders</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>


<div class="container-fluid">
<p>All Orders Details</p>

<form id="Find-order">
<input type="search" name="search" placeholder="Search using Tracking number or custome email...">
<br>
<br>
<input type="submit" value="Find Order">
<br><br>
</form>
</div>


<p class="error_message"></p>

<p class="Refresh-order">Refresh Data <i class="fa fa-refresh" id="Add-animation"></i></p>



<br><br>

<p class="Order_error_message"></p>


  <?php require_once "Loader.php"; ?>

<script src="Js/Orders.js"></script>
</body>
</html>
