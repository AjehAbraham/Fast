
$(document).ready(function (e) {
      
    $("#forgot-password").on('submit', (function(e){
    
    
      e.preventDefault();
      
    document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Process/Verify otp',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".error_message").innerHTML = Data;
    
    
    if(Data == "\r\nsuccess"){
      

      document.querySelector(".error_message").innerHTML = "";
document.querySelector("#forgot-password").reset();


alert("Password has been updated successfully");

      window.location.href="Login";


    }else if(Data == "success"){
    
    
      document.querySelector(".error_message").innerHTML = "";

      document.querySelector("#forgot-password").reset();

      alert("Password has been updated successfully");
      window.location.href="Login";

    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    