<?php
require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

}



if(!$_SESSION["Admin_status"] == "Master"){


    die("Authorization Failed");

}


if($_SERVER["REQUEST_METHOD"] == "POST"){

$country = filter_var($_POST["country"],FILTER_SANITIZE_STRING);

if(empty($country)){

    die("Pleas enter country");
}else{

if($country != "Nigeria"){

    die("Country <b>".$country. "</b> Not supported yet");

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

/*
$state = strtoupper($state);
$lga = strtoupper($lga);
$country = strtoupper($country);
*/


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

$status = "Avaliable";


//CHECK ADMIN PIN ANDCHECK IF IT MATCHES//


$user_pin = "SELECT Pin FROM Admin_Register_db WHERE id='$_SESSION[Admin_id]'";


$user_pin_result = mysqli_query($conn,$user_pin);


$secret_key = mysqli_fetch_assoc($user_pin_result);


if(password_verify($pin,$secret_key["Pin"]) == "password_hash"){


    //USE PIN IS VALID//


    //NOW CHECK IF STATE ALREAD EXIT TO INSERT /


    $fetch_state = "SELECT * FROM Delivery_state WHERE State ='$state'";


$state_result = mysqli_query($conn,$fetch_state);


if(mysqli_num_rows($state_result) > 0){


//NO NEED TO ADD STATE BECAUSE IT ALREADY EXITS//

}else{


    //ADD STATE BECAUSE IT DOES NOT EXITS//
$status = "Avaliable";

    $add_state = "INSERT INTO Delivery_state (
State,LGA,Status)
VALUES('$state','$lga','$status')
";


if(mysqli_query($conn,$add_state)){



}else{


    die("Error caught ");
}


}



    //NOW CHECK IF STATE ALREAD EXIT TO INSERT /


    $fetch_lga = "SELECT * FROM Delivery_LGA WHERE LGA ='$lga'";


$lga_result = mysqli_query($conn,$fetch_lga);


if(mysqli_num_rows($lga_result) > 0){


//NO NEED TO ADD STATE BECAUSE IT ALREADY EXITS//

}else{


    //ADD STATE BECAUSE IT DOES NOT EXITS//
$status = "Avaliable";

    $add_lga = "INSERT INTO Delivery_LGA (
State,LGA,Status)
VALUES('$state','$lga','$status')
";


if(mysqli_query($conn,$add_lga)){



}else{


    die("Error caught ");
}


}

$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

//NOW INSERET ALL DATA INTO DELIVERY LGA//

$add_location = "INSERT INTO Delivery_locations(

Admin_id,State,LGA,Address,Status,Country,Agent_full_name,Agent_email,DATE,TIME
)
VALUES('$_SESSION[Admin_id]','$state','$lga','$address','$status','$country','$agent_name',
'$agent_email','$date','$time')

";


if(mysqli_query($conn,$add_location)){


    die("success");

}else{


    die("Error occur ");
}


}else{

die("Invalid secret key");


}

mysqli_close($conn);

}else{

header("Location: Error");
exit;

}