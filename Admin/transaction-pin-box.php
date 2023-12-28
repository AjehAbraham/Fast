<?php
 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
 realpath($_SERVER['SCRIPT_FILENAME'])){
 
     header("Location:Error");
     exit;
 
 //header('HTTP/1.0 403 Forbiddden',TRUE,403);
 //die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
 }elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && realpath(__FILE__)==
 realpath($_SERVER['SCRIPT_FILENAME'])){
 
     header("Location:Error");
     exit;
 
 //header('HTTP/1.0 403 Forbiddden',TRUE,403);
 //die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
 }
 ?>

<style>
    
.open-transaction-pin{
  padding: 8px 8px;
  margin: auto;
  cursor: pointer;
  color: white;
  background-color: rgb(0,102,100);
  border-radius: 2rem;
  width: 60%;
  text-align: center;
  font-size: 13px;
}
.transaction-pin-overlay{
  transition: 0.1s;
top: 0;
bottom: 0;
left: 0;
right: 0;
width: 0%;
overflow-y: hidden;
position: fixed;
background-color: #ccc;
color: rgb(0,102,100);
text-align: center;
z-index: 5;
}

.transaction-pin-overlay input[type=number]{
  padding: 8px 8px;
  border: 2px solid #ccc;
  outline: 0;
  width: 50%;
  font-size: 18px;
  border-radius: 2rem;
  margin: auto;
}
.transaction-pin-overlay input[type=submit]{
font-size: 15px;
background-color: rgb(0,102,100);
color: white;
cursor: pointer;
border: none;
border-radius: 2rem;
margin: auto;
width: 62%;
  padding: 7px 7px;
}
@media screen and (min-width: 600px){
  .open-transaction-pin{
    width: 40%;
  }
  .transaction-pin-overlay input[type=number]{
    width: 40%;
    font-size: 13px;
  }
  .transaction-pin-overlay input[type=submit]{
    width: 30%;
  }
}
#close-pin-btn{
  text-align: center;
  margin: auto;
  display: block;
  border-radius: 50%;
  width: 25px;
  height: 25px;
  background-color: rgb(0,102,100);
  color: white;
  font-size: 22px;
  cursor: pointer;
}
.error_message{
color: red;
}
</style>

<div class='transaction-pin-overlay'>

<p><i class='fa fa-close' id='close-pin-btn' onclick='Close_pin_box()'></i></p>


<lable><b>Input your secret key</b></label><br>

<br>
<input type='number' name='secret-key' autocomplete='off' autofocus='off' id='pin' maxlength='6' inputmode='numeric' style='-webkit-text-security: disc;' placeholder='Input your secret key'><br>
<br>
<input type='submit'>
</form>

<p class='error_message'></p>
</div>
</div>

<script>
  document.querySelector(".open-transaction-pin").addEventListener("click",Open_pin_box);
  function Open_pin_box(){
  
  document.querySelector(".transaction-pin-overlay").style.width ="100%";
  
  }
  
  function Close_pin_box(){
  
  document.querySelector(".transaction-pin-overlay").style.width ="0%";
  
  }
  </script>