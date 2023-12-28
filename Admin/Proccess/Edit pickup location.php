<?php


require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if(!$_SESSION["Admin_status"] == "Master"){


    die("Authorization Failed");

}


if($_SERVER["REQUEST_METHOD"] =="POST"){

if(isset($_SESSION["location_id"])){


}else{

    die("Error fetching Location.");
}


    $country = filter_var($_POST["country"],FILTER_SANITIZE_STRING);

    if(empty($country)){
    
        die("Pleas enter country");
    }else{
    
    if($country != "Nigeria"){
    
        die("Country ".$country. " Not supported yet");
    
    }else{
    
        
        $country = htmlspecialchars($country);
    }
    
    }
    
    
    $state = filter_var($_POST["state"],FILTER_SANITIZE_STRING);
    
    if(empty($state)){
    
        die("Please enter state");
    }else{
    
    $state = htmlspecialchars($state);
    
    }
    
    $lga = filter_var($_POST["LGA"],FILTER_SANITIZE_STRING);
    
    if(empty($lga)){
    
        die("Please enter LGA/Local goverment");
    }else{
    
        $lga = htmlspecialchars($lga);
    }
    
    
    $address = filter_var($_POST["Add"],FILTER_SANITIZE_STRING);
    
    if(empty($address)){
    
        die("Please enter address");
    }else{
    
    $address = htmlspecialchars($address);
    
    }
    
    
    
    $agent_name = filter_var($_POST["agent-name"],FILTER_SANITIZE_STRING);
    
    
    if(empty($agent_name)){
    
    
        die("Please enter agent name");
    }else{
    
    
        $agent_name = htmlspecialchars($agent_name);
    
    }
    
    
    $agent_email = filter_var($_POST["agent-email"],FILTER_VALIDATE_EMAIL);
    
    
    if(empty($agent_email)){
    
    
        die("please enter email");
    }else if(!filter_var($_POST["agent-email"],FILTER_VALIDATE_EMAIL)){
    
    
        die("Please enter a valid email address");
    }else{
    
    
        $agent_email = htmlspecialchars($agent_email);
    }
    
    
    
    
    
    $pin = (int) filter_var($_POST["secret-key"],FILTER_VALIDATE_INT);
    
    if(empty($pin)){
    
        die("Please enter Secret Key");
    }else{
    
        $pin = htmlspecialchars($pin);
    }
 
    

    if(isset($_POST["status"]) && !empty($_POST["status"])){

$status = htmlspecialchars($_POST["status"]);

$state = trim($status);


if($status == "Avaliable" || $state == "Unavaliable" || $status == "Busy"){


}else{

    
    die("Status <b>" .$status."</b> Not supported");
}

    }else{

        die("Please enter location status");
    }


    $state = strtoupper($state);
    $lga = strtoupper($lga);
    $country = strtoupper($country);
    
    $country = stripcslashes($country);
    $state = stripslashes($state);
    $lga = stripcslashes($lga);
    $address = stripcslashes($address);
    $pin = stripcslashes($pin);
    $agent_name = stripslashes($agent_name);
    $agent_email = stripslashes($agent_email);
    
    require_once "db_connection.php";
    
    $country = mysqli_real_escape_string($conn,$country);
    
    $state = mysqli_real_escape_string($conn,$state);
    
    $lga = mysqli_real_escape_string($conn,$lga);
    
    $address = mysqli_real_escape_string($conn,$address);
    
    $pin =mysqli_real_escape_string($conn,$pin);
    
    $agent_name = mysqli_real_escape_string($conn,$agent_name);
    
    $agent_email = mysqli_real_escape_string($conn,$agent_email);
    
    //$status = "Avaliable";
    
    
    //CHECK ADMIN PIN ANDCHECK IF IT MATCHES//
    
    
    $user_pin = "SELECT Pin FROM Admin_Register_db WHERE id='$_SESSION[Admin_id]'";
    
    
    $user_pin_result = mysqli_query($conn,$user_pin);
    
    
    $secret_key = mysqli_fetch_assoc($user_pin_result);
    

    if(password_verify($pin,$secret_key["Pin"]) == "password_hash"){


        $id = $_SESSION["location_id"];

$id = mysqli_real_escape_string($conn,$id);

//NOW UPDATE DATBASE INFO TO NEW ONE

$update = "UPDATE Delivery_locations SET

State='$state',LGA='$lga',Address='$address',Status='$status',Country='$country',

Agent_email='$agent_email',Agent_full_name ='$agent_name' 

WHERE State='$state' AND id='$id' OR id='$id' 
";

if(mysqli_query($conn,$update)){


    die("success");

}else{


    die("Error caught ". mysqli_connect_error());


}


        
    }else{

die("Invalid secret key");


    }



    mysqli_close($conn);
    
}else{


    header("Location: Error");
    exit;
}
