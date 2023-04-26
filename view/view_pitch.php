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
   header('location:../admin/elevator_pitch.php');
}

if(isset($_POST['delete_pitch'])){
   $delete_id = $_POST['pitch_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_pitch = $conn->prepare("DELETE FROM `pitch` WHERE id = ?");
   $delete_pitch->execute([$delete_id]);
   $message[] = 'Elevator pitch deleted!';
   header('location:../admin/elevator_pitch.php');

} 



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Elevator pitch details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-details">

   <h1 class="heading">Elevator pitch details</h1>

   <?php
      $select_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE id = ? AND user_id = ?");
      $select_pitch->execute([$get_id, $user_id]);
      if($select_pitch->rowCount() > 0){
         while($fetch_pitch = $select_pitch->fetch(PDO::FETCH_ASSOC)){
            $pitch_id = $fetch_pitch['id'];
   ?>
   <div class="row" id="link">

         <div class="details"><span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i style="cursor: pointer;" class="fa-regular fa-clone"></i><span id="msg"></span></span>
         <h3 class="title"><?= $fetch_pitch['title']; ?></h3>

         <p>Share your <b style="color: black;">STAR</b> stories with other people via email and ask them for their reaction or what the stories tell them about you.<span>*</span></p>
         <div class="description"><?= $fetch_pitch['step_one']; ?></div>
         <p>Word clouds<span>*</span></p>
         <div class="description"><?= $fetch_pitch['step_two_one']; ?></div>
         <div class="description"><?= $fetch_pitch['step_two_two']; ?></div>
         <p>Observations<span>*</span></p>
         <div class="description"><?= $fetch_pitch['step_three_one']; ?></div>
         <div class="description"><?= $fetch_pitch['step_three_two']; ?></div>
         <div class="description"><?= $fetch_pitch['step_three_three']; ?></div>
         <p>Streamline and Practice<span>*</span></p>        
         <div class="description"><?= $fetch_pitch['step_four']; ?></div>




         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="pitch_id" value="<?= $pitch_id; ?>">
            <a href="../update/update_pitch.php?get_id=<?= $pitch_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
		<button type="submit" class="delete-btn" onclick="return confirm('Delete this pitch?');" name="delete_pitch"><i class="fa-solid fa-trash"></i> Delete</button>

            <a href="../print/print_pitch.php?get_id=<?= $pitch_id; ?>" class="btn btn-success pull-right"><i class="fa-solid fa-print"></i> Print</a> 
         </form>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No elevator pitch found!</p>';
      }
   ?>

</section>
















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
<script src="../js/jquery.min.js"></script>


</body>
</html>