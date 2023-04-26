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
   header('location:target_company.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Target company</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Target company</h1>

   <?php
    $select_target = $conn->prepare("SELECT * FROM `target_company` WHERE id = ? AND user_id = ?");
    $select_target->execute([$get_id, $user_id]);
    if($select_target->rowCount() > 0){
       while($fetch_target = $select_target->fetch(PDO::FETCH_ASSOC)){
          $target_id = $fetch_target['id'];
        
   ?>

   <div class="view" id="link">
      <span style="float: right; font-size: 1.8rem; padding-top: 1rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
         <div class="name">Company name</div>
         <p class="description"><?= $fetch_target['company_name']; ?></p>
         <div class="name">Resume</div>
         <p class="description"><?= $fetch_target['resume']; ?></p>
         <div class="name">Cover Letter</div>
         <p class="description"><?= $fetch_target['cover']; ?></p>
         <div class="name">Position you applied to</div>
         <p class="description"><?= $fetch_target['position']; ?></p>
         <div class="name">Company Location</div>
         <p class="description"><?= $fetch_target['location']; ?></p>

   </div>

   <?php

        
   } 

   } else {
   echo '<p class="empty">No target company added yet!</p>';
   header('location: ../admin/target_companies.php');
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