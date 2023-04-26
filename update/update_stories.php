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

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $result = $_POST['result'];
   $result = filter_var($result, FILTER_SANITIZE_STRING);

   $situation = $_POST['situation'];
   $situation = filter_var($situation, FILTER_SANITIZE_STRING);

   $think = $_POST['think'];
   $think = filter_var($think, FILTER_SANITIZE_STRING);   

   $action = $_POST['action'];
   $action = filter_var($action, FILTER_SANITIZE_STRING);

   $evidence = $_POST['evidence'];
   $evidence = filter_var($evidence, FILTER_SANITIZE_STRING);

   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $update_stories = $conn->prepare("UPDATE `stories` SET title = ?, situation = ?, think = ?, action = ?, result = ?, evidence = ?, status = ? WHERE id = ?");
   $update_stories->execute([$title, $situation, $think, $action, $result, $evidence, $status, $get_id]);

   $message[] = 'Story updated!';  

}

if(isset($_POST['delete'])){
   $delete_id = $_POST['stories_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $fetch_thumb = $delete_stories_thumb->fetch(PDO::FETCH_ASSOC);
   
   $delete_stories = $conn->prepare("DELETE FROM `stories` WHERE id = ?");
   $delete_stories->execute([$delete_id]);
   header('location:stories.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">update stories</h1>

   <?php
         $select_stories = $conn->prepare("SELECT * FROM `stories` WHERE id = ?");
         $select_stories->execute([$get_id]);
         if($select_stories->rowCount() > 0){
         while($fetch_stories = $select_stories->fetch(PDO::FETCH_ASSOC)){
            $stories_id = $fetch_stories['id'];
      ?>
   <form action="" method="post" enctype="multipart/form-data">
      <p>Story Title <span>*</span></p>
       <input name="title" class="box" type="text" value="<?= $fetch_stories['title']; ?>" readonly>

	<input type="text" name="status" value="<?= $fetch_stories['status']; ?>" hidden>

      <p>What was the Situation? Who, what, why, how, when, where, and to what degree? <span>*</span></p>
      <textarea name="situation" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_stories['situation']; ?></textarea>
      <p>What did you Think when the challenge was first presented to you? <span>*</span></p>
      <textarea name="think" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_stories['think']; ?></textarea>
      <p>What Actions did you take? List the steps in order and what your role was in each step. <span>*</span></p>
      <textarea name="action" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_stories['action']; ?></textarea>
      <p>What ended up happening? What were the final Results? Include factual information such as numbers or quotes from stakeholders. Be clear about the before and after changes.
<span>*</span></p>
      <textarea name="result" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_stories['result']; ?></textarea>
      <p>Evidence <span>*</span></p>
      <input type="text" name="evidence" maxlength="100" placeholder="URL" value="<?= $fetch_stories['evidence']; ?>" class="box">
      
      <div class="flex-btn">
      <input type="hidden" name="stories_id" value="<?= $stories_id; ?>">

         <input type="submit" value="update story" name="submit" class="btn">
      </div>
   </form>
   <?php
      } 
   }else{
      echo '<p class="empty">no stories added yet!</p>';
   }
   ?>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>