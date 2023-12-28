
$(document).ready(function (e) {

    $("#search-bar").on('submit', (function(e){
    
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Proccess/Search location',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_messages").innerHTML = Data;
    
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_messages").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });

  

    $(document).ready(function (e) {

      $("#location-form").on('submit', (function(e){
      
      
      e.preventDefault();
      
       document.querySelector(".loader-container-overlay").style.display= "block";
      
      $.ajax({
      
      url: 'Proccess/Add location',
      type : 'POST',
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success:function(Data){
      
      document.querySelector(".loader-container-overlay").style.display= "none";
      
      document.querySelector(".error_message").innerHTML = Data;
      
      if(Data == "success"){
      
      document.querySelector("#location-form").reset();
      
        alert("Location Added");
      
      }else if(Data == "\r\nsuccess"){
      
        document.querySelector("#location-form").reset();
      
        alert("Location Added");
      }
      
      
      
      },
      error:function(Data){
      document.querySelector(".loader-container-overlay").style.display= "none";
      
      document.querySelector(".error_message").innerHTML = Data;
      
      }
      
      });
      
      
      
      }));
      
      
      });
      
  document.querySelector(".open-btn-overlay").addEventListener("click",openForm);

function openForm(){

document.querySelector(".form-overlay-container").style.width="100%";

}


document.querySelector("#closeForm").addEventListener("click",closeForm);

function closeForm(event){

document.querySelector(".form-overlay-container").style.width="0%";

}
