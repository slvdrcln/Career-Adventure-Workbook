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
   header('location:credentials.php');
}?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Skills</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Skills</h1>

   <?php
    $select_skills = $conn->prepare("SELECT * FROM `skills` WHERE id = ? AND user_id = ?");
    $select_skills->execute([$get_id, $user_id]);
    if($select_skills->rowCount() > 0){
       while($fetch_skills = $select_skills->fetch(PDO::FETCH_ASSOC)){
          $skills_id = $fetch_skills['id'];
        
        ?>

   <div class="view" id="link">
   <span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
      <div class="name">Spoken Languages</div>
      <p class="description"><?= $fetch_skills['language_one']; ?>, <?= $fetch_skills['prof_lang_one'];?></p>
      <p class="description"><?= $fetch_skills['language_two']; ?>, <?= $fetch_skills['prof_lang_two'];?></p>
      <p class="description"><?= $fetch_skills['language_three']; ?>, <?= $fetch_skills['prof_lang_three'];?></p>
      <div class="name">Skills</div>
      <p class="description"><?= $fetch_skills['skill_one']; ?></p>
      <p class="description"><?= $fetch_skills['skill_two']; ?></p>
      <p class="description"><?= $fetch_skills['skill_three']; ?></p>
      <p class="description"><?= $fetch_skills['skill_four']; ?></p>
      <p class="description"><?= $fetch_skills['skill_five']; ?></p>
      <p class="description"><?= $fetch_skills['skill_six']; ?></p>
      <p class="description"><?= $fetch_skills['skill_seven']; ?></p>
      <p class="description"><?= $fetch_skills['skill_eight']; ?></p>
      <p class="description"><?= $fetch_skills['skill_nine']; ?></p>
      <p class="description"><?= $fetch_skills['skill_ten']; ?></p>
   </div>

   <?php

        
        } 

    } else {
    echo '<p class="empty">no additional information added yet!</p>';
    header('location: skills_preference.php');
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