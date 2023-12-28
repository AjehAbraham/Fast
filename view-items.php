<?php
session_start();

if(isset($_SESSION["User"])){


  require_once "database_connection.php";
  
  
  $user_record = "SELECT * FROM Register_db WHERE id = '$_SESSION[User]'";
  
  
  $user_result = mysqli_query($conn,$user_record);
  
  
  $New_user = mysqli_fetch_assoc($user_result);
  
  require_once "check session id.php";
  
  
  }else{
  
  
  }
?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/view-item.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>View Item</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">

</head>
<body>
<div class="top-nav-bar">
  <b> <a href="home"><span class="material-symbols-outlined">
         cancel</span></a></b><br><br>
</div>


<?php 

require_once "Network.php";


if ($_SERVER["REQUEST_METHOD"] == "GET"){

$cart_id =$cart_hash ="";

if(isset($_GET["Item_id"])){
 // echo $_GET["Hash_id"];


 $cart_hash = htmlspecialchars($_GET["Item_id"]);

if(empty($cart_hash)){


die("invalid link");

}else{


  $cart_hash = htmlspecialchars($cart_hash);

require_once "database_connection.php";

 $fetch_items = "SELECT * FROM Items_product_table WHERE Hash_id ='$cart_hash'";



 $results = mysqli_query($conn,$fetch_items);


 if (mysqli_num_rows($results) > 0){


  $items_result = mysqli_fetch_assoc($results);

  $imageURL = "Admin/items-image/". $items_result["Product_image"];

  $old_price ="₦". number_format( $items_result['Product_old_price']).".00";
  $price ="₦". number_format( $items_result['Product_price']). ".00";
///FETCH ITEMS REVIEW AND RATING//

require_once "Loader.php"; 
require_once "success.php";
require_once "Network.php";

require_once "Loader.php";

echo "
<p class='error_message' style='display: none;'></p>
<div class='flex-box-container'>

  <img src='$imageURL'>
  <p> $items_result[Product_name]</p>
  <p>$old_price</p>
  <p>$price</p>
  <p>Rating <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> (100 Reviews)</p>
</div>
<br>

<div class='Details-container-fluid'>

  <p>$items_result[Product_description]
  </p>

<!--p class='open-review-btn'>Rate item(Reviews)</p-->
<form id='FormID'>
<input type='text' value='$items_result[Hash_id]' name='Ray_id' style='display: none;'>

<input type='text' value='$items_result[id]' name='cart-item' style='display: none;'>

  <p style='display: none;'></p> 
  <button>Add to cart <i class='fa fa-cart-arrow-down'></i></button>
  </form>
<p class='open-review-btn'>Rate Items</p>
</div>";


$check_review = "SELECT * FROM Product_user_rating WHERE Product_id='$items_result[Hash_id]' ";


$review = mysqli_query($conn,$check_review);


if(mysqli_num_rows($review) > 0){


  $total_review = mysqli_num_rows($review);


  $users_review = mysqli_fetch_assoc($review);

//FTECH LIKE //

$FETCHlIKE = "SELECT * FROM Product_user_rating WHERE Rating='Like' AND Product_id='$items_result[Hash_id]' ";

$LikeResult = mysqli_query($conn,$FETCHlIKE);

if(mysqli_num_rows($LikeResult) > 0){

    $likes = mysqli_num_rows($LikeResult);

}else{

$likes = "0";

}

$FetchDislike ="SELECT * FROM Product_user_rating WHERE Rating='Dislike' AND Product_id='$items_result[Hash_id]' ";

$DislikeResult = mysqli_query($conn,$FetchDislike);

if(mysqli_num_rows($DislikeResult) > 0){

    $dislikes = mysqli_num_rows($DislikeResult);

}else{

  $dislikes = "0";
}


}else{


//NO REVIEW//

$total_review = 0;
$likes = "0";
$dislikes = "0";

}

echo "
  
<div class='rating-container'>
  <p><i class='fa fa-close' id='close-btn'></i></p>
  <h3>Rating and Previews($total_review) </h3>

  <p>$likes Like(s) $dislikes Dislike<br>Comments are coming soon.</p>
  <p class='rating_error_message'> Do you like this Item? 
 
    <i class='fa fa-thumbs-up' style='font-size: 20px;margin-left: 6px' id='Like_form'></i>
  
<i class='fa fa-thumbs-down' style='font-size: 20px;margin-left: 12px;' id='dis-like'></i> 
    
    </p>";


 echo "
 <form id='like-form'>
   <input type='text' value='$items_result[Hash_id]' name='item-id' style='display: none'>
 <input type='text' name='Like' style='display: none;'>
 </form>

   <form id='dislike-form'><input type='text' value='$items_result[Hash_id]' name='item-id' style='display: none'>
     <input type='text' name='Dis_Like' style='display: none;'>
   </form> ";

  

  
/*
  echo "

  <div class='user-reviews'>
    <p>John James <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> 
       <b><a href='Edit review?Item_id='> Edit <i class='fa fa-edit'></i></a></b>
    </p>
    
  <p>Wow! i love this item and i have been using it for the past four years now without hsving any isssue,i wish all Airpod can be like this,Thanks.</p>

  </div>
  <br>
<br>";*/


 }else{

//die("item not found");

header("Location: Home");
exit;

 }



}


}else{



  header("Location: Home");
  exit;
  //die("link is incorrect");
  
  }




}else{

header("Location:Error");
exit;

}

?>

<script src="Js/view-item.js"></script>
</body>
</html>