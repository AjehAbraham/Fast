<?php
require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}




if($_SERVER["REQUEST_METHOD"] =="POST"){

$name = filter_var($_POST["name"],FILTER_SANITIZE_STRING);

if(empty($name)){


    die("Please enter item name");
}else{

    $name = htmlspecialchars($name);

}

$old_price = (int) filter_var($_POST["old-price"],FILTER_VALIDATE_INT);


if(empty($old_price)){


    die("Please enter old price");

}else{


    $old_price = htmlspecialchars($old_price);
}


$price =(int) filter_var($_POST["price"],FILTER_VALIDATE_INT);


if(empty($price)){


    die("Please enter  price");

}else{


    $price = htmlspecialchars($price);
}



if(isset($_POST["qty"])){


    $qty = (int) filter_var($_POST["qty"],FILTER_VALIDATE_INT);


    if(empty($qty)){

        die("Please enter Product Quantity");
        
    }else{


        $qty = htmlspecialchars($qty);
    }



}else{



   // IT IS UNAVALIABLE
}


$descrip = filter_var($_POST["des"],FILTER_SANITIZE_STRING);

if(empty($descrip)){

die("Please describe product");

}else{


$descrip = htmlspecialchars($descrip);

}



$hash = htmlspecialchars($_POST["Hash"]);


if(empty($hash)){

die("Error processing your request");


}else{

$hash = stripcslashes($hash);


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
    

    if(strlen($name) >= 18){

        die("Item name too long, must be less than 17 in length");

      }elseif(strlen($name) <= 2){
      
      
        die("Item name too short,must be at least 3 in lenght");
      }


$name = mysqli_real_escape_string($conn,$name);

$old_price = mysqli_real_escape_string($conn,$old_price);

$price = mysqli_real_escape_string($conn,$price);

$qty = mysqli_real_escape_string($conn,$qty);

$descrip = mysqli_real_escape_string($conn,$descrip);

$hash = mysqli_real_escape_string($conn,$hash);

//FIRST SEARCH THE ITEM TO VERIFY//

$verify = "SELECT * FROM Items_product_table WHERE Hash_id='$hash'";



$verify_result = mysqli_query($conn,$verify);

if(mysqli_num_rows($verify_result) > 0){



$item = mysqli_fetch_assoc($verify_result);


$edited_from = $item["Product_name"].",".$item["Product_price"].",".$item["Product_old_price"]
.",". $item["Quantity"].",". $item["Product_description"];

$edited_to = $name.",". $price.",". $old_price.",". $qty.",". $descrip;


if($item["Admin_id"] == $_SESSION["Admin_id"] or $_SESSION["Admin_status"] == "Master"){


//NOW INSERT ALL RECORD AND SAVE EDITED DATE AND TIME//


//UPDATE TABLE //

$update = "UPDATE Items_product_table SET Product_price ='$price',Product_old_price='$old_price',
Product_name ='$name',Product_description ='$descrip', Quantity='$qty' WHERE Hash_id ='$hash'

";


$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

//$user_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);


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




if(mysqli_query($conn,$update)){

//NOW INSERT INTO EDIT ITEM TO SHOW EDITED DATAS//

$insert = "INSERT INTO Product_items_edited(

Admin_id,Item_hash,Edited_By,Field_edited,Edited_from,Edited_to,Date,Time,Ip,User_agent	
)
VALUES('$item[Admin_id]','$item[Hash_id]','$_SESSION[Admin_id]','All column','$edited_from',
'$edited_to','$date','$time','$ip','$user_agent')
";



if(mysqli_query($conn,$insert)){


die("success");


}else{

die("failed to update items,Please try again ".mysqli_error($conn));


}




}else{



    die("Failed to update item ". mysqli_connect_error());


}



}else{


die("Permission denied.Your do not have permission to edit or make any changes to this item.");




}




}else{



die("Item cannot be found");

}








mysqli_close($conn);

}else{


    header("Location: Error");
    exit;


}