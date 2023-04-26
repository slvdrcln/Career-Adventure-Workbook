<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_prof_lic'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $license_name = $_POST['license_name'];
   $license_name = filter_var($license_name, FILTER_SANITIZE_STRING);
   $license_number = $_POST['license_number'];
   $license_number = filter_var($license_number, FILTER_SANITIZE_STRING);
   $granting = $_POST['granting'];
   $granting = filter_var($granting, FILTER_SANITIZE_STRING);
   $granting_contact = $_POST['granting_contact'];
   $granting_contact = filter_var($granting_contact, FILTER_SANITIZE_STRING);
   $earned_date = $_POST['earned_date'];
   $earned_date = filter_var($earned_date, FILTER_SANITIZE_STRING);
   $expiry_date = $_POST['expiry_date'];
   $expiry_date = filter_var($expiry_date, FILTER_SANITIZE_STRING);

   $add_educ = $conn->prepare("INSERT INTO `professional_license`(id, user_id, title, license_name, license_number, granting, granting_contact, earned_date, expiry_date) VALUES(?,?,?,?,?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $license_name, $license_number, $granting, $granting_contact, $earned_date, $expiry_date]);

   $message[] = 'New professional license added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professional License</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
  

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Professional License</h1>

   <form action="" method="post" enctype="multipart/form-data">
   <p>Title:</p>
      <input type="text" name="title" class="box" value="Professional License" readonly>
      <br>
      <br>
      
      <p>Name of license:</p>
      <input type="text" name="license_name" maxlength="100" placeholder="" class="box">
      <p>License number:</p>
      <input type="text" name="license_number" maxlength="100" placeholder="" class="box">
      <p>License granting body: </p>      
      <input type="text" name="granting" maxlength="100" placeholder="" class="box">
      <p>License granting body contact info: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
      website, email, or phone</span></i></span></p>      
      <input type="text" name="granting_contact" maxlength="100" placeholder="" class="box">
      <p>Earned date:</p>
      <input onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" name="earned_date" maxlength="100" placeholder="" class="box"> 
      
<p>Expiration date: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        if not date, enter status (e.g. suspended, inactive)</span></i></span></p>
      <input type="text" name="expiry_date" maxlength="100" placeholder="yyyy-mm-dd" class="box">

      <input type="submit" value="Create" name="add_prof_lic" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
