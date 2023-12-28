<?php
session_start();
   require_once "database_connection.php";

$user_record = "SELECT * FROM Register_db WHERE id = '$_SESSION[User]'";
   
   
$user_result = mysqli_query($conn,$user_record);


$New_user = mysqli_fetch_assoc($user_result);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/track-order.css">
    
    <link rel="stylesheet" href="Css/footer.css">
    
    <link rel="stylesheet" href="Css/header.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Track order</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">

</head>
<body>
<?php
require_once "header.php";
require_once "Network.php";

require_once "Loader.php";

?>
<div class="form-container">

<form id="Track_order">

<label>Tracking Number</label>
<br>
<input type="search" name="Track_code" placeholder="Your Tracking number">

<input type="submit" value="Track">
</form>
</div>
<p class="error_message"></p>




<script src="Js/track-order.js"></script>

<?php
require_once "footer.php"; ?>
</body>
</html>