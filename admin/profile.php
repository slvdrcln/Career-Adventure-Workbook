<?php

   include '../components/connect.php';

   if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      header('location:/index.php');
   }

   $select_stories = $conn->prepare("SELECT * FROM `stories` WHERE user_id = ?");
   $select_stories->execute([$user_id]);
   $total_stories = $select_stories->rowCount();

   $select_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE user_id = ?");
   $select_pitch->execute([$user_id]);
   $total_pitch = $select_pitch->rowCount();

   $select_history = $conn->prepare("SELECT * FROM `history` WHERE user_id = ?");
   $select_history->execute([$user_id]);
   $total_history = $select_history->rowCount();

   if(isset($_POST['delete_info'])){
      $delete_id = $_POST['info_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_info = $conn->prepare("SELECT * FROM `add_info` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_info->execute([$delete_id, $user_id]);
   
      if($verify_info->rowCount() > 0){
   
      
      $delete_info = $conn->prepare("DELETE FROM `add_info` WHERE id = ?");
      $delete_info->execute([$delete_id]);
      $message[] = 'Additional infomation deleted!';
      }else{
         $message[] = 'Additional infomation already deleted!';
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="tutor-profile"> 

   <h1 class="heading">Profile details</h1>

   <div class="details">
      <div class="tutor">
         <!-- <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt=""> -->
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['email']; ?></span>
         <a href="../additional_info/add_info.php" class="inline-btn"><i class="fa-solid fa-plus"></i> add additional information</a>
         <a href="../update/update.php" class="inline-btn"><i class="fa-solid fa-pen-nib"></i> update profile</a>
      </div>
      

</section>


<section class="playlists">

   <h1 class="heading">Additional Information</h1>

   <div id="user_info" class="box-container">
      <?php
     $select_info = $conn->prepare("SELECT * FROM `add_info` WHERE user_id = ? ORDER BY date DESC");
     $select_info->execute([$user_id]);
     if($select_info->rowCount() > 0){
     while($fetch_info = $select_info->fetch(PDO::FETCH_ASSOC)){
        $info_id = $fetch_info['id'];
            
         
      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fa-solid fa-user"></i></div>
         <div hidden><?= $i++;?></div>
         </div>
         
         <br>
         <h3>Nickname</h3>
         <p class="description"><?= $fetch_info['nickname']; ?></p>
         <br>
         <h3>Home Address</h3>
         <p class="description"><?= $fetch_info['city']; ?>, <?= $fetch_info['region']; ?>, <?= $fetch_info['country']; ?></p>
         <br>
         <h3>Social Media</h3>
         <p class="description"><?= $fetch_info['fb']; ?></p>
         <p class="description"><?= $fetch_info['ig']; ?></p>
         <p class="description"><?= $fetch_info['linkedin']; ?></p>
         <br>
         <h3>Website</h3>
         <p class="description"><?= $fetch_info['site']; ?></p>


         

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="info_id" value="<?= $info_id; ?>">
            <a href="../update/update_info.php?get_id=<?= $info_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
            <button type="submit" class="delete-btn" value="<?=$info_id;?>"onclick="return confirm('delete this information?');" name="delete_info"><i class="fa-solid fa-trash"></i> delete</button>
         </form>     
 
      </div>
      <?php
         }
         } 
      else{
         echo '<p class="empty">No additional information added yet!</p>';
      }
      ?>

   </div>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>