
$(document).ready(function (e) {
      
    $(".FormDatas").on('submit', (function(e){
    
    
     e.preventDefault();
      
    document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Process/remove-item',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".error_messages").innerHTML = Data;

         if(Data == "\r\nsuccess"){

          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Item has been removed Successfuly!";
window.location.reload();

         }else if(Data == "\r\nok"){

          
          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Quantity increased!";
          
         }else{

          if(Data == "success"){

            document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Item Added Successfuly!";

          window.location.reload();

          }else if(Data == "ok"){

            
          
          document.querySelector(".success-message-overlay").style.width="100%";

document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

document.querySelector(".data-reponse-data").innerHTML ="Quantity increased!";
          }else{
          
          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="red";

          document.querySelector(".data-reponse-data").innerHTML ="Opps!,Failed to remove item";

//alert("Failed to add Item");

         }
       
        }
    //REMOVE SUCCESS MESSAGE USING NESTED LOOP//
    function RemoveResponseText(){

      document.querySelector(".success-message-overlay").style.width= "0";
    }

var RemoveText = setTimeout(RemoveResponseText, 1000);


        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".error_messages").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    

  
document.querySelector("#Order_permision_btn")
.addEventListener("click",OpenOrder_permision);

function OpenOrder_permision(){


document.querySelector(".Warning-danger").style.width ='100%';


}


//document.querySelector("#close_order_btn").addEventListener("click",closeOrder_permision);

function closeOrder_permision(){


document.querySelector(".Warning-danger").style.width ='0%';

}


//document.querySelector("#delivery").addEventListener("onchange",Location(event));

function fetch_delivery_point(event){

event.preventDefault();


document.querySelector(".Main_address_error_message").innerHTML="...";

var form = $("#Locations_form");

var url = "Process/Delivery Location";

$.ajax({

type : 'POST',
url : url,
data: form.serialize(),
dataType: 'json',
encode: true,
success: function(data){

console.log();


var error_message = document.querySelector(".Main_address_error_message");

error_message.innerHTML = data.responseText;


var error_message = document.querySelector(".Main_address_error_message");

error_message.innerHTML = data.responseText;


},
error: function(data){


var error_message = document.querySelector(".Main_address_error_message");

error_message.innerHTML = data.responseText;




}
});

}




function fetch_address(event){


event.preventDefault();


document.querySelector(".address_error_message").innerHTML="...";

var form = $("#Locations_form");

var url = "Process/Delivery LGA";

$.ajax({

type : 'POST',
url : url,
data: form.serialize(),
dataType: 'json',
encode: true,
success: function(data){

console.log();


var error_message = document.querySelector(".address_error_message");

error_message.innerHTML = data.responseText;


var error_message = document.querySelector(".address_error_message");

error_message.innerHTML = data.responseText;


},
error: function(data){


var error_message = document.querySelector(".address_error_message");

error_message.innerHTML = data.responseText;




}
});



}







//document.querySelector(".open-payment").addEventListener("click",OpenPayment_method);


function OpenPayment_method(){

var payment = document.querySelector(".form-container");


if(payment.style.display == "none"){


payment.style.display ="block";
}else{


payment.style.display ="none";

}

/*
if(payment.style.width == "0%"){


document.querySelector(".Save-payment").style.display="none";
payment.style.width = "100%";

}else{


payment.style.width = "0%";

}
*/

}




// document.querySelector("#open_info").addEventListener("click",OpenCard);
function OpenCard(){

document.querySelector(".Save-payment").style.display="block";

document.querySelector(".credit-card-container").style.display="block";

document.querySelector("#Type_card").checked =true;

document.querySelector("#Type_balance").checked =false;

document.querySelector("#Type_saved").checked =false;


document.querySelector(".seletec_card_pin").style.display="none"
document.querySelector(".Balance_display").style.display="none";
}


//document.querySelector("#open_info").addEventListener("click",closeCard);
function closeCard(){

  
document.querySelector("#Type_balance").checked =false;
document.querySelector("#Type_saved").checked =true;
document.querySelector("#Type_card").checked =false;

document.querySelector(".Save-payment").style.display="none";

document.querySelector(".credit-card-container").style.display="none";


document.querySelector(".seletec_card_pin").style.display="block" 

document.querySelector(".Balance_display").style.display="none";

}


function Bal_payment(){

document.querySelector(".Save-payment").style.display="none";

document.querySelector(".credit-card-container").style.display="none";

document.querySelector("#Type_saved").checked =false;
document.querySelector("#Type_card").checked =false;
document.querySelector("#Type_balance").checked =true;

document.querySelector(".Balance_display").style.display="block";

document.querySelector(".seletec_card_pin").style.display="none"
}



function Validate_card(event){

event.preventDefault();


document.querySelector(".card_error_message").innerHTML="...";

var form = $("#form");

var url = "Process/Validate card";

$.ajax({

type : 'POST',
url : url,
data: form.serialize(),
dataType: 'json',
encode: true,
success: function(data){

console.log();


var error_message = document.querySelector(".card_error_message");

error_message.innerHTML = data.responseText;


var error_message = document.querySelector(".card_error_message");

error_message.innerHTML = data.responseText;


/*
if(data.responseText === "\r\nsuccess"){

//document.querySelector("#form_id").reset();

alert("Two factor ON successful");



}else if(data.responseText == "\r\nsuccess"){


alert("Two factor Off successful");


}*/



},
error: function(data){


var error_message = document.querySelector(".card_error_message");

error_message.innerHTML = data.responseText;

/*
if(data.responseText === "\r\nok"){

error_message.innerHTML = "";


alert("Two factor Updated successful");

}else if(data.responseText == "\r\nokk"){


error_message.innerHTML = "";

alert("Two factor Off successful");


}*/






}
});




}





function Submit_payment(event){
  
    event.preventDefault();
    
    document.querySelector(".loader-container-overlay").style.display ="block";
    
    var form = $("#form");
    
    var url = "Process/Process Payment";
    
    $.ajax({
    
    type : 'POST',
    url : url,
    data: form.serialize(),
    dataType: 'json',
    encode: true,
    success: function(data){
    
    console.log();
    
    document.querySelector(".loader-container-overlay").style.display ="none";
    
  
    if(data.responseText == "success"){
    
    error_message.innerHTML = "";
    
    alert("Payment successful");
  
    window.location.href = "Transaction status";
    
    }else if(data.responseText == "\r\nsuccess"){
    
    
    error_message.innerHTML = "";
    
    
    window.location.href = "Transaction status";
    
    alert("Payment successful.");
    
    }
    
    
    
    
  
  
  
    
    },
    error: function(data){
    
    document.querySelector(".loader-container-overlay").style.display ="none";
    
    
    var error_message = document.querySelector(".error_message");
    
    error_message.innerHTML = data.responseText;
    
    
    if(data.responseText == "success"){
    
    error_message.innerHTML = "";
    
    alert("Payment successful");
  
    window.location.href = "Transaction status";
    
    }else if(data.responseText == "\r\nsuccess"){
    
    
    error_message.innerHTML = "";
    
    
    window.location.href = "Transaction status";
    
    alert("Payment successful.");
    
    }
    
    
    
    
    
    
    }
    });
    
    }