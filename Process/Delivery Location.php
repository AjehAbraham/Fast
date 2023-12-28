<?php
require_once "sessionPage.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

////header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if($_SERVER["REQUEST_METHOD"] == "POST"){




if(isset($_POST["Location"])){

if(empty($_POST["Location"])){


//CHECK AND REMOVE SESSION JUST INCASE USER DOES NOT SELECT A PICKUP LOCATION//

if(isset($_SESSION["delivery_location"])){


    unset($_SESSION["delivery_location"]);
}



    die("<b style='color: red;'>Please select a Pickup location</b>");



}else{


$location = filter_var($_POST["Location"],FILTER_SANITIZE_STRING);

$location =htmlspecialchars($location);

    require_once "database_connection.php";


$fetch_location = "SELECT * FROM Delivery_locations WHERE LGA='$location'";


$results = mysqli_query($conn,$fetch_location);


if(mysqli_num_rows($results) > 0){

$result = mysqli_fetch_assoc($results);


if($result["Status"] === "Unavaliable" or $result["Status"] == "Busy"){


//CHECK AND REMOVE SESSION JUST INCASE USER DOES NOT SELECT A PICKUP LOCATION//

if(isset($_SESSION["delivery_location"])){


    unset($_SESSION["delivery_location"]);
}



die("<b style='color: red'>Pickup location ".$result["LGA"]." is ". $result["Status"]. " at the moment.</b>");


}


 $delivery_location = $result["Address"]. "<br>". $result["LGA"].
  "<br>". $result["State"] .",". $result["Country"].".";


  echo $delivery_location;

  $_SESSION["delivery_location"] = $delivery_location;

}else{

//CHECK AND REMOVE SESSION JUST INCASE USER DOES NOT SELECT A PICKUP LOCATION//

    if(isset($_SESSION["delivery_location"])){


        unset($_SESSION["delivery_location"]);
    }

    die("<b style='color: red;'>No pick up location found in ".$location."</b>");


}



}


}


mysqli_close($conn);
}