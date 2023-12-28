
$(document).ready(function (e) {

  $("#edit-form-data").on('submit', (function(e){
  
  
    e.preventDefault();
    
document.querySelector(".loader-container-overlay").style.display= "block";
  
     $.ajax({
   
      url: 'Proccess/Edit item info',
  type : 'POST',
  data: new FormData(this),
  cache: false,
  contentType: false,
  processData: false,
      success:function(Data){
  
     document.querySelector(".loader-container-overlay").style.display= "none";
  
       document.querySelector(".error_message").innerHTML = Data;
  
  
  if(Data == "\r\nsuccess"){
  
    document.querySelector(".error_message").innerHTML ="";
  
  alert("Item has been updated successfully");
  window.location.reload();
  
  }else if(Data == "success"){
  
    document.querySelector(".error_message").innerHTML ="";
  
  alert("Item has been updated successfully");
  window.location.reload();
  }
  
  
  
  
      },
      error:function(Data){
        document.querySelector(".loader-container-overlay").style.display= "none";
  
        document.querySelector(".error_message").innerHTML = Data;
  
      }
    
     });
  
  
  
  }));
  
  
    });
  
  
    
      
    
    
        $(document).ready(function (e) {
    
    $("#remove-item-form").on('submit', (function(e){
    
    
      e.preventDefault();
      
    document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Proccess/Remove item',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".remove_error_message").innerHTML = Data;
    
    
    if(Data == "\r\nsuccess"){
      
      document.querySelector(".remove_error_message").innerHTML = "";
  
      alert("Item has been Removed successfully");
      window.location.reload();
  
    }else if(Data == "success"){
    
      document.querySelector(".remove_error_message").innerHTML = "";
  
      alert("Item has been Remove successfully");

      window.location.reload();
    }else{

if(Data == "ok"){

alert("Item has been added successfully");
window.location.reload();
}


    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".remove_error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    
    
  