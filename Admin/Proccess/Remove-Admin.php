<?php
require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}




if(isset($_POST["admin-email"]) && isset($_POST["status"]) && isset($_POST["permit"])){



$email = filter_var($_POST["admin-email"],FILTER_VALIDATE_EMAIL);

if(empty($email)){


    die("Please enter email");

}else{


$email = htmlspecialchars($email);

}


$status = filter_var($_POST["status"],FILTER_SANITIZE_STRING);

if(empty($status)){

    die("Please enter status");

}else{


    if($status   == "Tech support" || $status  == "Vendor Agent" || $status  == "Master" || $status  == "Store Agent"

    || $status  == "Pickup Agent" || $status  == "Resolution Team" || $status  == "Customer care"
    
    ){








    }else{


die("Invalid Status ". $status);

    }




}


$status= htmlspecialchars($status);





$permit = filter_var($_POST["permit"],FILTER_SANITIZE_STRING);


if(empty($permit)){


    die("Please enter permmision status. permission ".$permit ." is invalid");

}else{




if($permit == "Granted" || $permit == "Deny" || $permit == "Block" || $permit == "Suspend"){




}else{




    die("Please enter a valid permmission status");


}


}





require_once "db_connection.php";

//CHECK SECRET KEY//

if(isset($_POST["secret-key"]) && !empty($_POST["secret-key"])){


    $OldKey = htmlspecialchars($_POST["secret-key"]);
    
    
    $select = "SELECT * FROM Admin_Register_db WHERE id='$_SESSION[Admin_key]'";
    
    $Results = mysqli_query($conn,$select);
    
    $UserPass = mysqli_fetch_assoc($Results);
    
    if(password_verify(htmlspecialchars($OldKey),$UserPass["Pin"]) == "password_hash"){
    
    
    
    }else{
    
        die("Invalid secret key");
    }
    
    
    }else{
    
        die("Please enter your secret key");
    }
    
    

$email = stripslashes($email);
$permit = stripslashes($permit);
$status = stripslashes($status);

$email = mysqli_real_escape_string($conn,$email);

$permit = mysqli_real_escape_string($conn,$permit);

$status = mysqli_real_escape_string($conn,$status);


//UPDATE ADMIN STATUS//


$update = "UPDATE Admin_Register_db SET Status='$status',Admin_permit='$permit' WHERE Email='$email'";


if(mysqli_query($conn,$update)){

    die("success");
}else{

    die("Error caught");
}


}else{


die("Error");


}