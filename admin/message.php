<?php
include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">



</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Messages</h1>



   <div class="view">
      <br>
      <h2>Your contracts</h2>
      <div class="name">i.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_one"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_one" class="description">Hi ____, remember when we ______? How are you? You family/friend?</p>
      <div class="name">ii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_two"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_two" class="description">May I send you my resume?</p>
      <div class="name">iii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_three"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_three" class="description">My role, location, industry preferences are...</p>
      <div class="name">iv.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_four"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_four" class="description">Thank you for keeping an eye open for me</p>
      <div class="name">v.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_five"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_five" class="description">Still looking, can we meet? I respect your advice.</p>
      <div class="name">vi.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_six"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_six" class="description">Do you know anyone at ______? They have a _____ role open.</p>
      <div class="name">vii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_seven"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_seven" class="description">Good here, got the job, Thank you!</p>
   </div>

</section>

<section class="playlist-form">
<div class="view">
   <br>
<h2>Recruiters/Hiring managers</h2>
      <div class="name">I. Writing to them - know the job opening. </div> 
      <div class="name" style="text-indent: 15px;">i.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_eight"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div>
      <p class="description" id="link_eight" style="text-indent: 15px;">What role, why that role, why their company, why me? </p> 
      <br>

      <div class="name" style="text-indent: 15px;">ii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_nine"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div>
      <p class="description" id="link_nine" style="text-indent: 15px;">Following up, reminder of match for required competencies </p> 

      <div class="name" style="text-indent: 15px;">iii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_ten"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div>
      <p class="description" id="link_ten" style="text-indent: 15px;">Last chance, share your STAR story(s) </p> 


      <div class="name">II. No openings known </div> 

      <div class="name" style="text-indent: 15px;">i.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_eleven"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div>
      <p class="description" id="link_eleven" style="text-indent: 15px;">I want to connect because I hope to work for your organization </p>

      <div class="name" style="text-indent: 15px;">ii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_twelve"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div>
      <p class="description" id="link_twelve" style="text-indent: 15px;">Thank you for connecting. I am interested in _______ role. </p>

      <div class="name" style="text-indent: 15px;">iii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_thirteen"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div>
      <p class="description" id="link_thirteen" style="text-indent: 15px;">May I send you my resume? </p>
</div>
</section>


<section class="playlist-form">
   <div class="view">
      <br>
      <h2>Thankyou</h2>
      <div class="name">i.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_fourteen"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_fourteen" class="description">Thank you for speaking/meeting with me</p>
      <div class="name">i.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_fifteen"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_fifteen" class="description">Thank you for helping me speaking with/connecting with</p>
      <div class="name">vii.<span style="float: right; font-size: 1.8rem; color: #4472ca;"id="btn_sixteen"><i class="fa-regular fa-clone"></i><span id="msg"></span></span></div> 
      <p id="link_sixteen" class="description">Thank you for the interview </p>
<br><br><br>
      <p style="float: right; font-size: 1.7rem;" class="description"><i>add a notable moment why it stuck with you</i></p>
<br>
<br>
   </div>
</section>

















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
<script>

var btn_one = document.getElementById("btn_one");
var link_one = document.getElementById("link_one");


 btn_one.onclick = function(){
   navigator.clipboard.writeText(link_one.innerText);
   btn_one.innerText = "Copied";
   setTimeout(() => {
      btn_one.innerText
   }, 2000);
 }


 var btn_two = document.getElementById("btn_two");
var link_two = document.getElementById("link_two");


 btn_two.onclick = function(){
   navigator.clipboard.writeText(link_two.innerText);
   btn_two.innerText = "Copied";
   setTimeout(() => {
      btn_two.innerText
   }, 2000);
 }


 var btn_three = document.getElementById("btn_three");
var link_three = document.getElementById("link_three");


 btn_three.onclick = function(){
   navigator.clipboard.writeText(link_three.innerText);
   btn_three.innerText = "Copied";
   setTimeout(() => {
      btn_three.innerText
   }, 2000);
 }

 var btn_four = document.getElementById("btn_four");
var link_four = document.getElementById("link_four");


 btn_four.onclick = function(){
   navigator.clipboard.writeText(link_four.innerText);
   btn_four.innerText = "Copied";
   setTimeout(() => {
      btn_four.innerText
   }, 2000);
 }

 var btn_five = document.getElementById("btn_five");
var link_five = document.getElementById("link_five");


 btn_five.onclick = function(){
   navigator.clipboard.writeText(link_five.innerText);
   btn_five.innerText = "Copied";
   setTimeout(() => {
      btn_five.innerText
   }, 2000);
 }

 var btn_six = document.getElementById("btn_six");
var link_six = document.getElementById("link_six");


 btn_six.onclick = function(){
   navigator.clipboard.writeText(link_six.innerText);
   btn_six.innerText = "Copied";
   setTimeout(() => {
      btn_six.innerText
   }, 2000);
 }

 var btn_seven = document.getElementById("btn_seven");
var link_seven = document.getElementById("link_seven");


 btn_seven.onclick = function(){
   navigator.clipboard.writeText(link_seven.innerText);
   btn_seven.innerText = "Copied";
   setTimeout(() => {
      btn_seven.innerText
   }, 2000);
 }

 var btn_eight = document.getElementById("btn_eight");
var link_eight = document.getElementById("link_eight");


 btn_eight.onclick = function(){
   navigator.clipboard.writeText(link_eight.innerText);
   btn_eight.innerText = "Copied";
   setTimeout(() => {
      btn_eight.innerText
   }, 2000);
 }


 var btn_nine = document.getElementById("btn_nine");
var link_nine = document.getElementById("link_nine");


 btn_nine.onclick = function(){
   navigator.clipboard.writeText(link_nine.innerText);
   btn_nine.innerText = "Copied";
   setTimeout(() => {
      btn_nine.innerText
   }, 2000);
 }

 var btn_ten = document.getElementById("btn_ten");
var link_ten = document.getElementById("link_ten");


 btn_ten.onclick = function(){
   navigator.clipboard.writeText(link_ten.innerText);
   btn_ten.innerText = "Copied";
   setTimeout(() => {
      btn_ten.innerText
   }, 2000);
 }

 var btn_eleven = document.getElementById("btn_eleven");
var link_eleven = document.getElementById("link_eleven");


 btn_eleven.onclick = function(){
   navigator.clipboard.writeText(link_eleven.innerText);
   btn_eleven.innerText = "Copied";
   setTimeout(() => {
      btn_eleven.innerText
   }, 2000);
 }

 var btn_twelve = document.getElementById("btn_twelve");
var link_twelve = document.getElementById("link_twelve");


 btn_twelve.onclick = function(){
   navigator.clipboard.writeText(link_twelve.innerText);
   btn_twelve.innerText = "Copied";
   setTimeout(() => {
      btn_twelve.innerText
   }, 2000);
 }
 

 var btn_thirteen = document.getElementById("btn_thirteen");
var link_thirteen = document.getElementById("link_thirteen");


 btn_thirteen.onclick = function(){
   navigator.clipboard.writeText(link_thirteen.innerText);
   btn_thirteen.innerText = "Copied";
   setTimeout(() => {
      btn_thirteen.innerText
   }, 2000);
 }

 var btn_fourteen = document.getElementById("btn_fourteen");
var link_fourteen = document.getElementById("link_fourteen");


 btn_fourteen.onclick = function(){
   navigator.clipboard.writeText(link_fourteen.innerText);
   btn_fourteen.innerText = "Copied";
   setTimeout(() => {
      btn_fourteen.innerText
   }, 2000);
 }

 var btn_fifteen = document.getElementById("btn_fifteen");
var link_fifteen = document.getElementById("link_fifteen");


 btn_fifteen.onclick = function(){
   navigator.clipboard.writeText(link_fifteen.innerText);
   btn_fifteen.innerText = "Copied";
   setTimeout(() => {
      btn_fifteen.innerText
   }, 2000);
 }

 var btn_sixteen = document.getElementById("btn_sixteen");
var link_sixteen = document.getElementById("link_sixteen");


 btn_sixteen.onclick = function(){
   navigator.clipboard.writeText(link_sixteen.innerText);
   btn_sixteen.innerText = "Copied";
   setTimeout(() => {
      btn_sixteen.innerText
   }, 2000);
 }
</script>

</body>
</html>