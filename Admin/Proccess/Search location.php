<?php
  
require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}




if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST["search-location"])){


    if(!empty($_POST["search-location"])){

$location = htmlspecialchars($_POST["search-location"]);

$location = filter_var($location,FILTER_SANITIZE_STRING);

$location = stripcslashes($location);

require_once "db_connection.php";

$location = mysqli_real_escape_string($conn,$location);


$fetch_location = "SELECT * FROM Delivery_locations WHERE State ='$location' OR LGA='$location'";

$location_result = mysqli_query($conn,$fetch_location);

if(mysqli_num_rows($location_result) > 0){

    echo "
     
<div class='location-container'>
<p>Delivery Locations</p>
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

while($results = mysqli_fetch_assoc($location_result)){



    echo "
    <tr>
      <td>$results[Country]</td>
      <td>$results[State]</td>
      <td>$results[LGA]</td>
      <td>$results[Address]</td>
      <td>$results[Agent_email]</td>
      <td>$results[Agent_full_name]</td>
      <td>$results[Status]</td>
      <td><a href='edit-pickup-location?name=$results[State]&id=$results[id]'>Edit</a></td>
    </tr>
 
  
    ";



}


echo "</table></div>";


}else{


$fetch_location = "SELECT * FROM Delivery_locations WHERE State LIKE '%$location%' OR LGA LIKE '%$location%' OR Country LIKE '%$location%'";


$location_result = mysqli_query($conn,$fetch_location);

if(mysqli_num_rows($location_result) > 0){


    echo "

    <p>Related search </p>
     
<div class='location-container'>
<p>Delivery Locations</p>
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

while($results = mysqli_fetch_assoc($location_result)){



    echo "
    <tr>
      <td>$results[Country]</td>
      <td>$results[State]</td>
      <td>$results[LGA]</td>
      <td>$results[Address]</td>
      <td>Ajehabraham61@gamil.com</td>
      <td>Ajeh paul Abraham</td>
      <td>$results[Status]</td>
      <td><a href='edit-pickup-location?name=$results[State]&id=$results[id]'>Edit</a></td>
    </tr>
 
  
    ";



}


echo "</table></div>";





}else{


    die("No Location Found,Please try be more specific");


}



}

    }else{


        die("Please enter location State or LGA");

    }



}else{


    header("Location: Error");
    exit;
}



}else{


header("Location: Error");
exit;

}
