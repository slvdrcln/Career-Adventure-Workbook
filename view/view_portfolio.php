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
   <title>Portfolio</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Portfolio</h1>

   <?php
    $select_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE id = ? AND user_id = ?");
    $select_portfolio->execute([$get_id, $user_id]);
    if($select_portfolio->rowCount() > 0){
       while($fetch_portfolio = $select_portfolio->fetch(PDO::FETCH_ASSOC)){
          $portfolio_id = $fetch_portfolio['id'];
        
        ?>

   <div class="view" id="link">
   <span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
      <div class="name">Portfolio name</div>
      <p class="description"><?= $fetch_portfolio['portfolio_name']; ?></p>
      <div class="name">URL</div>
      <p class="description"><?= $fetch_portfolio['url']; ?></p>

      
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