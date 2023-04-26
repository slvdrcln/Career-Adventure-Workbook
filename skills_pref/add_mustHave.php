<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['submit'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $salary = $_POST['salary'];
   $salary = filter_var($salary, FILTER_SANITIZE_STRING);
   $benefits = $_POST['benefits'];
   $benefits = filter_var($benefits, FILTER_SANITIZE_STRING);

   $work_env = $_POST['work_env'];
   $work_env = filter_var($work_env, FILTER_SANITIZE_STRING);




   $add_mustHave = $conn->prepare("INSERT INTO `must_have`(id, user_id, title, salary, benefits, work_env) VALUES(?,?,?,?,?,?)");
   $add_mustHave->execute([$id, $user_id, $title, $salary, $benefits, $work_env]);

   $message[] = 'New must haves added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Must haves</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">


</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

<h1 class="heading">Must haves</h1>

<form action="" method="post" enctype="multipart/form-data">
<input type="text" name="title" hidden value="Must haves"/>
<p>Minimum acceptable total compensation (salary + bonus):</p>
      <input type="text" name="salary" class="box" required>
      <p>Benefits you must have (from your employer): <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        e.g. health, dental, mental, vision, life, disability, prescription, workers compensation, and/or pet insurance; wellness program, meals, discounts, diversity program, etc.</span></i></span></p>
      <textarea name="benefits" class="box" required maxlength="1000" cols="30" rows="10"></textarea>
      <p>Culture and work environment (describe your desired company or team culture and behaviors):</p>
      <textarea name="work_env" class="box" required maxlength="1000" cols="30" rows="10"></textarea>



   <input type="submit" value="Create" name="submit" class="btn">
</form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
