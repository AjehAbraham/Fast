
function copy_no(){

    var Tracking_no = document.querySelector("#Track_no");
   
   
    Tracking_no.select();
    
    navigator.clipboard.writeText(Tracking_no.value);
   
    alert("Tracking number copied to clipboard");
   
    document.querySelector(".copy-message").innerHTML="Copied";
   
   }



   
  document.querySelector("#open-btn").addEventListener("click",open_report);
  function open_report(){
    document.querySelector(".Report-order-container").style.width="100%";
  }
  
  document.querySelector(".close-btn").addEventListener("click",close_report);
  function close_report(){
    document.querySelector(".Report-order-container").style.width="0%";
  
  }
  
  
  $(document).ready(function (e) {
  
    $("#Report-order").on('submit', (function(e){
    
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Process/Report order',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    
    
    if(Data == "success"){
    
      alert("Complain has been Lodege/forward successfully");
    
      document.querySelector(".Report-order-container").style.width="0%";
  
    }else if(Data == "\r\nsuccess"){
    
    
      alert("Complain has been Lodege/forward successfully");
  
      
    document.querySelector(".Report-order-container").style.width="0%";
    }
    
    
    
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });
  
  