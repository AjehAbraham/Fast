<?php
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location: Error");
    exit;

}

$FileName = $_SERVER["SCRIPT_NAME"];

$FileName = basename($FileName,".php");

if($FileName == "Home"){

  $HomeLink = "";

}else{

  $HomeLink ='
  <a href="Home">
      <h3 class="muted-text">  <i class="fa fa-home"></i>
      Home
     </h3>
     </a>' ;
}
?>

      <div class="header-container">

<div class="logo">
   <b>FastShop<i class="fa fa-star-half-empty"></i></b> <i class="fa fa-bars" id="open-sidebar-btn" ></i></div>


<div class="sub-header-sidebar">
  
    <!--div class="notification">
    <i class="fa fa-envelope" 
    onclick="open_check_out()"></i><span class="badge"> </div-->
</div> 

<!--div class="header-welcome-message">

<p> WELCOME ADMIN</p>
</div-->


<br><br>


<div class="sidebar-menu-container">
  <br>
  <p class="close-sidebar-btn"><span class="material-symbols-outlined">
         cancel</span></p>
         <br>
  
  <?php echo $HomeLink; ?>

  <a href="orders">
      <h3 class="muted-text">  <i class="fa fa-cart-plus"></i>
Orders/pickups
      </h3>
</a>
  
   
<?php if($result["Status"] == "Master"):?>
<a href="Product">
      <h3 class="muted-text">  <i class="fa fa-shopping-cart"></i>
  Product/Items
      </h3>
</a>
<a href="Users">
      <h3 class="muted-text">  <i class="fa fa-users"></i>
 Shop Users
      </h3>
</a>



<a href="pickup-location">
      <h3 class="muted-text">  <i class="fa fa-map"></i>
Pickup Locations
      </h3>
</a>


<a href="create-admin">
      <h3 class="muted-text">  <i class="fa fa-user-circle"></i>
     Create Admin
      </h3>
</a>

<?php endif; ?>


<a href="Setting">
      <h3 class="muted-text">  <i class="fa fa-cogs"></i>
     Setting
      </h3>
</a>

      <a href="Logout">
      <h3 class="muted-text"><i class="fa fa-power-off"></i>
       Logout
      </h3>
      </a>
  </div>
  



<script src="Js/header.js"></script>

</html>
</body>