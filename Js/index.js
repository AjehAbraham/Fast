/*document.querySelector(".confirmation-message").addEventListener("click", add_to_cart_message);

function add_to_cart_message(){

 var succes = document.querySelector(".Success-message").getElementsByClassName.display ="blovk";


}

function addComma(){
    var comma = document.querySelector(".add-comma").value;
    console.log(comma.toLocaleString());
}    
window.onload = "add-comma()";

function openMessage(){

document.querySelector(".cart-confrimation-message").style.display = "block";


}*/


document.querySelector("#backTO-top-btn").addEventListener("click",backTop);

function backTop(){

  document.querySelector(".header-container").scrollIntoView({
    behavior: 'smooth',
  });


}