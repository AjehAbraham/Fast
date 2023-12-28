<?php
 require_once "session.php";


 

 if($_SERVER["REQUEST_METHOD"] == "POST"){



    if(isset($_POST["info-email"])){



if(empty($_POST["info-email"])){



die("Please enter email");



}else{


$email = filter_var($_POST["info-email"],FILTER_VALIDATE_EMAIL);

require_once "db_connection.php";

$email = mysqli_real_escape_string($conn,$email);





}



    }else{



        echo "Ivalid request";
    }



 }
