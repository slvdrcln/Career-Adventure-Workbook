<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
} else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
      
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);

   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);


   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   


   $uppercase = preg_match('@[A-Z]@', $pass);
   $lowercase = preg_match('@[a-z]@', $pass);
   $number = preg_match('@[0-9]@', $pass);
   $specialChars = preg_match('@[^\w]@', $pass);

   $uppercase = preg_match('@[A-Z]@', $pass);
   $lowercase = preg_match('@[a-z]@', $pass);
   $number = preg_match('@[0-9]@', $pass);
   $specialChars = preg_match('@[^\w]@', $pass);

    
   if($select_user->rowCount() > 0){
      $message[] = 'Email is already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'Password do not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, phone, password) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $phone, $cpass]);
         $message[] = 'User added successfully! Please login now';
      }
   }


}

if(isset($_POST['login'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
     setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
     header('location:admin/dashboard.php');

   }else{
      $message[] = 'Incorrect email or password. Please try again';
   }

}

if(isset($_POST['logout'])){

header('location:../index.php');
   $message[] = 'Successfully logged out';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Career Adventure</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/register.css">
   <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
   

</head>
<body style="padding-left: 0;">




<div class="container">
   <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   <div class="forms-container">
      
      <div class="signin-signup">
         
          <form action="#" class="sign-up-form" method="post" enctype="multipart/form-data">
            <h2 class="title">Register</h2>
            <div class="input-field"><i class="fas fa-user"></i><input type="text" name="name" placeholder="Full name" required/></div>
            <!-- <div class="input-field"><i class="fa-regular fa-user"></i><input type="text" name="nickname"  placeholder="Nickname"/></div> -->
            <div class="input-field"><i class="fas fa-envelope"></i><input type="email" name="email" placeholder="Personal email" required/></div>
            <div class="input-field"><i class="fa-solid fa-phone"></i><input type="text" name="phone" placeholder="Personal phone" required/></div>
            <!-- <div class="input-field"><i class="fa-solid fa-location-dot"></i><input type="text" name="address" placeholder="Home address(Country, Region, City)" required/></div>
            <div class="input-field"><i class="fa-brands fa-facebook"></i><input type="text" name="facebook" placeholder="Facebook"/></div>
            <div class="input-field"><i class="fa-brands fa-linkedin"></i><input type="text" name="instagram" placeholder="Instagram"/></div>
            <div class="input-field"><i class="fa-brands fa-instagram"></i><input type="text" name="linkedin" placeholder="LinkedIn"/></div>
            <div class="input-field"><i class="fa-solid fa-at"></i><input type="text" name="website" placeholder="Website URL"/></div> -->
            <div class="input-field"><i class="fas fa-lock"></i><input type="password" id="pass" name="pass" placeholder="Password" required/><span onclick="pass()"><i class="fas fa-eye" id="hide_eye_pass"></i><i class="fas fa-eye-slash" id="hide_slash_pass"></i></span></div>
            
            
            <div class="input-field"><i class="fas fa-lock"></i><input type="password" id="cpass" name="cpass" placeholder="Confirm password" required/><span onclick="cPass()"><i class="fas fa-eye" id="hide_eye_cpass"></i><i class="fas fa-eye-slash" id="hide_slash_cpass"></i></span></div>
            <input type="submit" name="submit" value="Register" class="btn solid" />
          </form>

          <form action="#" class="sign-in-form" method="post" enctype="multipart/form-data">
           
            <h2 class="title">Login</h2>
            <div class="input-field"><i class="fas fa-envelope"></i><input type="email" name="email" placeholder="Email" required/></div>
            <div class="input-field"><i class="fas fa-lock"></i><input id="password" type="password" name="pass" placeholder="Password" required /><span onclick="showPass()"><i class="fas fa-eye" id="hide_eye"></i><i class="fas fa-eye-slash" id="hide_slash"></i></span></div>

<br>

            <input type="submit" name="login" class="btn" value="Login" />
		
      
          </form>
      </div>
   </div>

            <div class="panels-container">
               <div class="panel left-panel">
                  <div class="content">
                     <h3>Welcome to Career Adventure</h3>
                     <p>Are your new here? Register here.</p>
                     <button class="btn transparent" id="sign-up-btn">register</button>
                  </div>
                  <img src="img/signup.svg" class="image" alt="" />
               </div>
               <div class="panel right-panel">
                  <div class="content">
                     <h3>Your adventure starts here...</h3>
                     <p>Before you start applying for jobs, you should consider a few salient points. </p>
                     <button class="btn transparent" id="sign-in-btn">LOGIN</button>
                  </div>
                  <img src="img/book.svg" class="image" alt="" />
               </div>
            </div>
</div>






<script>

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");


sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
  });
  
  sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
  });

function showPass(){
   const password_input = document.getElementById('password');
   const eye = document.getElementById('hide_eye');
   const slash = document.getElementById('hide_slash');

   if(password_input.type === 'password'){
      password_input.type = "text";
      eye.style.display = "block";
      slash.style.display = "none";
   } else{
      password_input.type = "password";
      eye.style.display = "none";
      slash.style.display = "block";
   }
}

function pass(){
   const pass = document.getElementById('pass');
   const eye_pass = document.getElementById('hide_eye_pass');
   const slash_pass = document.getElementById('hide_slash_pass');

   if(pass.type === 'password'){
      pass.type = "text";
      eye_pass.style.display = "block";
      slash_pass.style.display = "none";
   } else{
      pass.type = "password";
      eye_pass.style.display = "none";
      slash_pass.style.display = "block";
   }
}

function cPass(){
   const cpass = document.getElementById('cpass');
   const eye_cpass = document.getElementById('hide_eye_cpass');
   const slash_cpass = document.getElementById('hide_slash_cpass');

   if(cpass.type === 'password'){
      cpass.type = "text";
      eye_cpass.style.display = "block";
      slash_cpass.style.display = "none";
   } else{
      cpass.type = "password";
      eye_cpass.style.display = "none";
      slash_cpass.style.display = "block";
   }
}

</script>


   
</body>
</html>