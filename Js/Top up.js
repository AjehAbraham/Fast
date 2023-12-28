

  
$(document).ready(function (e) {
  
    $("#Top-up-form").on('submit', (function(e){
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Process/Top-up',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".Topup_error_message").innerHTML = Data;
    
    
    
    if(Data == "success"){
    
      alert("successful");
    
  
    }else if(Data == "\r\nsuccess"){
    
    
      alert("successful");
  
    
    }
    
    
    
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".Topup_error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });