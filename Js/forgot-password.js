
      
  $(document).ready(function (e) {
      
    $("#forgot-password").on('submit', (function(e){
    
    
      e.preventDefault();
      
    document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Process/Check-email',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".error_message").innerHTML = Data;
    
    
    if(Data == "\r\nsuccess"){
      

document.querySelector("#forgot-password").reset();

document.querySelector(".error_message").innerHTML="";

window.location.href="create-password";

    }else if(Data == "success"){
    
    
document.querySelector(".error_message").innerHTML="";
      document.querySelector("#forgot-password").reset();

      window.location.href="create-password";

    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    
    