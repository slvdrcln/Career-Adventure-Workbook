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
   <title>Preferred working hours & days</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Preferred working days & hours</h1>

   <?php
    $select_preference = $conn->prepare("SELECT * FROM `preference` WHERE id = ? AND user_id = ?");
    $select_preference->execute([$get_id, $user_id]);
    if($select_preference->rowCount() > 0){
       while($fetch_preference = $select_preference->fetch(PDO::FETCH_ASSOC)){
          $preference_id = $fetch_preference['id'];
        
        ?>

   <div class="view" id="link">
   <span style="float: right; font-size: 1.8rem; padding-top: 1rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
      <div class="name">Preferred places</div>
      <p class="description"><?= $fetch_preference['pref_place_one']; ?></p>
<p class="description"><?= $fetch_preference['pref_place_two']; ?></p>
<p class="description"><?= $fetch_preference['pref_place_three']; ?></p>
<p class="description"><?= $fetch_preference['pref_place_four']; ?></p>
<p class="description"><?= $fetch_preference['pref_place_five']; ?></p>
      <div class="name">Preferred days</div>
      <p class="description"><?= $fetch_preference['days']; ?></p>
      <div class="name">Preferred working hours</div>
      <p class="description"><?= $fetch_preference['hours']; ?></p>
      
   </div>

   <?php

        
   }
   } else {
   echo '<p class="empty">No preferences added yet!</p>';
   header('location: ../admin/skills_preference.php');
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