
$(document).ready(function (e) {

    $("#AdminForm").on('submit', (function(e){
    
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Proccess/Create Admin',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    
    if(Data === "ok"){
    
    error_message.innerHTML = "";
    
    document.querySelector("#AdminForm").reset();
    
    
    alert("admin created,email will be sent to user to compelte the regisration prcocess.");
    
    }
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });
    