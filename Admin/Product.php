<?php
require_once "session.php";

if($result["Status"] == "Master"){


}else{
  
  die("<p>You cannot view this page,Access denied!</p>");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/Product.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Products</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php";

?>






         
<div class="search-container">
 <form id="search-product"> <input type="search" name="Items" placeholder="Item ID or Item user ID or Item name...."> 
  <input type="submit" value="search"></form>

</div>
<p class="error_message"></p>



<!--div class="item-review-container">

<p>Items Reviews <i class="fa fa-comment"></i></p>

<b>John Doe <i class="fa fa-thums-up"></i></b><br>
<b>This item sucks</b>
<br>
<p class="comment"><a href="Hide comment?name=838883&comment=8948484">Hide comment <i class="fa fa-eye-slash"></i></a></p>

</div-->



<?php

require_once "db_connection.php";


$fetch_product = "SELECT * FROM Items_product_table ORDER BY id DESC";


$products = mysqli_query($conn,$fetch_product);

if(mysqli_num_rows($products) > 0){

  
echo "<h1 style='font-size: 13px;text-align: center;padding: 8px 8px;background-color: rgb(0,102,153);color: white;'>Your Item(s)(From lastest to oldest)</h1>";

while($item = mysqli_fetch_assoc($products)){

$price ="₦". number_format($item["Product_price"]).".00";
    
$name = $item["Product_name"];

$old_price = "₦". number_format($item["Product_old_price"])."00";

$hash_id = $item["Hash_id"];

$imageURL = "items-image/". $item["Product_image"];



if($item["Type"] === '1'){

  echo "
  
 <div class='product-item-container-flex'>
  <div class='items-container-fluid'>
   <a href='edit-product?name=$hash_id'> <img src='$imageURL' >
    <br>
    <b>$name</b>

    <br>
    <b>$old_price</b>
    <br>
    <b>$price</b>
    <br>
    <p class='Edit-btn'><a href='edit-product?name=$hash_id'>Edit Item <i class='fa fa-edit'></i>
    </a></p><br>
  </div>
  ";
          



}else if($item["Type"] === '2'){

 echo " 
 <div class='items-container-fluid-two'>
   <a href='edit-product?name=$hash_id'> <img src='$imageURL' >
    <br>
    <b>$name</b>

    <br>
    <b>$old_price</b>
    <br>
    <b>$price</b>
   
<p class='Edit-btn'><a href='edit-product?name=$hash_id'>Edit Item <i class='fa fa-edit'></i>
</a></p><br>
  </div></div>

  ";
          



}






/*
echo "

<div class='form-container-box'>

<p><img src='$imageURL' ></p>

<b>$name </b><br>
<b>$price</b><br>
<!--b>Rating <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> 
(600)</b><br>

<b>Total Purchase: 10</b>
<br>
<b>Failed Purchase: 2</b><br>
<b>Owner id: $item[Admin_id].Admin Status: . <br>Item ID: $hash_id<i class='fa fa-copy' style='cursor: pointer;'></i></b>

<br-->
<br>
<p class='Edit-btn'><a href='Edit product?name=$hash_id'>Edit Item <i class='fa fa-edit'></i>
</a></p><br>
</div><br>

";



}*/
}

}else{

echo "<h1 style='color:red; text-align:center;>No Item has been uploaded yet</h1>";


}


?>

</div>


<script>
  
  $(document).ready(function (e) {

$("#search-product").on('submit', (function(e){


  e.preventDefault();
  
// document.querySelector(".loader-container-overlay").style.display= "block";

   $.ajax({
 
    url: 'Proccess/Search product',
type : 'POST',
data: new FormData(this),
cache: false,
contentType: false,
processData: false,
    success:function(Data){

   //document.querySelector(".loader-container-overlay").style.display= "none";

     document.querySelector(".error_message").innerHTML = Data;


    },
    error:function(Data){
      //document.querySelector(".loader-container-overlay").style.display= "none";

      document.querySelector(".error_message").innerHTML = Data;

    }
  
   });



}));


  });

  </script>
<!--script src="Js/product.js"></script-->
</body>
</html>