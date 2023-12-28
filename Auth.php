<?php
session_start();

if(isset($_SESSION["User"])){

    header("Location: home");
    exit;
}elseif(isset($_COOKIE["UserID"]) && isset($_COOKIE["TokenID"])){

    $uniqueID = htmlspecialchars($_COOKIE["UserID"]);

    $token = htmlspecialchars($_COOKIE["TokenID"]);

    require_once "database_connection.php";

    $uniqueID = mysqli_real_escape_string($conn,$uniqueID);

    $token = mysqli_real_escape_string($conn,$token);

$uniqueID = stripslashes($uniqueID);
$token = stripslashes($token);

//NOW SEARCH FOR INFO ON DATABASE/*AND NOW() <= DATE_ADD(Date, INTERVAL 1 WEEK) AND Status='Null'*/ //

$search = "SELECT * FROM Authentication WHERE uniqueID='$uniqueID' AND NOW() <= DATE_ADD(Date, INTERVAL 1 WEEK) AND Status ='Null' ORDER BY id DESC LIMIT 1";

$result = mysqli_query($conn,$search);

if(mysqli_num_rows($result) > 0){



    $results = mysqli_fetch_assoc($result);


    //NOW CHECK IF COOKIE IS VALID//

    if(password_verify($token,$results["HashID"]) == "password_hash"){


        //LOGIN CREDENTIALS ARE VALID//

session_regenerate_id();
$_SESSION["User"] = $results["User_id"];


require_once "Process/save remember me.php";

require_once "Process/save session id.php";

require_once "Process/Login history.php";


//NOW CHECK FOR LAST VISITED PAEG//

if(isset($_COOKIE["Last_visited"]) && !empty($_COOKIE["Last_visited"])){


$page = htmlspecialchars($_COOKIE["Last_visited"]);

$page = basename($page,".php");

//REMOVE LAST VISITED PAGE TO AVOID ANY FROM OF REDIRECT//
unset($_COOKIE["Last_visited"]);

setcookie("Last_visited", "", time() - 86400 * 7);

header("Location: $page");
exit;

}else{



    //LAST VISITED PAGE NOT SET JUST RE-DIRCT USER TO HOME PAGE//

    header("Location: home");
    exit;
}

    }else{

        //INVALID LOGIN CREDENTIALS OR COOKIE HAS BEEN MANIPULATED//
        

        //UNSET ALL COOKIES AND REDIRECT USER TO HOME//
        unset($_COOKIE["UserID"]);
        setcookie("UserID","", time() - 86400 * 7,"/");
        
        unset($_COOKIE["TokenID"]);
        setcookie("TokenID", "", time() - 86400 * 7, "/");
        
        
        header("Location: home");
        exit;
        

    }

}else{

//A MATCH COULD NOT BE FOUND ON DATABASE//

//UNSET ALL COOKIES AND REDIRECT USER TO HOME//
unset($_COOKIE["UserID"]);
setcookie("UserID","", time() - 86400 * 7,"/");

unset($_COOKIE["TokenID"]);
setcookie("TokenID", "", time() - 86400 * 7, "/");


header("Location: home");
exit;

}

}else{
//COOKIES ARE NOT SET//

header("Location: home");
exit;

}