
function OpenPassword(){

    document.querySelector(".change-passowrd-overlay").style.width="100%";
    
    }
    function closePassword(){
     
    document.querySelector(".change-passowrd-overlay").style.width="0%";
     
    }


    
var url = "Process/Update password";



$(document).ready(function (e) {

  $("#FormData").on('submit', (function(e){
  
  
    e.preventDefault();
    
   document.querySelector(".loader-container-overlay").style.display= "block";
  
     $.ajax({
   
      url: 'Process/Update password',
  type : 'POST',
  data: new FormData(this),
  cache: false,
  contentType: false,
  processData: false,
      success:function(Data){
  
        document.querySelector(".loader-container-overlay").style.display= "none";
       
       document.querySelector(".error_message").innerHTML = Data;
  
  
  if(Data == "\r\nsuccess"){
    

    document.querySelector("#FormData").reset();
    
    document.querySelector(".error_message").innerHTML = "";
  

  
  }else if(Data == "success"){
  
    document.querySelector("#FormData").reset();
    
    document.querySelector(".error_message").innerHTML = "";
  
    
  
  }
  
      },
      error:function(Data){
        document.querySelector(".loader-container-overlay").style.display= "none";
        document.querySelector(".error_message").innerHTML = Data;
  
      }
    
     });
  
  
  
  }));
  
  

});

document.querySelector(".Open__history_btn").addEventListener("click",open_hist);
function open_hist(){

document.querySelector(".container-fluid").style.width ="100%";


}

document.querySelector("#close_history_btn").addEventListener("click",close_hist);
function close_hist(){

document.querySelector(".container-fluid").style.width ="0%";


}



function TwoFactor(event){
    
  event.preventDefault();

document.querySelector(".loader-container-overlay").style.display ="block";

//var form = document.querySelector("#form_id");
var form = $("#Two-factor");

var url = "Process/Two factor";

$.ajax({

type : 'POST',
url : url,
data: form.serialize(),
dataType: 'json',
encode: true,
success: function(data){

console.log();

document.querySelector(".loader-container-overlay").style.display ="none";


var error_message = document.querySelector(".error_message");

error_message.innerHTML = data.responseText;


var error_message = document.querySelector(".Two_factor_error_message");

error_message.innerHTML = data.responseText;



if(data.responseText === "\r\nok"){

document.querySelector("#two_factor_btn").checked = true;

alert("Two factor ON successful");



}else if(data.responseText == "\r\nokk"){



document.querySelector("#two_factor_btn").checked = false;

alert("Two factor Off successful");


}
  


},
error: function(data){

  document.querySelector(".loader-container-overlay").style.display ="none";


var error_message = document.querySelector(".Two_factor_error_message");

error_message.innerHTML = data.responseText;


if(data.responseText === "\r\nok"){

  error_message.innerHTML = "";

  document.querySelector("#two_factor_btn").checked = true;

  alert("Two factor ON successful");

}else if(data.responseText == "\r\nokk"){


error_message.innerHTML = "";

document.querySelector("#two_factor_btn").checked = false;

alert("Two factor Off successful");


}
  





}
});
 
  }