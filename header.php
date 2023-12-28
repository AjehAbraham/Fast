<?php  
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

    
}
require_once "Register.php"; 

$fileName = $_SERVER["SCRIPT_NAME"];
$fileName = basename($fileName,".php");

if($fileName == "home"){

  $homeLink = "";
}else{

  $homeLink = '
  <a href="home">
      <h3 class="muted-text">  <i class="fa fa-home"></i>
      Home
     </h3>
     </a>';
}
?>

   <div class="header-container">

<div class="logo">
   <p>FastShop<i class="fa fa-star-half-empty"></i></p></div>


<div class="sub-header-sidebar">
    <i class="fa fa-bars" id="open-sidebar-btn"></i>
   
    <div class="notification">
    <i class="fa fa-shopping-cart" 
    onclick="open_check_out()"></i><span class="badge" id='totalItem'>
   
    </span>  </div>


   <?php if(isset($New_user)) :?>
    <a href="dashboard"><i class ="fa fa-user-circle"  style="float: right;"></i></a>

<?php else: ?>
    <i class="fa fa-user" onclick="open_login_container()"></i>

    <?php endif; ?>

    <i class="fa fa-search" id='opensearchbtn'></i>
</div> 

<?php
require_once "search-bar.php"; ?>

<div class="header-welcome-message">

<p> WELCOME TO FASTSHOP</p>
</div>




<div class="sidebar-menu-container">
  <br>
  <p class="close-sidebar-btn"><span class="material-symbols-outlined">
         cancel</span></p>
         
  
  <?php echo $homeLink; ?>
    <?php if(isset($New_user)) :?>
      <a href="dashboard">
      <h3 class="muted-text">  <i class="fa fa-user-plus"></i>
     Dashboard
      </h3>
      </a>

      <?php endif; ?>
  


      
      <a href="flash-sale">
      <h3 class="muted-text"><i class="fa fa-flash"></i>
    Flash sale
      </h3>
  </a>


      
      <a href="Live-chat" target="_blank">
      <h3 class="muted-text"><i class="fa fa-question"></i>
       Help Center
      </h3>
  </a>
  
  
       <?php if(isset($New_user)) : ?>
      <a href="logout">
      <h3 class="muted-text"><i class="fa fa-user-times"></i>
       Logout
      </h3>
      </a>
      <?php endif; ?>
  </div>
  






<!--LOGIN CONTAINER-->

<?php if(!isset($New_user)) :?>


<div class="login-container-fliud">

<?php require "Loader.php" ?>

 <p><span class="material-symbols-outlined"onclick="close_login_container()">
 cancel</span></i></p>
            <h1>Login</h1>
            <form id="LoginForm">
              <b style="color: red;" class="Login_error_message"></b><br>
             
            <label><b>Email:</b></label>
            <br>
            <input type="email" name="email" placeholder="enter email..." autocomplete="on" autofocus="off">
            <br>

            <label><b>Password:</b></label>
            <br>
            <input type="password" name="password" placeholder="Password..." id="password" autofocus="off">


            
           <p style="margin: 0;text-align: justify;margin-left: 5px;"> <label class="switch">
        <input type="checkbox"  onclick="show_password()">
        <span class="round slider">
         </span></label>
        <b class="show_passowrd_text" style="margin-top: 10px;position: absolute;margin-left: 6px;"> Show password</b><p>

            <input type="submit" value="Login" >

</form>
               <p><a href="forgot-password" target="_blank">Forgot password?</a></p>

    

       
               <p>If you don't have an account,click <b onclick="OpenRegForm()" id="OpenForm">here</b> to register</p>

               <?php endif; ?>

</div>

<!-- END OF LOGIN CONTAINER-->


<!-- CHECK OUT CONTAINER-->


<div class="show-selected-cart-items-container">
                <p onclick="close_check_out()"><span class="material-symbols-outlined">
         cancel</span></p>
<h1>Cart items <i class="fa fa-cart-arrow-down"></i></h1>




<p style="text-align: center" class="cart_error_message"></p>         





<p class="checkout_message"></p>
<form id="check_cart"><input type="hidden" name="checkout" value="procced"></form>

               </div>

</div>
<!--END OF CHECKOUT CONTAINER-->


    <?php require_once "Loader.php"; ?>
<!--script src="Js/header.js"></script-->
<script>
  
$(document).ready(function (e) {

$("#LoginForm").on('submit', (function(e){


  e.preventDefault();
  
 document.querySelector(".loader-container-overlay").style.display= "block";

   $.ajax({
 
    url: 'Process/Login',
type : 'POST',
data: new FormData(this),
cache: false,
contentType: false,
processData: false,
    success:function(Data){

      document.querySelector(".loader-container-overlay").style.display= "none";
     
     document.querySelector(".Login_error_message").innerHTML = Data;


if(Data == "\r\nok"){
  

  document.querySelector("#LoginForm").reset();
  
  document.querySelector(".Login_error_message").innerHTML = "";

  window.location.reload();

}else if(Data == "ok"){

  document.querySelector("#LoginForm").reset();
  
  document.querySelector(".Login_error_message").innerHTML = "";

  window.location.reload();
  

}

    },
    error:function(Data){
      document.querySelector(".loader-container-overlay").style.display= "none";
      document.querySelector(".Login_error_message").innerHTML = Data;

    }
  
   });



}));



});



  document.querySelector("#open-sidebar-btn").addEventListener("click",openside_bar);

function openside_bar(){

  var body = document.body;

  body.classList.add("add-sidebar");

    //document.querySelector(".sidebar-menu-container").style.width="100%";
}


document.querySelector(".close-sidebar-btn").addEventListener("click",close_sidebar);

function close_sidebar(){

  var body = document.body;

  body.classList.remove("add-sidebar");
}

//OPEN AND CLOSE LOGIN FROM CONTAINER//


function open_login_container(){


var body = document.body;

body.classList.add("add-login");


 //   document.querySelector(".login-container-fliud").style.display= "block";


}


function close_login_container(){


var body = document.body;

body.classList.remove("add-login");


   // document.querySelector(".login-container-fliud").style.display= "none";

}

//SHOW AND HIDE PASSWORD FOR LOGIN CONTAINER


                function show_password(){

var password = document.querySelector("#password");

if (password.type === "password"){

password.type =("text");

document.querySelector(".show_passowrd_text").innerHTML="Hide password";



}else{


    password.type =("password");

    document.querySelector(".show_passowrd_text").innerHTML="Show password";


}
                }


                //OPEN AND CLOSE CHECKOUT CONTAINER//
           /*   
                function open_check_out(){


                  document.querySelector(".show-selected-cart-items-container").style.width= "100%";
                  
                  
                  document.querySelector(".loader-container-overlay").style.display ="block";
                  
                  
                  var form = $("#fetch_cart");
                  
                  var url = "Process/Fetch_items";
                  
                  $.ajax({
                  
                  type : 'POST',
                  url : url,
                  data: form.serialize(),
                  dataType: 'json',
                  encode: true,
                  success: function(data){
                  
                  console.log();
                  
                  document.querySelector(".loader-container-overlay").style.display ="none";
                  
                  
                  var error_message = document.querySelector(".cart_error_message");
                  
                  error_message.innerHTML = data.responseText;
                  
                  
                  
                  },
                  error: function(data){
                  
                    document.querySelector(".loader-container-overlay").style.display ="none";
                  
                  
                  var error_message = document.querySelector(".cart_error_message");
                  
                  
                  error_message.innerHTML = data.responseText;
                  
                  
                  
                  }
                  });
                  
                  
                  }


*/

                function close_check_out(){

document.querySelector(".show-selected-cart-items-container").style.width= "0%";

                }



                //OPEN AND CLOSE SEARCH BAR//
   
document.querySelector(".close-message-btn").addEventListener("click",close_message_text);

    function close_message_text(){

document.querySelector(".success-message-overlay").style.display = "none";

      }


  
  function Procced_checkout(){

    //event.preventDefault();
    
    
    document.querySelector(".loader-container-overlay").style.display= "block";
    
    var form = $("#check_cart");
    
    var url = "Process/Procced checkout";
    
    $.ajax({
    
    type : 'POST',
    url : url,
    data: form.serialize(),
    dataType: 'json',
    encode: true,
    success: function(data){
    
    
    
    },
    error: function(data){
    
      document.querySelector(".loader-container-overlay").style.display= "none";
    
    var error_message = document.querySelector(".checkout_message");
    
    
    
    
    if(data.responseText == "\r\nok"){
    
    
      error_message.innerHTML = "";

      window.location.href="checkout";
    
    
    }else if(data.responseText == "ok"){
    
    
      error_message.innerHTML = "";

      window.location.href="checkout";
    
    
    } else{
    
    
    
      error_message.innerHTML = data.responseText;
    
    }
    
    
    }
    });
    
    }
    

    function clear_cart_items(){

      //event.preventDefault();
      
      
      document.querySelector(".loader-container-overlay").style.display= "block";
      
      var form = $("#check_cart");
      
      var url = "Process/clear cart";
      
      $.ajax({
      
      type : 'POST',
      url : url,
      data: form.serialize(),
      dataType: 'json',
      encode: true,
      success: function(data){
      
      
      
      },
      error: function(data){
      
        document.querySelector(".loader-container-overlay").style.display= "none";
      
      var error_message = document.querySelector(".cart_error_message");
      
      
      
      
      if(data.responseText == "\r\nok"){
      
      
        error_message.innerHTML = "";
        
        //location.reload();
      
      
      }else if (data.responseText == "ok"){
      
      
        error_message.innerHTML = "";
        
        
      
      
      }else{
      
      
      
        error_message.innerHTML = data.responseText;
      
      }
      
      
      }
      });
      
      }
        

  </script>

