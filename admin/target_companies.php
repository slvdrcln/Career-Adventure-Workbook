<?php
include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');

}

if(isset($_POST['delete'])){
   $delete_id = $_POST['target_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_targets = $conn->prepare("SELECT * FROM `target_company` WHERE id = ? AND user_id = ? LIMIT 1");
   $verify_targets->execute([$delete_id, $user_id]);

   if($verify_targets->rowCount() > 0){

   
   $delete_target = $conn->prepare("DELETE FROM `target_company` WHERE id = ?");
   $delete_target->execute([$delete_id]);
   $message[] = 'Target company deleted!';
   }else{
      $message[] = 'Target company already deleted!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Target Companies</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>



<section class="playlists">

   <h1 class="heading">Target Companies</h1>
   <p class="description"><b>You should save your job applications!</b></p>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Create your target company</h3>
         <a href="../target_company/add_target.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>

      <?php
      $select_target = $conn->prepare("SELECT * FROM `target_company` WHERE user_id = ? ORDER BY date DESC");
      $select_target->execute([$user_id]);
      if($select_target->rowCount() > 0){
      while($fetch_target = $select_target->fetch(PDO::FETCH_ASSOC)){
         $target_id = $fetch_target['id'];
      ?>
      <div class="box">
         <div class="flex">
         <div><i class="fa-solid fa-bullseye"></i></div>

         </div>

         <br>
         <h3 class="desc">Target company</h3>
         <p class="description"><?= $fetch_target['company_name']; ?></p>
         <h3 class="desc">Resume sent</h3>
         <p class="description"><?= $fetch_target['resume']; ?></p>
         <h3 class="desc">Cover letter sent</h3>
         <p class="description"><?= $fetch_target['cover']; ?></p>
         <h3 class="desc">Position</h3>
         <p class="description"><?= $fetch_target['position']; ?></p>
         <h3 class="desc">Company location</h3>
         <p class="description"><?= $fetch_target['location']; ?></p>


         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="target_id" value="<?= $target_id; ?>">
            <a href="../update/update_target.php?get_id=<?= $target_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
            <button type="submit" class="delete-btn" value="<?= $target_id; ?>" onclick="return confirm('Delete this target company?');" name="delete"><i class="fa-solid fa-trash"></i> delete</button>
         </form>
         <a href="../view/view_target.php?get_id=<?= $target_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view target</a>
      </div>
         <?php
         } 
         }else{
            echo '<p class="empty">No target company added yet!</p>';
         }
         ?>
      </div>
   </div>

</section>












<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>