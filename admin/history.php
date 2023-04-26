<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}



if(isset($_POST['delete'])){
   $delete_id = $_POST['history_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_history = $conn->prepare("SELECT * FROM `history` WHERE id = ? AND user_id = ? LIMIT 1");
   $verify_history->execute([$delete_id, $user_id]);


   if($verify_history->rowCount() > 0){
      $delete_history = $conn->prepare("DELETE FROM `history` WHERE id = ?");
      $delete_history->execute([$delete_id]);
      $message[] = 'Career history deleted!';
      }else{
         $message[] = 'Career history already deleted!';
      }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Career Adventure History</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>


<section class="playlists">

   <h1 class="heading">Career Adventure History</h1>
   <p class="description"><b>Complete the following fields for every job you have held and every volunteer position:</b></p>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Create your career history</h3>
         <a href="../history/add_history.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>

      <?php
         $select_history = $conn->prepare("SELECT * FROM `history` WHERE user_id = ? ORDER BY date DESC");
         $select_history->execute([$user_id]);
         if($select_history->rowCount() > 0){
         while($fetch_history = $select_history->fetch(PDO::FETCH_ASSOC)){
            $history_id = $fetch_history['id'];

      ?>
      <div class="box">
         <div class="flex">
	<div><i class="fa-sharp fa-solid fa-paperclip"></i></div>
         <div><i class="fas fa-calendar"></i><span><?= $fetch_history['date']; ?></span></div>

         </div>

         <br>
         <h3 class="desc">Organization name</h3>
         <p class="description"><?= $fetch_history['org_name']; ?></p>
         <h3 class="desc">Organization address</h3>
         <p class="description"><?= $fetch_history['org_add']; ?></p>
         <h3 class="desc">Job Title</h3>
         <p class="description"><?= $fetch_history['job_title']; ?></p>
         <h3 class="desc">Start date</h3>
         <p class="description"><?= $fetch_history['start_date']; ?></p>
         <h3 class="desc">Base pay</h3>
         <p class="description"><?= $fetch_history['base_pay']; ?></p>
         <h3 class="desc">Boss Job Title</h3>
         <p class="description"><?= $fetch_history['boss_job_title']; ?></p>
         <h3 class="desc">Position summary</h3>
         <p class="description"><?= $fetch_history['pos_summary']; ?></p>         
         <h3 class="desc">Position headline</h3>
         <p class="description"><?= $fetch_history['pos_headline']; ?></p>



         

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="history_id" value="<?= $history_id; ?>">
            <a href="../update/update_history.php?get_id=<?= $history_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this history?');" name="delete"><i class="fa-solid fa-trash"></i> delete</button>
         </form>
         <a href="../view/view_history.php?get_id=<?= $history_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view history</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No career history added yet!</p>';
      }
      ?>

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