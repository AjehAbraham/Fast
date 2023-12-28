<?php
require_once "session.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST["old_key"]) && !empty($_POST["old_key"])){

$oldKey = (int) filter_var($_POST["old_key"],FILTER_SANITIZE_NUMBER_INT);   

$oldKey = htmlspecialchars($oldKey);

}else{

    die("Please enter your old secret Key");
}



if(isset($_POST["new_key"]) && !empty($_POST["new_key"])){

    $NewKey = (int) filter_var($_POST["new_key"],FILTER_SANITIZE_NUMBER_INT);   
    
    $NewKey = htmlspecialchars($NewKey);

    if(empty($NewKey)){

        die("Please enter new secret key");
    }elseif(strlen($NewKey) <= 5){

        die("New key to short");

    }else{


        if(strlen($NewKey) >= 7){


            die("New secret key to long,must be 6 in length");
        }
    }
    
    }else{
    
        die("Please enter your new secret Key");
    }





$select = "SELECT * FROM Admin_Register_db WHERE id='$_SESSION[Admin_key]'";

$Results = mysqli_query($conn,$select);
 
$UserPass = mysqli_fetch_assoc($Results);

if(password_verify(htmlspecialchars($oldKey),$UserPass["Pin"]) == "password_hash"){


    //PASSWORD IS VALID NOW CHNAGE USER PASSWORD//
$hash = password_hash($NewKey,PASSWORD_DEFAULT);

    $insert = "UPDATE Admin_Register_db SET Pin='$hash' WHERE id='$_SESSION[Admin_key]'";


if(mysqli_query($conn,$insert)){

    die("success");

}else{

    die("Error occured");

}

}else{


    die("Old secret key is invalid");
}



}