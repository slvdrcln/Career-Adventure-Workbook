<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_invention'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $invention_name = $_POST['invention_name'];
   $invention_name = filter_var($invention_name, FILTER_SANITIZE_STRING);
   $num = $_POST['num'];
   $num = filter_var($num, FILTER_SANITIZE_STRING);
   $country = $_POST['country'];
   $country = filter_var($country, FILTER_SANITIZE_STRING);
   $patent = $_POST['patent'];
   $patent = filter_var($patent, FILTER_SANITIZE_STRING);
   $date_issued = $_POST['date_issued'];
   $date_issued = filter_var($date_issued, FILTER_SANITIZE_STRING);
   $co_name = $_POST['co_name'];
   $co_name = filter_var($co_name, FILTER_SANITIZE_STRING);

   $co_phone = $_POST['co_phone'];
   $co_phone = filter_var($co_phone, FILTER_SANITIZE_STRING);
   $co_email = $_POST['co_email'];
   $co_email = filter_var($co_email, FILTER_SANITIZE_STRING);


   $add_educ = $conn->prepare("INSERT INTO `invention`(id, user_id, title, invention_name, num, country, patent, date_issued, co_name, co_phone, co_email) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $invention_name, $num, $country, $patent, $date_issued, $co_name, $co_phone, $co_email]);

   $message[] = 'New invention added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Invention</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

  

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Invention</h1>

   <form action="" method="post" enctype="multipart/form-data">
   <p>Title:</p>
      <input type="text" name="title" value="Invention" class="box" readonly>
      <br>
      <br>
      
      <p>Official title/name of patent:<span>*</span></p>
      <input type="text" name="invention_name" maxlength="100" class="box" required>
      <p>Link to patent:<span>*</span></p>
      <input type="text" name="patent" maxlength="100" placeholder="" class="box" required>
      <p>Number:</p>
      <input type="text" name="num" maxlength="100" placeholder="" class="box">
      <p>Country:</p>
      <input type="text" name="country" maxlength="100" placeholder="" class="box">
     
      <p>Date issued: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        or pending</span></i></span></p>
      <input type="text" name="date_issued" maxlength="100" placeholder="" class="box">
      <p>Co-inventor(s) name:</p>
      <input type="text" name="co_name" maxlength="100" placeholder="" class="box">
      <p>Co-inventor(s) email:</p>
      <input type="text" name="co_email" maxlength="100" placeholder="" class="box">
      <p>Co-inventor(s) phone:</p>
      <input type="text" name="co_phone" maxlength="100" placeholder="" class="box">
      
     

      <input type="submit" value="Create" name="add_invention" class="btn">

   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
