<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_prof_dev'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $course_name = $_POST['course_name'];
   $course_name = filter_var($course_name, FILTER_SANITIZE_STRING);
   $educ_body = $_POST['educ_body'];
   $educ_body = filter_var($educ_body, FILTER_SANITIZE_STRING);
   $educ_web = $_POST['educ_web'];
   $educ_web = filter_var($educ_web, FILTER_SANITIZE_STRING);
   $comp_date = $_POST['comp_date'];
   $comp_date = filter_var($comp_date, FILTER_SANITIZE_STRING);

   $add_educ = $conn->prepare("INSERT INTO `professional_development`(id, user_id, title, course_name, educ_body, educ_web, comp_date) VALUES(?,?,?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $course_name, $educ_body, $educ_web, $comp_date]);

   $message[] = 'New professional development added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professional development</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
  

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Professional Development</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Title:</p>
      <input type="text" name="title" value="Professional Development" class="box" readonly>
      <br>
      <br>
      
      <p>Name of course/curriculum:</p>
      <input type="text" name="course_name" maxlength="100" placeholder="" class="box" required>
	<p>Education body:</p>
      <input type="text" name="educ_body" maxlength="100" placeholder="" class="box">
      <p>Education body website, email, or phone:</p>
      <input type="text" name="educ_web" maxlength="100" placeholder="" class="box">

      <p>Completion date:</p>
	<input onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" name="comp_date" maxlength="100" class="box" required> 

      <input type="submit" value="Create" name="add_prof_dev" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
