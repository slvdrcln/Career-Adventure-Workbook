<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:playlist.php');
}

if(isset($_POST['submit'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $step_one = $_POST['step_one'];
   $step_one = filter_var($step_one, FILTER_SANITIZE_STRING);

   $step_two_one = $_POST['step_two_one'];
   $step_two_one = filter_var($step_two_one, FILTER_SANITIZE_STRING); 
   $step_two_two = $_POST['step_two_two'];
   $step_two_two = filter_var($step_two_two, FILTER_SANITIZE_STRING);

   $step_three_one = $_POST['step_three_one'];
   $step_three_one = filter_var($step_three_one, FILTER_SANITIZE_STRING);
   $step_three_two = $_POST['step_three_two'];
   $step_three_two = filter_var($step_three_two, FILTER_SANITIZE_STRING);   
   $step_three_three = $_POST['step_three_three'];
   $step_three_three = filter_var($step_three_three, FILTER_SANITIZE_STRING);

   $step_four = $_POST['step_four'];
   $step_four = filter_var($step_four, FILTER_SANITIZE_STRING);


   $update_pitch = $conn->prepare("UPDATE `pitch` SET title = ?, step_one = ?, step_two_one = ?, step_two_two = ?, step_three_one = ?, step_three_two = ?, step_three_three = ?, step_four = ? WHERE id = ?");
   $update_pitch->execute([$title, $step_one, $step_two_one, $step_two_two, $step_three_one, $step_three_two, $step_three_three, $step_four, $get_id]);

   $message[] = 'Elevator pitch updated!';  

}

if(isset($_POST['delete'])){
   $delete_id = $_POST['pitch_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $delete_pitch = $conn->prepare("DELETE FROM `pitch` WHERE id = ?");
   $delete_pitch->execute([$delete_id]);
   header('location:../admin/elevator_pitch.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update pitch</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">update pitch</h1>

   <?php
         $select_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE id = ?");
         $select_pitch->execute([$get_id]);
         if($select_pitch->rowCount() > 0){
         while($fetch_pitch = $select_pitch->fetch(PDO::FETCH_ASSOC)){
            $pitch_id = $fetch_pitch['id'];
      ?>
   <form action="" method="post" enctype="multipart/form-data">
   <p>Title <span>*</span></p>
      <select name="title" class="box" required>
         <option value="<?= $fetch_pitch['title']; ?>" selected><?= $fetch_pitch['title']; ?></option>
         <option value="Elevator Pitch #1">Elevator Pitch #1</option>
         <option value="Elevator Pitch #2">Elevator Pitch #2</option>
         <option value="Elevator Pitch #3">Elevator Pitch #3</option>
         <option value="Elevator Pitch #4">Elevator Pitch #4</option>
         <option value="Elevator Pitch #5">Elevator Pitch #5</option>
      </select>
   <p>Share your <b style="color: black;">STAR</b> stories with other people via email and ask them for their reaction or what the stories tell them about you.<span>*</span></p>
      <textarea name="step_one" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_pitch['step_one']; ?></textarea>
      <p>Word clouds <span>*</span></p>
      <input type="text" name="step_two_one" class="box" required placeholder="write description" value="<?= $fetch_pitch['step_two_one']; ?>"></input>
      <input type="text" name="step_two_two" class="box" required placeholder="write description" value="<?= $fetch_pitch['step_two_two']; ?>"></input>
      
      <p>Observations<span>*</span></p>
      <textarea name="step_three_one" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_pitch['step_three_one']; ?></textarea>
      <textarea name="step_three_two" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_pitch['step_three_two']; ?></textarea>
      <textarea name="step_three_three" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_pitch['step_three_three']; ?></textarea>

      <p>Streamline and Practice<span>*</span></p>
      <textarea name="step_four" class="box" required maxlength="1000" cols="30" rows="10"><?= $fetch_pitch['step_four']; ?></textarea>
      <input type="submit" value="update pitch" name="submit" class="btn">
      <div class="flex-btn">
         <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Delete this pitch?');" name="delete">
      </div>
   </form>
   <?php
      } 
   }else{
      echo '<p class="empty">no elevator pitch added yet!</p>';
   }
   ?>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>