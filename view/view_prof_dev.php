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

   <h1 class="heading">Professional development</h1>

   <?php
    $select_professional_development = $conn->prepare("SELECT * FROM `professional_development` WHERE id = ? AND user_id = ?");
    $select_professional_development->execute([$get_id, $user_id]);
    if($select_professional_development->rowCount() > 0){
       while($fetch_professional_development = $select_professional_development->fetch(PDO::FETCH_ASSOC)){
          $professional_development_id = $fetch_professional_development['id'];
        
        ?>

<div class="view" id="link">
   <span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
      <div class="name">Name of course/curriculum</div>
      <p class="description"><?= $fetch_professional_development['course_name']; ?></p>
      <div class="name">Education body</div>
      <p class="description"><?= $fetch_professional_development['educ_body']; ?></p>
      <div class="name">Education body website, email, or phone</div>
      <p class="description"><?= $fetch_professional_development['educ_web']; ?></p>
      <div class="name">Completion date</div>
      <p class="description"><?= $fetch_professional_development['comp_date']; ?></p>
      
   </div>

   <?php

        
        }

    } else {
    echo '<p class="empty">no professional development added yet!</p>';
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