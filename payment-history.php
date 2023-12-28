<?php
require_once "sessionPage.php";

?>

<!DOCTYPE html>
<html lang="eng_US">

<head>
  <link rel="stylesheet" href="Css/Payment history.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet"
    href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
 

  <script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
  <title>Payment History</title>

  <!-- ajax and jquery link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

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


<div class="header-container">
      <b><a href="Home"><i class="fa fa-home"></i></a></b>
      <p><i class="fa fa-credit-card"></i> Payment history</p>
       <p class="refresh_data"><i class="fa fa-refresh" id="refresh_btn"></i> Refresh</p>

       <form id="form_id"><p><select name="payment" onchange="Select_data(event)">
     
        <option>All time</option>
        <option>This Month</option>
        <option>This week</option>
       </select></form></p>

   </div>
   
   <p class='error_message' style='color: red;text-align: center;'></p>

   


<script src="Js/Payment history.js"></script>

</body>
</html>