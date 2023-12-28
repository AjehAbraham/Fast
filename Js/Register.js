
  if(window.history.replaceState){

    window.history.replaceState(null,null,window.location.href);
    
    
      }
      function show_password_text(){
    
    var passcode = document.querySelector("#password_text");
    
    if (passcode.type == "password"){
    
    document.querySelector("#passcode_text").innerHTML ="Hide password";
      
    
    passcode.type = "text";
    
    
    }else{
    
    
      document.querySelector("#passcode_text").innerHTML ="Show password";
      
      passcode.type ="password";
    }
    
    
    
      }
    
    
      function submit_form(event){
    
        event.preventDefault();
    
    document.querySelector(".loader-container-overlay").style.display ="block";
    
    //var form = document.querySelector("#form_id");
    var form = $("#form_id");
    
    var url = "Process/Register";
    
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
    

    var error_message = document.querySelector(".error_message");

    error_message.innerHTML = data.responseText;
    
    
    
    if(data.responseText === "\r\nsuccess"){
    
    document.querySelector("#form_id").reset();

      alert("Login successful");
    
      //location.reload();
    
    }
        

    
    },
    error: function(data){
    
        document.querySelector(".loader-container-overlay").style.display ="none";
    
    
      var error_message = document.querySelector(".error_message");
    
      error_message.innerHTML = data.responseText;


if(data.responseText == "\r\nok"){

document.querySelector("#form_id").reset();
  alert("Registration successful");


}

    
    
    }
    });
       
        }

           
document.querySelector(".close-message-btn").addEventListener("click",close_message_text);

function close_message_text(){

document.querySelector(".success-message-overlay").style.display = "none";

  }