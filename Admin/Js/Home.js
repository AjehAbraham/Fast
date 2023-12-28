
$(document).ready(function (e) {

    $("#Upload-items-form").on('submit', (function(e){
    
    
      e.preventDefault();
    
 document.querySelector(".loader-container-overlay").style.display ="block";
  
    
       $.ajax({
     
        url: 'Upload item',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
      
  
 document.querySelector(".loader-container-overlay").style.display ="none";
  
         
         document.querySelector(".upload-error-message").innerHTML = Data;
    
    
    if(Data == "\r\nok"){
      
      document.querySelector("#Upload-items-form").reset();
      
      document.querySelector(".upload-error-message").innerHTML = "";
      
      document.querySelector("#output").innerHTML = "";
    
        alert("uplopaded");
    
    }else if(Data == "ok"){
    
      document.querySelector("#Upload-items-form").reset();
      
      document.querySelector(".upload-error-message").innerHTML = "";
    
      document.querySelector("#output").innerHTML = " ";
      
      alert("Uploaded");
    }
    
        },
        error:function(Data){
          document.querySelector(".upload-error-message").innerHTML = Data;
    
  
 document.querySelector(".loader-container-overlay").style.display ="none";
  
    
        }
      
       });
    
    
    
    }));
    
    
      });
    
    var loadFile = function(event){
    var image = document.querySelector("#output");
    image.src = URL.createObjectURL(event.target.files[0]);
    
    };
    