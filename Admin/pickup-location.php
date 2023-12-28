<?php

require_once "session.php";

if($result["Status"] == "Master"){


}else{
  
  die("<p>You cannot view this page,Access denied!</p>");
}



?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/pickup-location.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Pickup Locations</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php";
?>


<div class="form-container-fluid">
  <form id="search-bar">
<label><b>Search for locations</b></label>
<br>
<input type="search" name="search-location" placeholder="search for pickup locations using state or LGAs..."><br>

<p class="error_messages"></p>

<input type="submit" value="Find Location">
</form>
</div>



<p class="open-btn-overlay">Add Location</p>


<div class='form-overlay-container'>
<div class="form-container-fluid-two">
  
 <p> <i class="fa fa-close" id='closeForm'></i></p>
  <p>Add New Location</p>
  <form id="location-form">
  <label><b>Country</b></label>
  <br>
 <select name="country">
  <option></option>
  <option>Nigeria</option>
  <option>Ghana</option>
  <option>South Africa</option>
 </select>
 <br>

 <label><b>State</b></label>
 <br>
 <input type="text" name="state" placeholder="state...">
 <br>



 <label><b>LGA</b></label>
 <br>
 <input type="text" name="LGA" placeholder="Local goverment or popular location..">
 <br>

 <br>
            <label><b>Agent name</b></label><br>
            <input type='text'  name='agent-name' placeholder='Enter agent full name...'>
            
            <br>
            <label><b>Agent email</b></label>
            <br>
            <input type='email' name='agent-email' placeholder='Pickup agent email...''>
            
            <br>


 <label><b>Address</b></label><br>

 <textarea cols="9" name="Add" rows="6" placeholder="Pickup Location Address..."></textarea>

 <br><h1 class="open-transaction-pin">confirm location</h1>

    </div>

    </div>

<?php

require_once "transaction-pin-box.php";

require_once "db_connection.php";

//FETCH ALL LOCATIONS//

$location = "SELECT * FROM Delivery_locations";

$location_result = mysqli_query($conn,$location);

if(mysqli_num_rows($location_result) > 0){

    echo "
     
<div class='location-container'>
<p>Delivery Location(s)</p>
<table>
  <tr>
    <th>Country</th>
    <th>State</th>
    <th>LGA</th>
    <th>Address</th>
    <th>Agent email</th>
    <th>Agent name</th>
    <th>Status</th>
    <th>Edit info</th>
  </tr>
    ";
while($all_location = mysqli_fetch_assoc($location_result)){


        echo "
        <tr>
          <td>$all_location[Country]</td>
          <td>$all_location[State]</td>
          <td>$all_location[LGA]</td>
          <td>$all_location[Address]</td>
          <td>$all_location[Agent_email]</td>
          <td>$all_location[Agent_full_name]</td>
          <td>$all_location[Status]</td>
          <td><a href='edit-pickup-location?name=$all_location[State]&id=$all_location[id]'>Edit</a></td>
        </tr>
     
      
        ";
      
      


    }

    echo "   
    </table>
    </div>";


}else{

echo "<p style='text-align: center; color: red;'>No pickup Location</p>";


}


mysqli_close($conn);

require_once "Loader.php";
?>

<script src="Js/pickup-location.js"></script>
  
</body>
</html>
