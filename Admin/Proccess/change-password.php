<?php
require_once "session.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){

  
    if(isset($_POST["old_password"]) && !empty($_POST["old_password"])){


        $oldPassword = htmlspecialchars($_POST["old_password"]);

    }else{

        die("enter old password");
    }


    if(isset($_POST["new_password"]) && !empty($_POST["new_password"])){


        $Password = htmlspecialchars($_POST["new_password"]);

    }else{

        die("enter old new password");
    }



    if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$Password)){


        die("New password must contain at least one uppercase,one lowercase,one special character and at least 8 in length.");
    
    
    
    
    
    }

    require_once "db_connection.php";


//CHECK PASSWORD//


$select = "SELECT * FROM Admin_Register_db WHERE id='$_SESSION[Admin_key]'";

$Results = mysqli_query($conn,$select);

$UserPass = mysqli_fetch_assoc($Results);

if(password_verify(htmlspecialchars($oldPassword),$UserPass["Password"]) == "password_hash"){


    //PASSWORD IS VALID NOW CHNAGE USER PASSWORD//
$hash = password_hash($Password,PASSWORD_DEFAULT);

    $insert = "UPDATE Admin_Register_db SET Password='$hash' WHERE id='$_SESSION[Admin_key]'";


    if(mysqli_query($conn,$insert)){

die("success");

    }else{


        die("Error occured");
    }


}else{

    die("Old password is invalid");
}


}else{

    header("Location: Error");
    exit;
}