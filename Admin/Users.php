<?php
require_once "session.php";

if($result["Status"] == "Master"){


}else{

  die("Authorization Failed.");
}



?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/User.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Shop Users</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php";

?>

            <div class="header-container-o">
            
              <form id="form">
        <input type="search" name="info" placeholder="Enter email or phone number..."><br>
       <br> <input type="submit" value="Find user">
            </form></div>
    
            <p class="error_message"></p>


        

<?php require_once "Loader.php";?>


            <script src="Js/User.js">
            </script>



</body>

</html>