
document.querySelector(".back-top-top").addEventListener("click",backToTop);

function backToTop(){

  
document.querySelector(".error_message").scrollIntoView({
behavior: 'smooth',

});

}

document.querySelector(".open-overlay").addEventListener("click",ViewMore);
function ViewMore(){


  var More_details = document.querySelector(".container");

var Message = document.querySelector(".open-overlay");
  if(More_details.style.display == "none"){

    More_details.style.display = "block";
Message.innerHTML = "View less <i class='fa fa-close' ></i>";

  }else{

Message.innerHTML = "More User info <i class='fa fa-bars' ></i>";
    
More_details.style.display= "none";


  }
 
}





function Block_account(event){


  event.preventDefault();
  
  var form = $("#form_block");
  
  var url = "Proccess/Block user account";
  
  $.ajax({
  
  type : 'POST',
  url : url,
  data: form.serialize(),
  dataType: 'json',
  encode: true,
  success: function(data){
  
  console.log();
  
  },
  error: function(data){
  var error_message = document.querySelector(".error_message").innerHTML = data.responseText;
  
  
  if(data.responseText == "\r\nBlock" || data.responseText == "Block"){
  
  document.querySelector("#block-account").checked = true;
  
  var error_message = document.querySelector(".error_message").innerHTML = "";

  alert("Account has been blocked");
  
  }else if(data.responseText == "\r\nUnBlock" || data.responseText =="UnBlock"){
  
  
  document.querySelector("#block-account").checked = false;
  
  var error_message = document.querySelector(".error_message").innerHTML = "";

  alert("Account has been Un-blocked");
  }
  
  
  
  }
  });
  
  }
  
  
   
  function Block_Payment(event){
  
  
    event.preventDefault();
    
    var form = $("#form_Block-payment");
    
    var url = "Proccess/Block user account";
    
    $.ajax({
    
    type : 'POST',
    url : url,
    data: form.serialize(),
    dataType: 'json',
    encode: true,
    success: function(data){
    
    console.log();
    
    },
    error: function(data){
    var error_message = document.querySelector(".error_message").innerHTML = data.responseText;
  
  
  
  if(data.responseText == "\r\nBlock" || data.responseText =="Block"){
  
  document.querySelector("#Block-payment").checked = true;
  
  var error_message = document.querySelector(".error_message").innerHTML = "";

  alert("Payment  has been blocked");

  }else if(data.responseText == "\r\nUnBlock" || data.responseText =="UnBlock"){
  
  
  document.querySelector("#Block-payment").checked = false;
  
  var error_message = document.querySelector(".error_message").innerHTML = "";

  alert("Payment has been Un-blocked");
  }
  
  
  
  
  }
    });
    
                  }
  
  

