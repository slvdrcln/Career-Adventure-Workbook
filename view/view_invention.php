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

   <?php
    $select_invention = $conn->prepare("SELECT * FROM `invention` WHERE id = ? AND user_id = ?");
    $select_invention->execute([$get_id, $user_id]);
    if($select_invention->rowCount() > 0){
       while($fetch_invention = $select_invention->fetch(PDO::FETCH_ASSOC)){
          $invention_id = $fetch_invention['id'];
        
        ?>

   <div class="view" id="link">
   <span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
      <div class="name">Invention name</div>
      <p class="description"><?= $fetch_invention['invention_name']; ?></p>
      <div class="name">Link to patent</div>
      <p class="description"><?= $fetch_invention['patent']; ?></p>
      <div class="name">Number</div>
      <p class="description"><?= $fetch_invention['num']; ?></p>
      <div class="name">Country</div>
      <p class="description"><?= $fetch_invention['country']; ?></p>
      <div class="name">Date issued</div>
      <p class="description"><?= $fetch_invention['date_issued']; ?></p>
      <div class="name">Co-inventor(s) name</div>
      <p class="description"><?= $fetch_invention['co_name']; ?></p>
<div class="name">Co-inventor(s) email</div>
      <p class="description"><?= $fetch_invention['co_email']; ?></p>
<div class="name">Co-inventor(s) phone</div>
      <p class="description"><?= $fetch_invention['co_phone']; ?></p>
      
   </div>

   <?php

        
        }

    } else {
    echo '<p class="empty">no professional license added yet!</p>';
    header('location: credentials.php');
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