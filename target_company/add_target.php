<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_target'])){
 
  $id = unique_id();
  $company_name = $_POST['company_name'];
  $company_name = filter_var($company_name, FILTER_SANITIZE_STRING);
  $resume = $_POST['resume'];
  $resume = filter_var($resume, FILTER_SANITIZE_STRING);
  $cover = $_POST['cover'];
  $cover = filter_var($cover, FILTER_SANITIZE_STRING);
  $position = $_POST['position'];
  $position = filter_var($position, FILTER_SANITIZE_STRING);
  $location = $_POST['location'];
  $location = filter_var($location, FILTER_SANITIZE_STRING);

  $add_educ = $conn->prepare("INSERT INTO `target_company`(id, user_id, company_name, resume, cover, position, location) VALUES(?,?,?,?,?,?,?)");
  $add_educ->execute([$id, $user_id, $company_name, $resume, $cover, $position, $location]);

  $message[] = 'New target company added!';  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Target Company</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">


</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Target Company</h1>

   <form action="" method="post" enctype="multipart/form-data">

      <p>Company name:<span>*</span></p>
      <input type="text" name="company_name" maxlength="100" class="box" required>
      <p>Resume that you sent:<span>*</span> <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        can be online storage link (e.g. Google Drive URL)</span></i></span></p>
      <input type="text" name="resume" maxlength="100" class="box" required>
      <p>Cover letter that you sent: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        can be a url from google drive, make sure it is for sharing.</span></i></span></p>
      <input type="text" name="cover" maxlength="100" class="box">
      <p>Position you applied for:</p>
      <input type="text" name="position" maxlength="100" class="box">
      <p>Location for this position:</p>
      <input type="text" name="location" maxlength="100" class="box">
     
      <input type="submit" value="Create" name="add_target" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
