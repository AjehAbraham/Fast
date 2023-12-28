<?php
 session_start();
// require_once "database_connection.php";

if(isset($_COOKIE["Last_visited"]) && !empty($_COOKIE["Last_visited"])){

$page = htmlspecialchars($_COOKIE["Last_visited"]);

$page = basename($page,".php");

unset($_COOKIE["Last_visited"]);

setcookie("Last_visited","", time() - 86400,"/");

header("Location: $page");

exit;

}


 if(isset($_SESSION["User"])){
 


   require_once "database_connection.php";
   
   
require_once "check session id.php";

if(!isset($_COOKIE["TokenID"]) && !isset($_COOKIE["UserID"])){

require_once "save remember me.php";

}else{


}
   
   $user_record = "SELECT * FROM Register_db WHERE id = '$_SESSION[User]'";
   
   
   $user_result = mysqli_query($conn,$user_record);
   
   
   $New_user = mysqli_fetch_assoc($user_result);
 


   
   }else{
   
   
   
       if(isset($_COOKIE["UserID"]) && isset($_COOKIE["TokenID"])){
   
   
   
   if(!empty($_COOKIE["UserID"]) && !empty($_COOKIE["TokenID"])){
   
   
   
   header("Location: Auth");
   
   exit;
   
   
   
   
   }
   
   
   
   }
   
   
   
   
   
   
   
   }
   
   
   require_once "database_connection.php";
  ?>

<!DOCTYPE html>
<html>
  <head>
    
  <link rel="stylesheet" href="Css/footer.css">
  <link rel="stylesheet" href="Css/header.css">
    <link rel="stylesheet" href="Css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Fastshop</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">



</head>
<body>


<?php
require_once __DIR__.("/header.php");


require_once "Network.php";

   
 //$mysqli = "SELECT * FROM Items_product_table WHERE Status ='Deleted' ORDER BY id DESC LIMIT 40 ";


 $mysqli = "SELECT  * FROM Items_product_table  ORDER BY id DESC LIMIT 100";


 $result = mysqli_query ($conn,$mysqli);


 if (mysqli_num_rows($result) > 0){
 

while ($items_result = mysqli_fetch_assoc($result)){

 
if($items_result["Status"] == "Deleted"){

continue;

}


 $imageURL = "Admin/items-image/". $items_result["Product_image"];

 $old_price ="₦". number_format( $items_result['Product_old_price']).".00";
 $price ="₦". number_format( $items_result['Product_price']). ".00";
///FETCH ITEMS REVIEW AND RATING//


if($items_result["Type"] === '1'){

  echo "
  
 <div class='product-item-container-flex'>
  <div class='items-container-fluid'>
   <a href='view-items?Item_id=$items_result[Hash_id]'> <img src='$imageURL' style='width: 120px height: 120px;'>
    <br>
    <b>$items_result[Product_name]</b>

    <br>
    <b>$old_price</b>
    <br>
    <b>$price</b>
    <br></a>
    
    <form id='$items_result[Hash_id]' class='FormData'><input type='text' value='$items_result[Hash_id]' name='Ray_id'style='display: none;'>
    <input type='text' value='$items_result[id]' name='cart-item'  style='display: none;'>
    <button>Add to cart <i class='fa fa-cart-arrow-down'></i></button></form>
  </div>
  ";
          



}else if($items_result["Type"] === '2'){

 echo " 
 <div class='items-container-fluid-two'>
   <a href='view-items?Item_id=$items_result[Hash_id]'> <img src='$imageURL' style='width: 120px; height: 120px;'>
    <br>
    <b>$items_result[Product_name]</b>

    <br>
    <b>$old_price</b>
    <br>
    <b>$price</b>
    <br>
    <form id='$items_result[Hash_id]' class='FormData' ><input type='text' value='$items_result[Hash_id]' name='Ray_id'style='display: none;'>
    <input type='text' value='$items_result[id]' name='cart-item'  style='display: none;'>
  <button>Add to cart <i class='fa fa-cart-arrow-down'></i></button></form>
  </div></div>

  ";
          



}



                
}


 }else{

echo "<p style='color: red; text-align: center;'>No result found</p>";



 }

//mysqli_close($conn);
?>
</div>

<form id='totalItem'><input type='text' value='<?php echo rand(); ?>' name='totalItem' style='display: none;'></form>

<p class="Errr"></p>
<p class="error_message" style='display: none;'></p>

<p class="error_message" style='display: none;'></p>




<p><span class="material-symbols-outlined" 
id="backTO-top-btn">keyboard_double_arrow_up</span></p>
  

<?php
require_once "success.php";
require_once "Loader.php"; ?>

<script src="Js/index.js"></script>
<script src='Js/home.js'></script>

<?php require_once __DIR__.("/footer.php"); ?>