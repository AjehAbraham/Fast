
document.querySelector(".backTo_top").addEventListener("click",back_top_top);

function back_top_top(){

document.querySelector("#Refresh").scrollIntoView({

  behavior: 'smooth',

});

}



function fetch_data(){

 // document.querySelector(".loader-container-overlay").style.display= "block";
  
  var form = $("#fetch_data");
  
  var url = "Process/Notification";
  
  $.ajax({
  
  type : 'POST',
  url : url,
  data: form.serialize(),
  dataType: 'json',
  encode: true,
  success: function(data){
  
  
  
  },
  error: function(data){
  
    //document.querySelector(".loader-container-overlay").style.display= "none";
  
  var error_message = document.querySelector(".error_message");
  
  
  
  
  if(data.responseText == "\r\nok"){
  
  
    error_message.innerHTML = "";
    
    location.reload();
  
  
  }else{
  
  
  
    error_message.innerHTML = data.responseText;
  
  }
  
  
  }
  });
  
  }

  document.querySelector("#Refresh").addEventListener("click",Refresh_data);

  function Refresh_data(){

    // document.querySelector(".loader-container-overlay").style.display= "block";
     

    var body = document.body;

    body.classList.add("add-animation");
    

     var form = $("#fetch_data");

     var url = "Process/Notification";
     
     $.ajax({
     
     type : 'POST',
     url : url,
     data: form.serialize(),
     dataType: 'json',
     encode: true,
     success: function(data){
     
     
     
     },
     error: function(data){
     
       //document.querySelector(".loader-container-overlay").style.display= "none";
     
       var body = document.body;

       body.classList.remove("add-animation");
       


     var error_message = document.querySelector(".error_message");
     

     if(data.responseText == "\r\nok"){
     
     
       error_message.innerHTML = "";
       
       location.reload();
     
     
     }else{
     
     
     
       error_message.innerHTML = data.responseText;
     
     }
     
     
     }
     });
     
     }

