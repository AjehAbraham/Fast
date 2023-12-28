
  
  $(document).ready(function (e) {
    
    $("#update-form").on('submit', (function(e){
    
    
      e.preventDefault();
      
     document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Proccess/Update order status',
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
  
      alert("Order status has been updated successfully");

      window.location.reload();
  
    }else if(Data == "success"){
    
      document.querySelector(".remove_error_message").innerHTML = "";

      alert("Order status has been updated successfully");

      window.location.reload();
    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".remove_error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    
    
  
  function Open_pin_box(){
  
  document.querySelector(".transaction-pin-overlay").style.width ="100%";
  
  }
  
  function Close_pin_box(){
  
  document.querySelector(".transaction-pin-overlay").style.width ="0%";
  
  }

  



function copy_no(){

var Tracking_no = document.querySelector("#Track_no");


Tracking_no.select();

navigator.clipboard.writeText(Tracking_no.value);

alert("Tracking number copied to clipboard");

document.querySelector(".copy-message").innerHTML="Copied";

}