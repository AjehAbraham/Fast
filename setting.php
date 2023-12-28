<?php
require_once "sessionPage.php";



$two = "SELECT * FROM Two_factor_auth WHERE User_id='$_SESSION[User]' ORDER BY id DESC LIMIT 1";

$two_result = mysqli_query($conn,$two);

if(mysqli_num_rows($two_result) > 0){



  $check_factor = mysqli_fetch_assoc($two_result);


  if($check_factor["Status"] == "On"){

$check = "checked";

  }else if ($check_factor["Status"] == "Off"){


    $check = "";

  }


}else{

$check = "";

}



?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Css/setting.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
          <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>


<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>Setting</title>


<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">

      </head>
      <body>


<p class="Two_factor_error_message"></p>
<form id="Two-factor"><input type="text" name="Two-factor" style="display: none;"></form>
<div class="setting-container">
  <p onclick="OpenPassword()"><i class="fa fa-key"></i> Change Password</p>
  <form id="Two_factor_form"><p><i class="fa fa-lock"></i> Two factor Authentication
<label class="switch">
        <input type="checkbox"  id="two_factor_btn" <?php echo $check; ?> name="Two_factor" onclick="TwoFactor(event)">
        <span class="round slider">
          
        </span></label><br></p></form>


        <p class="Open__history_btn"><i class=" fa fa-database"></i> Login History</p>

        
  <p onclick="alert('comimg shortly')"><i class="fa fa-user-times"></i> Delete Account</p>
</div>



<div class="change-passowrd-overlay">
  <div class="change-password-container">

  <?php  
  
require_once "Network.php";
  require "Loader.php"; ?>

    <p>Change Password <i class="fa fa-lock"></i></p>
    <p class="error_message" style="color: red;"></p>
    <form id="FormData">
    <label>Old password</label>
    <br>
    <input type="password" name="Old_password"  style="-webkit-text-security: disc;" placeholder="Your old password...">
    <br>
    <label>New password</label>
    <br>
    <input type="text"name="New_password"  style="-webkit-text-security: disc;" placeholder="Your New password...">
    <br>
    <input type="submit" value="Change password"></form>

    <p><i class="fa fa-close" onclick="closePassword()"></i></p>
  </div>
</div>



<div class='container-fluid'>
<p><i class='fa fa-close' id='close_history_btn'></i></p>

<?php



$his = "SELECT * FROM Login_history WHERE User_id='$_SESSION[User]' ORDER BY id DESC";


$log_result = mysqli_query($conn,$his);

if(mysqli_num_rows($log_result) > 0){

echo "<h1 style='font-size: 18px; color: rgb(0,102,123);margin-left: 5px;'>Note Locations might
 not be accurate.</h1>";


while($logins = mysqli_fetch_assoc($log_result)){


$date =date("d D F Y",strtotime($logins["Date"]));

$ip = $logins["Ip_addr"];
$device_name = $logins["User_agent"];

    if($logins["Session_id"] == session_id()){

$status = "Active (This Device)";
$sataus_color= "style='color: mediumseagreen'";

$online = "Online";

    }else{



      $status = "InActive";
      $sataus_color= "style='color: red'";

      $online = "Offline";
    }



    if($logins["Time"] >= 12){

$time = $logins["Time"]. "PM";


    }else{

      $time = $logins["Time"]."AM";



    }



echo " 
<p><i class='fa fa-circle' $sataus_color></i>  $status <br>
    $date at $time <br>Device name: $device_name. 
    <br>Status: $online <br>Ip address $ip.<br>
    Location: (Precise).
    </p>";
    


  }






}else{


  echo "<p>No history found.</p>";



}


echo "</div>";


?>



<?php require "Loader.php"; 

?>

</div>


<script src="Js/setting.js"></script>

</body>
</html>