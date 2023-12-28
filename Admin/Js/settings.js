
$(document).ready(function (e) {
    
    $("#FormData").on('submit', (function(e){
    
    
      e.preventDefault();
      
     document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Proccess/change-password',
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
  
      alert("Password has been updated successfully");
  
      document.querySelector("#FormData").reset();
  
    }else if(Data == "success"){
    
      document.querySelector(".error_message").innerHTML = "";
  
      alert("Password has been updated successfully");
  
      document.querySelector("#FormData").reset();
    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    
  
  
  //OPEN AND CLOSE CHANGE PASSSWORD
  
  
  document.querySelector(".open-change-password-btn").addEventListener("click",Open_password);
  
  function Open_password(){
  
  document.querySelector(".change-password-container-overlay").style.width = "100%";
  }
  
  document.querySelector("#close-change-password-btn").addEventListener("click",Close_password);
  
  function Close_password(){
  
  document.querySelector(".change-password-container-overlay").style.width = "0%";
  }
  
  
  
  
      $(document).ready(function (e) {
    
    $("#keyForm").on('submit', (function(e){
    
    
      e.preventDefault();
      
     document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Proccess/change-secret-key',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".secret_error_message").innerHTML = Data;
    
    
    if(Data == "\r\nsuccess"){
      
      document.querySelector(".secret_error_message").innerHTML = "";
  
      alert("Secret key has been updated successfully");
  
      document.querySelector("#keyForm").reset();
  
    }else if(Data == "success"){
    
      document.querySelector(".remove_error_message").innerHTML = "";
  
      alert("Secret key has been updated successfully");
  
      document.querySelector("#keyForm").reset();
    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".secret_error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    
  
  
  
  //OPEND AND CLOSE EMAIL//
  
  document.querySelector(".open-email-btn").addEventListener("click",Open_email);
  
  function Open_email(){
  
  document.querySelector(".change-email-container-overlay").style.width = "100%";
  }
  
  document.querySelector("#close-email").addEventListener("click",Close_email);
  
  function Close_email(){
   // alert("oyoyo");
  
  document.querySelector(".change-email-container-overlay").style.width = "0%";
  }
  
  //CHANGE EMAIL DATA//
  
  
  
  
  
  
      
      $(document).ready(function (e) {
    
    $("#emailForm").on('submit', (function(e){
    
    
      e.preventDefault();
      
     document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Proccess/change-email',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".email_error_message").innerHTML = Data;
    
    
    if(Data == "\r\nsuccess"){
      
      document.querySelector(".email_error_message").innerHTML = "";
  
      alert("Email  has been updated successfully");
  
      document.querySelector("#emailForm").reset();
  
    }else if(Data == "success"){
    
      document.querySelector(".remove_error_message").innerHTML = "";
  
      alert("Email has been updated successfully");
  
      document.querySelector("#emailForm").reset();
    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".email_error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
      
  
      document.querySelector("#secretKey-btn").addEventListener("click",Open_secrey_key);
  
  function Open_secrey_key(){
  
  document.querySelector(".change-secret-key-container-overlay").style.width = "100%";
  }
  
  document.querySelector("#close-secret-key-btn").addEventListener("click",Close_secrey_key);
  
  function Close_secrey_key(){
   
  
  document.querySelector(".change-secret-key-container-overlay").style.width = "0%";
  }
  //CHANGE SCET KEY BTN//
  
  
  