<?php
include '../components/connect.php';


if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:../admin/credentials.php');
}?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professional certficate</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Professional certficate</h1>

   <?php
    $select_professional_certficate = $conn->prepare("SELECT * FROM `professional_certificate` WHERE id = ? AND user_id = ?");
    $select_professional_certficate->execute([$get_id, $user_id]);
    if($select_professional_certficate->rowCount() > 0){
       while($fetch_professional_certficate = $select_professional_certficate->fetch(PDO::FETCH_ASSOC)){
          $professional_certficate_id = $fetch_professional_certficate['id'];
        
        ?>

<div class="view" id="link">
   <span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
      <div class="name">Name of certificate</div>
      <p class="description"><?= $fetch_professional_certficate['cert_name']; ?></p>
      <div class="name">Certificate number</div>
      <p class="description"><?= $fetch_professional_certficate['cert_number']; ?></p>
      <div class="name">What it certifies</div>
      <p class="description"><?= $fetch_professional_certficate['certifies']; ?></p>
      <div class="name">Certifying body</div>
      <p class="description"><?= $fetch_professional_certficate['cert_body']; ?></p>
      <div class="name">Certifying body website, email or phone</div>
      <p class="description"><?= $fetch_professional_certficate['cert_web']; ?></p>
      <div class="name">Earned date</div>
      <p class="description"><?= $fetch_professional_certficate['earned_date']; ?></p>
      <div class="name">Expiration date</div>
      <p class="description"><?= $fetch_professional_certficate['expiry_date']; ?></p>
       </div>

   <?php

        
        }

    } else {
    echo '<p class="empty">no professional certificate added yet!</p>';
    header('location: ../admin/credentials.php');
    exit();
    }

      ?>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
<script>

var copybtn = document.getElementById("copy-btn");
   var link = document.getElementById("link");


 copybtn.onclick = function(){
   navigator.clipboard.writeText(link.innerText);
   copybtn.innerText = "Copied";
   setTimeout(() => {
      copybtn.innerText
   }, 2000);
 }
</script>

</body>
</html>