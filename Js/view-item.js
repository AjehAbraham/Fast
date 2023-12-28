
document.querySelector(".open-review-btn").addEventListener("click",OpenReview);
function OpenReview(){

  document.querySelector(".rating-container").style.width ="100%";
}


document.querySelector("#close-btn").addEventListener("click",closeReview);
function closeReview(){

  document.querySelector(".rating-container").style.width ="0%";
}

      
$(document).ready(function (e) {
      
  $("#FormID").on('submit', (function(e){
  
  
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
        
        document.querySelector(".success-message-overlay").style.width="100%";

        document.querySelector(".data-reponse-data").style.backgroundColor="red";

        document.querySelector(".data-reponse-data").innerHTML ="Opps!,Failed to add item";

//alert("Failed to add Item");

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
  



      
      document.querySelector("#Like_form").addEventListener("click",Like_item);
      function Like_item(){
    
        document.querySelector(".loader-container-overlay").style.display ="block";
        
        var form = $("#like-form");
        
        var url = "Process/Rate item";
        
        $.ajax({
        
        type : 'POST',
        url : url,
        data: form.serialize(),
        dataType: 'json',
        encode: true,
        success: function(data){
      
        
        },
        error: function(data){
        
          document.querySelector(".loader-container-overlay").style.display ="none";
        
        
        var error_message = document.querySelector(".rating_error_message");
        
        error_message.innerHTML = data.responseText;
        
        
        
        }
        });
        
        
        }
    
    
    
        document.querySelector("#dis-like").addEventListener("click",Dis_like_item);
        function Dis_like_item(){
      
          document.querySelector(".loader-container-overlay").style.display ="block";
          
          var form = $("#dislike-form");
          
          var url = "Process/Rate item";
          
          $.ajax({
          
          type : 'POST',
          url : url,
          data: form.serialize(),
          dataType: 'json',
          encode: true,
          success: function(data){
        
          
          },
          error: function(data){
          
            document.querySelector(".loader-container-overlay").style.display ="none";
          
          
          var error_message = document.querySelector(".rating_error_message");
          
          error_message.innerHTML = data.responseText;
          
          
          
          }
          });
          
          
          }
      
    
    
    
    
    
      $(document).ready(function (e) {
          
        $("#complain_form").on('submit', (function(e){
        
        
          e.preventDefault();
          
         document.querySelector(".loader-container-overlay").style.display= "block";
        
           $.ajax({
         
            url: 'Process/Rate item',
        type : 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
            success:function(Data){
        
           document.querySelector(".loader-container-overlay").style.display= "none";
        
             document.querySelector(".Review_error_message").innerHTML = Data;
        
        
        if(Data == "\r\nsuccess"){
          
    document.querySelector("#complain_form").reset();
    
        }else if(Data == "success"){
        
        
          document.querySelector("#complain_form").reset();
    
       
    
        }
        
        
            },
            error:function(Data){
              document.querySelector(".loader-container-overlay").style.display= "none";
        
              document.querySelector(".Review_error_message").innerHTML = Data;
        
            }
          
           });
        
        
        
        }));
        
        
          });