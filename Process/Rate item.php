<?php
require_once "sessionPage.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if($_SERVER["REQUEST_METHOD"] == "POST"){



    $item_id = htmlspecialchars($_POST["item-id"]);

    $item_id = stripslashes($item_id);

    $date = htmlspecialchars(date("Y/m/d H:i:s"));
    $time = htmlspecialchars(date("H:i:s"));
    $ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
    //$User_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);
    
    
    
    $isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"tablet"));
    
    
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"mobile"));
    
    
    
    $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"windows"));
    
    
    $isAndriod = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"andriod"));
    
    
    $isIphone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"iphone"));
    
    
    $isIpad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"ipad"));
    
    
    $isIos= $isIpad || $isIphone;
    
    
    
    if($isMob){
    
    if($isTab){
    
        $agent = "Tablet";
    
    }else{
    
    
        $agent = "Mobile";
    }
    
    }else{
    
        $agent = "Desktop";
    }
    
    if($isIos){
    
        $user_agent = $agent. " Iphone IOS";
    }else if($isAndriod){
    
    $user_agent = $agent . " Andriod";
    
    }else{
    
    $user_agent = $agent. " Windows";
    
    }




if(isset($_POST["Like"])){


if(isset($_POST["item-id"]) && !empty($_POST["item-id"])){



    require_once "database_connection.php";

    $verify = "SELECT * FROM Items_product_table WHERE Hash_id='$item_id'";


    $items_result = mysqli_query($conn,$verify);


if(mysqli_num_rows($items_result) > 0){

//CHECK IF USER HAS LIKE IT BEFORE//

$check_user = "SELECT * FROM Product_user_rating WHERE User_id='$_SESSION[User]' AND Product_id='$item_id'";


$rating_result = mysqli_query($conn,$check_user);


if(mysqli_num_rows($rating_result) > 0){


    die("<b style='color: red;'>You have already review this item</b>");
}


$rating = "Like";
$status = "succes";
    
$insert = "INSERT INTO  Product_user_rating(
User_id,Product_id,Rating,Status,Date,Time,Ip,User_agent
)
VALUES('$_SESSION[User]','$item_id','$rating','$status','$date','$time','$ip','$user_agent')
";


if(mysqli_query($conn,$insert)){


die("<b style='color: mediumseagreen;'>Thank You!&#128526;</b>");


}else{


die("An unknown error has ocuur,please try again");


}

}else{



die("Your request could not be completed or the request failed");


}



}else{


    die("Error caught");
}



}else if(isset($_POST["Dis_Like"])){

    if(isset($_POST["item-id"]) && !empty($_POST["item-id"])){


        $rating = "DisLike";
     
    require_once "database_connection.php";

    $verify = "SELECT * FROM Items_product_table WHERE Hash_id='$item_id'";


    $items_result = mysqli_query($conn,$verify);


if(mysqli_num_rows($items_result) > 0){

//CHECK IF USER HAS LIKE IT BEFORE//

$check_user = "SELECT * FROM Product_user_rating WHERE User_id='$_SESSION[User]' AND Product_id='$item_id'";


$rating_result = mysqli_query($conn,$check_user);


if(mysqli_num_rows($rating_result) > 0){


    die("<b style='color: red;'>You have already review this item</b>");
}


$rating = "DisLike";
$status = "succes";
    
$insert = "INSERT INTO  Product_user_rating(
User_id,Product_id,Rating,Status,Date,Time,Ip,User_agent
)
VALUES('$_SESSION[User]','$item_id','$rating','$status','$date','$time','$ip','$user_agent')
";


if(mysqli_query($conn,$insert)){


die("<b style='color: red;'>Thank You&#128532;</b>");


}else{


die("An unknown error has ocuur,please try again");


}
}



    }else{
    
    
        die("Error caught");
    }
    

}else{


    die("Invalid request");
}




}else{


    header("Location: Error");
    exit;
}

