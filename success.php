<?php

?>


<style>
.success-message-overlay{

  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 80%;
  background-color: transparent;
  overflow-y: scroll;
  transition: 0.1s;
  z-index: 6;
  width: 0;
}
.success-message-overlay p:nth-child(2){
  background-color: rgb(0,102,153);
  color: white;
  padding: 7px 7px;
  border-radius: ;
  border: none;
font-size: 15px;
text-align: center;
margin: auto;
width: 90%
}
@media screen and (min-width: 600px){
  .success-message-overlay p:nth-child(2){
width: 60%;
  }
}
</style>


    <div class="success-message-overlay">
      <br>
      <p class='data-reponse-data'></p>
    </div>

    