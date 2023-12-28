

$(document).ready(function (e) {

  $("#Find-order").on('submit', (function(e){
  
  
  e.preventDefault();
  
   document.querySelector(".loader-container-overlay").style.display= "block";
  
  $.ajax({
  
  url: 'Proccess/Find order',
  type : 'POST',
  data: new FormData(this),
  cache: false,
  contentType: false,
  processData: false,
  success:function(Data){
  
  document.querySelector(".loader-container-overlay").style.display= "none";
  
  document.querySelector(".error_message").innerHTML = Data;
  
  
  },
  error:function(Data){
  document.querySelector(".loader-container-overlay").style.display= "none";
  
  document.querySelector(".error_message").innerHTML = Data;
  
  }
  
  });
  
  
  
  }));
  
  
  });
  
  
  
  
  
  
  
  function Fetch_data(event){
  
  
    document.querySelector(".Order_error_message").innerHTML = "...";
    
    var form = $("#form_id");
    
    var url = "Proccess/Fetch order";
    
    $.ajax({
    
      type: 'POST',
      url: url,
      data: form.serialize(),
      dataType: 'json',
      encode: true,
      success: function (data) {
    
       
      },
      error: function (data) {
    
   document.querySelector(".loader-container-overlay").style.display= "none";
  
        var error_message = document.querySelector(".Order_error_message");
    
        error_message.innerHTML = data.responseText;
    
        if (data.responseText === "\r\nError") {
    
          error_message.innerHTML = "Error fetching data,please try again.";
        }else if(data.responseText == "Error"){
  
          error_message.innerHTML="Error Fetching Data,Please try again";
        }
    
      }
    });
    
    
    }
    
    my_var = Fetch_data();
  
    
    document.querySelector(".Refresh-order").addEventListener("click",Refresh_data);
    
    
    function Refresh_data(){
    
  document.querySelector(".loader-container-overlay").style.display= "block";
    
      var body = document.body;
    
      body.classList.add("add-loading");
      
    
      var form = $("#refresh_data");
    
      var url = "Proccess/Fetch order";
      
      $.ajax({
      
        type: 'POST',
        url: url,
        data: form.serialize(),
        dataType: 'json',
        encode: true,
        success: function (data) {
      
       
    
        },
        error: function (data) {
      
  document.querySelector(".loader-container-overlay").style.display= "none";
  
          body.classList.remove("add-loading");
      
          var error_message = document.querySelector(".Order_error_message");
      
          error_message.innerHTML = data.responseText;
      
      
          if (data.responseText === "\r\nError") {
      
            error_message.innerHTML = "Error fetching data,please try again.";
      
          }else if(data.responseText == "Error"){
  
  
            error_message.innerHTML = "Error Fetching data,Please try again or Re-load page";
          }
        }
      });
      
    
    
    
    
    }
    