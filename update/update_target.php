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
   header('location:stories.php');
}

if(isset($_POST['submit'])){

   $company_name = $_POST['company_name'];
   $company_name = filter_var($company_name, FILTER_SANITIZE_STRING);
   $resume = $_POST['resume'];
   $resume = filter_var($resume, FILTER_SANITIZE_STRING);
   $cover = $_POST['cover'];
   $cover = filter_var($cover, FILTER_SANITIZE_STRING);
   $position = $_POST['position'];
   $position = filter_var($position, FILTER_SANITIZE_STRING);
   $location = $_POST['location'];
   $location = filter_var($location, FILTER_SANITIZE_STRING);


   $update_stories = $conn->prepare("UPDATE `target_company` SET company_name = ?, resume = ?, cover = ?, position = ?, location = ?, WHERE id = ?");
   $update_stories->execute([$company_name, $resume, $cover, $position, $location, $get_id]);

   $message[] = 'Target company updated!';  

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Target Company</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Update target company</h1>

   <?php
   $select_target = $conn->prepare("SELECT * FROM `target_company` WHERE id = ?");
   $select_target->execute([$get_id]);
   if($select_target->rowCount() > 0){
   while($fetch_target = $select_target->fetch(PDO::FETCH_ASSOC)){
      $target_id = $fetch_target['id'];
        
        ?>
            
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="key" value="<?=$key_child; ?>">
      <p>Company name:<span>*<span></p>      
      <input type="text" name="company_name" maxlength="100"  value="<?= $fetch_target['company_name']; ?>" class="box" required>
      <p>Resume that you sent:<span>*<span></p>
      <input type="text" name="resume" maxlength="100"  value="<?= $fetch_target['resume']; ?>" class="box" required>
      <p>Cover letter that you sent:</p>
      <input type="text" name="cover" maxlength="100"  value="<?= $fetch_target['cover']; ?>" class="box">
      <p>Position you applied for:</p>
      <input type="text" name="position" maxlength="100"  value="<?= $fetch_target['position']; ?>" class="box">
      <p>Location for this position:</p>
      <input type="text" name="location" maxlength="100"  value="<?= $fetch_target['location']; ?>" class="box">


      <input type="submit" value="Update" name="submit" class="btn">
      
      <div class="flex-btn">
      <input type="hidden" name="target_id" value="<?= $target_id; ?>">

 

      </div>
   </form>

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

</body>
</html>