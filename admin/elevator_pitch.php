<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}



if(isset($_POST['delete'])){
   $delete_id = $_POST['pitch_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE id = ? AND user_id = ? LIMIT 1");
   $verify_pitch->execute([$delete_id, $user_id]);


   if($verify_pitch->rowCount() > 0){
      $delete_pitch = $conn->prepare("DELETE FROM `pitch` WHERE id = ?");
      $delete_pitch->execute([$delete_id]);
      $message[] = 'Elevator pitch deleted!';
      }else{
         $message[] = 'Elevator pitch already deleted!';
      }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Career Adventure Summary</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlists">

   <h1 class="heading">Career Adventure Summary</h1>
   <p class="description"><b>Create your elevator pitch by identifying the themes in your STAR stories.</b></p>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Create your elevator pitch</h3>
         <a href="../pitch/add_pitch.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>

      <?php
         $select_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE user_id = ? ORDER BY date DESC");
         $select_pitch->execute([$user_id]);
         if($select_pitch->rowCount() > 0){
         while($fetch_pitch = $select_pitch->fetch(PDO::FETCH_ASSOC)){
            $pitch_id = $fetch_pitch['id'];

      ?>
      <div class="box">
         <div class="flex">
	<div><i class="fa-solid fa-comments"></i></div>
         <div><i class="fas fa-calendar"></i><span><?= $fetch_pitch['date']; ?></span></div>

         </div>
         <h3 class="title"><?= $fetch_pitch['title']; ?></h3>

 
         <br>
         <p class="description"><?= $fetch_pitch['step_four']; ?></p>
         

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="pitch_id" value="<?= $pitch_id; ?>">
            <a href="../update/update_pitch.php?get_id=<?= $pitch_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this pitch?');" name="delete"><i class="fa-solid fa-trash"></i> delete</button>
         </form>
         <a href="../view/view_pitch.php?get_id=<?= $pitch_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view pitch</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No elevator pitch added yet!</p>';
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