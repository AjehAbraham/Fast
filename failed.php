<?php

   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

   // header("Location:Error");
   require_once "Error.php";
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}
?>


<style>
.success-message-overlay{

  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: white;
  overflow-y: scroll;
}
.success-message-fluid{
  text-align: center;
}  
.success-message-fluid p:nth-child(2){
font-size: 30px;
color: red;
-webkit-animation: 22s loading-message 1s ease-in-out infinite;
animation: loading-message 2s ease-in-out infinite;
}
@keyframes loading-message {

100%{
  transform: scale(2);
}

  
}
.success-message-fluid p:nth-child(1){
  font-size:  18px;
  color: red;
  
  }
  .success-message-fluid p:nth-child(3){
  background-color: red;
  color: white;
  text-align: center;
  border-radius: 2rem;
  width: 50%;
  margin: auto;
  display: block;
  padding: 10px 10px;
  cursor: pointer;
  }
  
  .success-message-fluid p:nth-child(4){
    background-color: red;
    color: white;
    text-align: center;
    border-radius: 2rem;
    width: 50%;
    margin: auto;
    display: block;
    padding: 10px 10px;
    cursor: pointer;
    margin-top: 12px;

    }
    .success-message-fluid a:link{
      color: white;
      text-decoration: none;
    }
    .success-message-fluid a:visited{
      color: white;
    }
</style>


    <div class="success-message-overlay">
<br>
<br>
      <div class="success-message-fluid">

        <p><?php echo  $message_status;?></p>

        <p ><i class="fa fa-danger"></i></p>
      
        <p class="close-message-btn"><i class="fa fa-close"></i> close </p>
        
        <p><?php echo $reponse_message;?></p>
        <br>
      </div>
    </div>

    <script>
document.querySelector(".close-message-btn").addEventListener("click",close_message_text);

    function close_message_text(){

document.querySelector(".success-message-overlay").style.display = "none";

      }
    //  var pop = setTimeout(close_message_text,4000);
    </script>
