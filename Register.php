<?php require_once "Loader.php"; ?>
<style>
  
  .form-container-fluid-box-overlay{
    background-color: white;
    overflow-y: scroll;
    transition: 0.2s;
    position: fixed;
    z-index: 3;
    bottom: 0;
    right: 0;
    left: 0;
    top: 0;
width: 0%;
  }
    .form-container-register{
  margin: auto;
  display: block;
  width: 90%;
  margin-bottom: 7px;
  font-size: 13px;
    }
 
    @media  screen and (min-width: 600px) {
      .form-container-register{
        width: 50%;

border-radius: 2rem;
background-color: white;
box-shadow: 0px 16px 8px 0px rgba(0,0,0,0.6);
padding: 10px 10px;
      }
      
    }

    .form-container-register input[type=email],input[type=password],input[type=text]{
  padding: 10px 10px;
  width: 92%;
  border-radius: 2rem;
  border: 2px solid #ccc;
  font-size: 18px;
  margin: auto;
  display: block;
  outline: 0;
    }
    @media screen and (min-width: 600px){

      .form-container-register input[type=email],input[type=password],input[type=text]{
        font-size: 13px;;
      }
    }
    .form-container-register input[type=submit]{
      font-size: 15px;
      margin: auto;
      display: block;
      cursor: pointer;
      padding: 8px 8px;
      width: 60%;
      border-radius: 2rem;
      color: white;
      background-color: rgb(0,102,153);
      border: none;
      margin-bottom: 8px;
    }
    .form-container-register b:nth-child(10){
      margin-top: 9px;
      margin-left: 3px;
      font-weight: ;
      position: absolute;
    }
    .form-container-register b:nth-child(13){
      margin-top: 9px;
      margin-left: 3px;
      font-weight: ;
      position: absolute;
    }
    .form-container-register h1{
      color: rgb(0,102,153);
      text-align: center;
      font-size: 18px;
   
    }
    .form-container-register h2{
      color: rgb(0,102,153);
      font-size: 18px;
      text-align: center;
    }
    .form-container-register p:nth-child(1){
      margin: auto;
      display: block;
      text-align: center;
      cursor: pointer;
    }
  .form-container-register  .switch {
      position: relative;
      cursor: pointer;
      display: inline-block;
      width: 37px;
      height: 20px;
      margin-top: 5px;
      margin-bottom: 5px;
     
    }
  .form-container-register .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }
  
  .form-container-register .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }
  
  .form-container-register .slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }
  .form-container-register input:checked + .slider {
    background-color: rgb(0,102,153);
  }
  
  .form-container-register input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }
  
 .form-container-register input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
  
  /* Rounded sliders */
  .form-container-register .slider.round {
    border-radius: 34px;
  }
  
  .form-container-register .slider.round:before {
    border-radius: 50%;
  }
  .form-container-register p a:link{
    color: red;
  }
  .form-container-register a:visited{
    color: red;
  }
  .form-container-register label{
    
  margin: auto;
  display: block;
  text-align: center;
  
  }
  #passcode_text,#terms{
    margin-left: 7px;;
  }
  #OpenForm{
    text-decoration: underline;
    font-weight: bold;
    cursor: pointer;
  }
</style>


  <div class="form-container-fluid-box-overlay">
    <div class="form-container-register">
      
      <p><i class="fa fa-close" id="closeForm"></i></p>
      <h1>Register</h1>
      <form  id="FormDatas">
      
        <label><b>Email:</b></label>
        
        <input type="email"  name="email" autofocus="off" size="25" autocomplete="on"  placeholder="Enter mail...">
        
        <br>
        
        <label><b>Password</b></label>
      
        <input type="password" name="password" id="password_text" autofocus="off" autocomplete="off" size="25"  placeholder="password">
  
         <br>
     
        <label class="switch">
          <input type="checkbox" onclick="show_password_text()">
          <span class="round slider">
            
          </span></label><b id="passcode_text"> show password</b>
        <br>
            
        <label class="switch">
          <input type="checkbox" value="Yes" id="terms" name="terms">
          <span class="round slider">
            
          </span></label>   <b id="terms"> I accept the terms and condition</b>
        
          <p><a href="#">Terms and conditions</a></p>
          <p><a href="#">Privacy Policy</a></p>
          <i class="reg_error_message" style="text-align: center;margin:auto;display: block; color: rgba(255,0,0,0.8);"></i>
  
            <input type="submit">
        
        </form>
    </div>
    
  </div>
<script>
  
  if(window.history.replaceState){

    window.history.replaceState(null,null,window.location.href);
    
    
      }
      function show_password_text(){
    
    var passcode = document.querySelector("#password_text");
    
    if (passcode.type == "password"){
    
    document.querySelector("#passcode_text").innerHTML ="Hide password";
      
    
    passcode.type = "text";
    
    
    }else{
    
    
      document.querySelector("#passcode_text").innerHTML ="Show password";
      
      passcode.type ="password";
    }
    
    
    
      }
      
    


      $(document).ready(function (e) {

        $("#FormDatas").on('submit', (function(e){
        
        
          e.preventDefault();
          
         document.querySelector(".loader-container-overlay").style.display= "block";
        
           $.ajax({
         
            url: 'Process/Register',
        type : 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
            success:function(Data){
        
              document.querySelector(".loader-container-overlay").style.display= "none";
             
             document.querySelector(".reg_error_message").innerHTML = Data;
        
        
        if(Data == "\r\nsuccess"){
          

          document.querySelector("#FormDatas").reset();
          
          document.querySelector(".reg_error_message").innerHTML = "";
        
document.querySelector(".form-container-fluid-box-overlay").style.width="0%";
    
alert("Regisration successful");
        
        }else if(Data == "success"){
        
          document.querySelector("#FormDatas").reset();
          
          document.querySelector(".reg_error_message").innerHTML = "";
        
          alert("Regisration successful")
        
        }
        
            },
            error:function(Data){
              document.querySelector(".loader-container-overlay").style.display= "none";
              document.querySelector(".reg_error_message").innerHTML = Data;
        
            }
          
           });
        
        
        
        }));
        
        
  
      });

      document.querySelector("#closeForm").addEventListener("click",CloseRegForm);
function CloseRegForm(){
document.querySelector(".form-container-fluid-box-overlay").style.width="0%";

}

document.querySelector("#OpenForm").addEventListener("click",OpenRegForm);
function OpenRegForm(){
document.querySelector(".form-container-fluid-box-overlay").style.width="100%";

}
</script>
