
  if(window.history.replaceState){

    window.history.replaceState(null,null,window.location.href);
    
    
      }
      function show_password_text(){
    
    var passcode = document.querySelector("#password");
    
    if (passcode.type == "password"){
    
    
      passcode.type = "text";
    
    
    }else{
    
    
      passcode.type ="password";
    }
    
    
    
      }
    
    
      function submit_form(event){
    
        event.preventDefault();
    
        document.querySelector(".loader-container-overlay").style.display ="block";
    
    
    var form = $("#form_id");
    
    var url = "Process/Login";
    
    $.ajax({
    
    type : 'POST',
    url : url,
    data: form.serialize(),
    dataType: 'json',
    encode: true,
    success: function(data){
    
      document.querySelector(".loader-container-overlay").style.display ="none";
    
      alert("submiited once");
    
      console.log();
    
    var error_message = document.querySelector(".error_message");
    
    error_message.innerHTML = data.responseText;
    
    
    },
    error: function(data){
     
    
      document.querySelector(".loader-container-overlay").style.display ="none";
    
      var error_message = document.querySelector(".error_message");
    
      error_message.innerHTML = data.responseText;
    
    if(data-responseText === "\r\nok"){
    
    
    alert("Login successful");
    
    window.location.href = "dashboard";
    
    
    }else if(data.responseText == "ok"){
    
    
      alert("Login successful");
    
    window.location.href = "dashboard";
      
    }
    
    
    
    
    }
    });
       
        }