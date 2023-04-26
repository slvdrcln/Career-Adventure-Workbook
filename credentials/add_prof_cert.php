<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_prof_cert'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $cert_name = $_POST['cert_name'];
   $cert_name = filter_var($cert_name, FILTER_SANITIZE_STRING);
   $cert_number = $_POST['cert_number'];
   $cert_number = filter_var($cert_number, FILTER_SANITIZE_STRING);
   $certifies = $_POST['certifies'];
   $certifies = filter_var($certifies, FILTER_SANITIZE_STRING);
   $cert_body = $_POST['cert_body'];
   $cert_body = filter_var($cert_body, FILTER_SANITIZE_STRING);
   $cert_web = $_POST['cert_web'];
   $cert_web = filter_var($cert_web, FILTER_SANITIZE_STRING);

   $earned_date = $_POST['earned_date'];
   $earned_date = filter_var($earned_date, FILTER_SANITIZE_STRING);
   $expiry_date = $_POST['expiry_date'];
   $expiry_date = filter_var($expiry_date, FILTER_SANITIZE_STRING);

   $add_educ = $conn->prepare("INSERT INTO `professional_certificate`(id, user_id, title, cert_name, cert_number, certifies, cert_body, cert_web, earned_date, expiry_date) VALUES(?,?,?,?,?,?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $cert_name, $cert_number, $certifies, $cert_body, $cert_web, $earned_date, $expiry_date]);

   $message[] = 'New professional certification added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professional certification</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

  

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Professional Certification</h1>

   <form action="" method="post" enctype="multipart/form-data">
   <p>Title:</p>
     <input type="text" name="title" value="Professional Certification" class="box" readonly>
      <br>
      <br>
      
      <p>Name of certificate:<span>*</span></p>
      <input type="text" name="cert_name" maxlength="100" placeholder="" class="box" required>
      <p>Certificate number: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        if applicable</span></i></span></p>
      <input type="text" name="cert_number" maxlength="100" placeholder="" class="box">
      <p>What it certifies: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        should copy/paste from certifying website</span></i></span></p>
      <textarea type="text" name="certifies" maxlength="100" placeholder="" cols="30" row="10" class="textArea"></textarea>
      <p>Certifying body:</p>
      <input type="text" name="cert_body" maxlength="100" placeholder="" class="box"> 
      <p>Certifying body website, email or phone:</p>
      <input type="text" name="cert_web" maxlength="100" placeholder="" class="box"> 
      <p>Earned date:</p>
<input onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" name="earned_date" maxlength="100" class="box" required> 
      <p>Expiration date: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        if no expiration date, enter status (e.g. never expires, suspended, inactive)</span></i></span></p>
      <input type="text" name="expiry_date" maxlength="100" placeholder="yyyy-mm-dd" class="box">

      <input type="submit" value="Create" name="add_prof_cert" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
