   
$(document).ready(function (e) {
      
    $(".FormData").on('submit', (function(e){
    
    
      e.preventDefault();
      
    document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Process/Add cart item',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".error_message").innerHTML = Data;

         if(Data == "\r\nsuccess"){

          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Item Added Successfuly!";

        //  alert("Item added");

         }else if(Data == "\r\nok"){

          
          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Quantity increased!";
          
         }else{

          if(Data == "success"){

            document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Item Added Successfuly!";

        //  alert("Item added")
          }else if(Data == "ok"){

            
          
          document.querySelector(".success-message-overlay").style.width="100%";

document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

document.querySelector(".data-reponse-data").innerHTML ="Quantity increased!";
          }else{
          
          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="red";

          document.querySelector(".data-reponse-data").innerHTML ="Opps!,Failed to add item";

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
    
          document.querySelector(".error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    

     

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

//console.log();

document.querySelector(".loader-container-overlay").style.display ="none";


},
error: function(data){

  document.querySelector(".loader-container-overlay").style.display ="none";


document.querySelector(".cart_error_message").innerHTML = data.responseText;


//STARTING OF NESTED FUNCTION



$(document).ready(function (e) {
    
    $(".RemoveForm").on('submit', (function(e){
    
    
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
    
        // document.querySelector(".error_messages").innerHTML = Data;

         if(Data == "\r\nsuccess"){

          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Item has been removed Successfuly!";

//FETCH CART ITEMS/UPDATE CART ITEMS//




document.querySelector(".show-selected-cart-items-container").style.width= "0%";



         }else if(Data == "\r\nok"){

          
          document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Quantity increased!";
          
         }else{

          if(Data == "success"){

            document.querySelector(".success-message-overlay").style.width="100%";

          document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

          document.querySelector(".data-reponse-data").innerHTML ="Item Added Successfuly!";


          document.querySelector(".show-selected-cart-items-container").style.width= "0%";


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
    
        //  document.querySelector(".error_messages").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
    
//END OF NESTED FUNCTION//  


     



}
});


}




 
   
function totalItem(){
//document.querySelector("#totalItem").innerHTML = "...";

var form = $("#totalItem");

var url = "Process/totalItem";

$.ajax({
type: 'POST',
url: url,
data: form.serialize(),
dataType: 'json',
encode: true,
success: function (data) {

console.log();


var error_message = document.querySelector("#totalItem").innerHTML = data.responseText;



},
error: function (data) {


var error_message = document.querySelector("#totalItem").innerHTML = data.responseText;



}
});

}


var CheckerCart = setInterval(totalItem,2000);


  document.querySelector("#backTO-top-btn").addEventListener("click",backTop);
