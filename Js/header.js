
$(document).ready(function (e) {

  $("#LoginForm").on('submit', (function(e){
  
  
    e.preventDefault();
    
   document.querySelector(".loader-container-overlay").style.display= "block";
  
     $.ajax({
   
      url: 'Process/Login',
  type : 'POST',
  data: new FormData(this),
  cache: false,
  contentType: false,
  processData: false,
      success:function(Data){
  
        document.querySelector(".loader-container-overlay").style.display= "none";
       
       document.querySelector(".Login_error_message").innerHTML = Data;
  
  
  if(Data == "\r\nok"){
    
  
    document.querySelector("#LoginForm").reset();
    
    document.querySelector(".Login_error_message").innerHTML = "";
  
    window.location.reload();
  
  }else if(Data == "ok"){
  
    document.querySelector("#LoginForm").reset();
    
    document.querySelector(".Login_error_message").innerHTML = "";
  
    window.location.reload();
    
  
  }
  
      },
      error:function(Data){
        document.querySelector(".loader-container-overlay").style.display= "none";
        document.querySelector(".Login_error_message").innerHTML = Data;
  
      }
    
     });
  
  
  
  }));
  
  
  
  });
  
  
  
    document.querySelector("#open-sidebar-btn").addEventListener("click",openside_bar);
  
  function openside_bar(){
  
    var body = document.body;
  
    body.classList.add("add-sidebar");
  
      //document.querySelector(".sidebar-menu-container").style.width="100%";
  }
  
  
  document.querySelector(".close-sidebar-btn").addEventListener("click",close_sidebar);
  
  function close_sidebar(){
  
    var body = document.body;
  
    body.classList.remove("add-sidebar");
  }
  
  //OPEN AND CLOSE LOGIN FROM CONTAINER//
  
  
  function open_login_container(){
  
  
  var body = document.body;
  
  body.classList.add("add-login");
  
  
   //   document.querySelector(".login-container-fliud").style.display= "block";
  
  
  }
  
  
  function close_login_container(){
  
  
  var body = document.body;
  
  body.classList.remove("add-login");
  
  
     // document.querySelector(".login-container-fliud").style.display= "none";
  
  }
  
  //SHOW AND HIDE PASSWORD FOR LOGIN CONTAINER
  
  
                  function show_password(){
  
  var password = document.querySelector("#password");
  
  if (password.type === "password"){
  
  password.type =("text");
  
  document.querySelector(".show_passowrd_text").innerHTML="Hide password";
  
  
  
  }else{
  
  
      password.type =("password");
  
      document.querySelector(".show_passowrd_text").innerHTML="Show password";
  
  
  }
                  }
  
  
                  //OPEN AND CLOSE CHECKOUT CONTAINER//
                
                  function open_check_out(){
  
  
                    document.querySelector(".show-selected-cart-items-container").style.width= "100%";
                    
                    
                    document.querySelector(".loader-container-overlay").style.display ="block";
                    
                    
                    var form = $("#fetch_cart");
                    
                    var url = "Process/Fetch_items";
                    
                    $.ajax({
                    
                    type : 'POST',
                    url : url,
                    data: form.serialize(),
                    dataType: 'json',
                    encode: true,
                    success: function(data){
                    
                    console.log();
                    
                    document.querySelector(".loader-container-overlay").style.display ="none";
                    
                    
                    var error_message = document.querySelector(".cart_error_message");
                    
                    error_message.innerHTML = data.responseText;
                    
                    
                    
                    },
                    error: function(data){
                    
                      document.querySelector(".loader-container-overlay").style.display ="none";
                    
                    
                    var error_message = document.querySelector(".cart_error_message");
                    
                    
                    error_message.innerHTML = data.responseText;
                    
                    
                    
                    }
                    });
                    
                    
                    }
  
  
  
  
                  function close_check_out(){
  
  document.querySelector(".show-selected-cart-items-container").style.width= "0%";
  
                  }
  
  
  
                  //OPEN AND CLOSE SEARCH BAR//
     
  document.querySelector(".close-message-btn").addEventListener("click",close_message_text);
  
      function close_message_text(){
  
  document.querySelector(".success-message-overlay").style.display = "none";
  
        }
  
  
    
    function Procced_checkout(){
  
      //event.preventDefault();
      
      
      document.querySelector(".loader-container-overlay").style.display= "block";
      
      var form = $("#check_cart");
      
      var url = "Process/Procced checkout";
      
      $.ajax({
      
      type : 'POST',
      url : url,
      data: form.serialize(),
      dataType: 'json',
      encode: true,
      success: function(data){
      
      
      
      },
      error: function(data){
      
        document.querySelector(".loader-container-overlay").style.display= "none";
      
      var error_message = document.querySelector(".checkout_message");
      
      
      
      
      if(data.responseText == "\r\nok"){
      
      
        error_message.innerHTML = "";
  
        window.location.href="checkout";
      
      
      }else if(data.responseText == "ok"){
      
      
        error_message.innerHTML = "";
  
        window.location.href="checkout";
      
      
      } else{
      
      
      
        error_message.innerHTML = data.responseText;
      
      }
      
      
      }
      });
      
      }
      
  
      function clear_cart_items(){
  
        //event.preventDefault();
        
        
        document.querySelector(".loader-container-overlay").style.display= "block";
        
        var form = $("#check_cart");
        
        var url = "Process/clear cart";
        
        $.ajax({
        
        type : 'POST',
        url : url,
        data: form.serialize(),
        dataType: 'json',
        encode: true,
        success: function(data){
        
        
        
        },
        error: function(data){
        
          document.querySelector(".loader-container-overlay").style.display= "none";
        
        var error_message = document.querySelector(".cart_error_message");
        
        
        
        
        if(data.responseText == "\r\nok"){
        
        
          error_message.innerHTML = "";
          
          //location.reload();
        
        
        }else if (data.responseText == "ok"){
        
        
          error_message.innerHTML = "";
          
          
        
        
        }else{
        
        
        
          error_message.innerHTML = data.responseText;
        
        }
        
        
        }
        });
        
        }
          
  
    