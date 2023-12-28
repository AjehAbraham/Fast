
function openSidebar(){
  
  var body = document.body;
  
 body.classList.add("open-sidebar");

}

document.querySelector("#closeSideBar").addEventListener("click",closeSidebar);

function closeSidebar(){

var body = document.body;
  
body.classList.remove("open-sidebar");

}

function showBal(){

  var Status = document.querySelector(".account_balance");
var Bal = localStorage.getItem("BalStatus");
var Acct = document.querySelector("#acct").value;


if(Bal == "Hide"){

  localStorage.setItem("BalStatus","Show");

}else if(Bal == "Show"){


  localStorage.setItem("BalStatus","Hide");

}else{


  localStorage.setItem("BalStatus","Hide");

}


if(Bal == "Hide"){

document.querySelector(".account_balance").innerHTML="<i class='fa fa-asterisk'></i><i class='fa fa-asterisk'></i><i class='fa fa-asterisk'></i><i class='fa fa-asterisk'></i>";

document.querySelector(".hide_show_bt").innerHTML = "<i class='fa fa-eye-slash'>";

}else{


  document.querySelector(".account_balance").innerHTML= Acct;

document.querySelector(".hide_show_bt").innerHTML = "<i class='fa fa-eye'>";

}


}
function FetchBal(){
var Bal = localStorage.getItem("BalStatus");

var Acct = document.querySelector("#acct").value;

if(Bal == "Hide"){

document.querySelector(".account_balance").innerHTML="<i class='fa fa-asterisk'></i><i class='fa fa-asterisk'></i><i class='fa fa-asterisk'></i><i class='fa fa-asterisk'></i>";

document.querySelector(".hide_show_bt").innerHTML = "<i class='fa fa-eye-slash'>";

}else{

  document.querySelector(".account_balance").innerHTML= Acct;

document.querySelector(".hide_show_bt").innerHTML = "<i class='fa fa-eye'>";

}
}
 var Status = FetchBal();


$(document).ready(function (e) {
    
$("#Edit-form-data").on('submit', (function(e){


  e.preventDefault();
  
document.querySelector(".loader-container-overlay").style.display= "block";

   $.ajax({
 
    url: 'Process/Edit profile',
type : 'POST',
data: new FormData(this),
cache: false,
contentType: false,
processData: false,
    success:function(Data){

   document.querySelector(".loader-container-overlay").style.display= "none";

     document.querySelector(".Edit-data_error_message").innerHTML = Data;


if(Data == "\r\nok"){
 
document.querySelector(".form-container-overlay-box").style.width="0%";

document.querySelector(".Edit-data_error_message").innerHTML="";

alert("Updated successfully");


//window.location.reload();

}else if(Data == "ok"){

document.querySelector(".form-container-overlay-box").style.width="0%";

 document.querySelector(".Edit-data_error_message").innerHTML="";


alert("Updated successfully");

//window.location.reload();

}


    },
    error:function(Data){
      document.querySelector(".loader-container-overlay").style.display= "none";

      document.querySelector(".Edit-data_error_message").innerHTML = Data;

    }
  
   });



}));


  });


  document.querySelector(".open-form-data-btn").addEventListener("click", OpenFrom);
  function OpenFrom(event){

    document.querySelector(".form-container-overlay-box").style.width ="100%";
  }

  document.querySelector("#close-form-data-btn").addEventListener("click", CloseFrom);
  function CloseFrom(){

    document.querySelector(".form-container-overlay-box").style.width ="0%";
  }




function OpenWarning(){

document.querySelector(".confirm-delete").style.width="100%";
}

function CancelWarning(){

document.querySelector(".confirm-delete").style.width="0%";
}

function CancelWarning(){

document.querySelector(".confirm-delete").style.width="0%";
}



var loadFile = 
function upload(event){
  var image = document.querySelector("#output");
  image.src = URL.createObjectURL(event.target.files[0]);
 // document.querySelector(".upload").innerHTML="Upload";
  }

  
  
$(document).ready(function (e) {
    
    $("#Upload-form-data").on('submit', (function(e){
    
    
      e.preventDefault();
      
    document.querySelector(".loader-container-overlay").style.display= "block";
    
       $.ajax({
     
        url: 'Upload-profile-pics',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
        success:function(Data){
    
       document.querySelector(".loader-container-overlay").style.display= "none";
    
         document.querySelector(".dp_error_message").innerHTML = Data;
    
    
    if(Data == "\r\success"){

  
  alert("Updated successfully");
  
  window.location.reload();
  
    }else if(Data == "success"){
  
   
    alert("Updated successfully");
  
    window.location.reload();
  
    }
    
    
        },
        error:function(Data){
          document.querySelector(".loader-container-overlay").style.display= "none";
    
          document.querySelector(".dp_error_message").innerHTML = Data;
    
        }
      
       });
    
    
    
    }));
    
    
      });
  
      document.querySelector(".Top_up-btn-top").addEventListener("click",Open_top_up_fs);
      function Open_top_up_fs(){
        document.querySelector(".Top-up-container-overlay-box").style.display ="block";
      }
      

      /*TOP UP CONTIANER JS*/
      document.querySelector(".Open-top-up-btn").addEventListener("click",Open_top_up);
      function Open_top_up(){
        document.querySelector(".Top-up-container-overlay-box").style.display ="block";
      }
      
  
      document.querySelector(".close-top-up-btn").addEventListener("click",Close_top_up);
      function Close_top_up(){
        document.querySelector(".Top-up-container-overlay-box").style.display ="none";
      }
  
      
  $(document).ready(function (e) {
    
    $("#Top-up-form").on('submit', (function(e){
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Process/Top-up',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".Topup_error_message").innerHTML = Data;
    
    
    
    if(Data == "success"){
    
      alert("successful");
    
  
    }else if(Data == "\r\nsuccess"){
    
    
      alert("successful");
  
    
    }
    
    
    
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".Topup_error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });
      /*END OF TOP UP CONTAINER JS*/


      
document.querySelector("#Top_up").addEventListener("click",Topup);
function Topup(){
var Add_balance = document.querySelector(".fund-bal-container");

var Add_card = document.querySelector(".form-container-box");

Add_balance.style.display = "block";

Add_card.style.display = "none";

}

document.querySelector("#Add_card").addEventListener("click",Add_card);
function Add_card(){

var Add_card = document.querySelector(".form-container-box");

var Add_balance = document.querySelector(".fund-bal-container");

Add_card.style.display = "block";
  Add_balance.style.display = "none";


}


  
$(document).ready(function (e) {
    
    $("#Add-bal-form").on('submit', (function(e){
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Process/Add-balance',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".Add_bal_error_message").innerHTML = Data;
    
    
    
    if(Data == "success"){
    
      alert("successful");
    
  
    }else if(Data == "\r\nsuccess"){
    
    
      alert("successful");
  
    
    }
    
    
    
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".Add_bal_error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });
    
    var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
selElmnt = x[i].getElementsByTagName("select")[0];
ll = selElmnt.length;
/* For each element, create a new DIV that will act as the selected item: */
a = document.createElement("DIV");
a.setAttribute("class", "select-selected");
a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
x[i].appendChild(a);
/* For each element, create a new DIV that will contain the option list: */
b = document.createElement("DIV");
b.setAttribute("class", "select-items select-hide");
for (j = 1; j < ll; j++) {
  /* For each option in the original select element,
  create a new DIV that will act as an option item: */
  c = document.createElement("DIV");
  c.innerHTML = selElmnt.options[j].innerHTML;
  c.addEventListener("click", function(e) {
      /* When an item is clicked, update the original select box,
      and the selected item: */
      var y, i, k, s, h, sl, yl;
      s = this.parentNode.parentNode.getElementsByTagName("select")[0];
      sl = s.length;
      h = this.parentNode.previousSibling;
      for (i = 0; i < sl; i++) {
        if (s.options[i].innerHTML == this.innerHTML) {
          s.selectedIndex = i;
          h.innerHTML = this.innerHTML;
          y = this.parentNode.getElementsByClassName("same-as-selected");
          yl = y.length;
          for (k = 0; k < yl; k++) {
            y[k].removeAttribute("class");
          }
          this.setAttribute("class", "same-as-selected");
          break;
        }
      }
      h.click();
  });
  b.appendChild(c);
}
x[i].appendChild(b);
a.addEventListener("click", function(e) {
  /* When the select box is clicked, close any other select boxes,
  and open/close the current select box: */
  e.stopPropagation();
  closeAllSelect(this);
  this.nextSibling.classList.toggle("select-hide");
  this.classList.toggle("select-arrow-active");
});
}

function closeAllSelect(elmnt) {
/* A function that will close all select boxes in the document,
except the current select box: */
var x, y, i, xl, yl, arrNo = [];
x = document.getElementsByClassName("select-items");
y = document.getElementsByClassName("select-selected");
xl = x.length;
yl = y.length;
for (i = 0; i < yl; i++) {
  if (elmnt == y[i]) {
    arrNo.push(i)
  } else {
    y[i].classList.remove("select-arrow-active");
  }
}
for (i = 0; i < xl; i++) {
  if (arrNo.indexOf(i)) {
    x[i].classList.add("select-hide");
  }
}
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);