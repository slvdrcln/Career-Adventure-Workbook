<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_awards'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $award_name = $_POST['award_name'];
   $award_name = filter_var($award_name, FILTER_SANITIZE_STRING);
   $award_date = $_POST['award_date'];
   $award_date = filter_var($award_date, FILTER_SANITIZE_STRING);
   $granting_body = $_POST['granting_body'];
   $granting_body = filter_var($granting_body, FILTER_SANITIZE_STRING);
   $granting = $_POST['granting'];
   $granting = filter_var($granting, FILTER_SANITIZE_STRING);
   $q_one = $_POST['q_one'];
   $q_one = filter_var($q_one, FILTER_SANITIZE_STRING);
   $q_two = $_POST['q_two'];
   $q_two = filter_var($q_two, FILTER_SANITIZE_STRING);

   $q_three = $_POST['q_three'];
   $q_three = filter_var($q_three, FILTER_SANITIZE_STRING);


   $add_educ = $conn->prepare("INSERT INTO `awards_recognition`(id, user_id, title, award_name, award_date, granting_body, granting, q_one, q_two, q_three) VALUES(?,?,?,?,?,?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $award_name, $award_date, $granting_body, $granting, $q_one, $q_two, $q_three]);

   $message[] = 'New awards & recognition added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Awards & recognition</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

  

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Awards & recognition</h1>

   <form action="" method="post" enctype="multipart/form-data">
   <p>Title:</p>
      <input type="text" name="title" class="box" value="Awards & Recognition" readonly>
      <br>
      <br>
      
      <p>Name of award:<span>*</span></p>
      <input type="text" name="award_name" maxlength="100" placeholder="" class="box" required>
      <p>Date of award:<span>*</span></p>
      <input onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" name="award_date" maxlength="100" class="box" required>  
 
      <p>Granting body:</p>
      <input type="text" name="granting_body" maxlength="100" placeholder="" class="box">
      <p>Granting body website, email, or phone:</p>
      <input type="text" name="granting" maxlength="100" placeholder="" class="box">
      <p>What did you do to earn this award?<span>*</span></p>
      <textarea name="q_one" class="box" required maxlength="1000" cols="30" rows="10" required></textarea>
      <p>What does it signify? </p>
      <textarea name="q_two" class="box" required maxlength="1000" cols="30" rows="10"></textarea>
      <p>Why do they offer it? </p>
      <textarea name="q_three" class="box" required maxlength="1000" cols="30" rows="10"></textarea>

      <input type="submit" value="Create" name="add_awards" class="btn">

   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
