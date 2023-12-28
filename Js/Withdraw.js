
  
      
  $(document).ready(function (e) {
      
    $("#Withdraw").on('submit', (function(e){
    
    
      e.preventDefault();
      
     document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Process/Withdraw',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".error_message").innerHTML = Data;
    
    
    if(Data == "\r\nsuccess"){
      
      alert("Withdrawal successfully");

document.querySelector("#Withdraw").reset();

window.location.href="Widthrawal status";

    }else if(Data == "success"){
    
    
      alert("Withdrawal successfully");

      document.querySelector("#Withdraw").reset();

      window.location.href="Widthrawal status";

    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    