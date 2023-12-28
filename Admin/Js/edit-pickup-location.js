

$(document).ready(function (e) {

    $("#edit-location-form").on('submit', (function(e){
    
    
    e.preventDefault();
    
    // document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Proccess/Edit pickup location',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    //document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    
    
    if(Data == "success"){
    
    document.querySelector("#edit-location-form").reset();
    
      alert("Location Updated successfully");
    
    }else if(Data == "\r\nsuccess"){
    
      document.querySelector("#edit-location-form").reset();
    
      alert("Location Edited successfully");
    }
    
    
    
    },
    error:function(Data){
    //document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });