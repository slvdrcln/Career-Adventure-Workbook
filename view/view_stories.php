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
   header('location:../admin/stories.php');
}

if(isset($_POST['delete'])){
   $delete_id = $_POST['stories_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $delete_stories = $conn->prepare("DELETE FROM `stories` WHERE id = ?");
   $delete_stories->execute([$delete_id]);
   $message[] = 'story deleted';
   header('location:../admin/stories.php');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Story Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <script src="https://kit.fontawesome.com/c5467de8d1.js" crossorigin="anonymous"></script>


   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <!-- <script src="//code/jquery.com/jquery-1.11.1/.min.js"></script> -->
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-details">

   <h1 class="heading">story details</h1>

   <?php
      $select_stories = $conn->prepare("SELECT * FROM `stories` WHERE id = ? AND user_id = ?");
      $select_stories->execute([$get_id, $user_id]);
      if($select_stories->rowCount() > 0){
         while($fetch_stories = $select_stories->fetch(PDO::FETCH_ASSOC)){
            $stories_id = $fetch_stories['id'];
   ?>
   <div class="row" id="link">
   
      <div class="details"><span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i style="cursor: pointer;" class="fa-regular fa-clone"></i><span id="msg"></span></span>
         <h3 class="title"><?= $fetch_stories['title']; ?></h3>
         
         <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_stories['date']; ?></span></div>
         <p>What was the Situation? Who, what, why, how, when, where, and to what degree? <span>*</span></p>
         <div class="description"><?= $fetch_stories['situation']; ?></div>
         <p>What did you Think when the challenge was first presented to you? <span>*</span></p>
         <div class="description"><?= $fetch_stories['think']; ?></div>
         <p>What Actions did you take? List the steps in order and what your role was in each step. <span>*</span></p>
         <div class="description"><?= $fetch_stories['action']; ?></div>
         <p>What ended up happening? What were the final Results? Include factual information such as numbers or quotes from stakeholders. Be clear about the before and after changes.
<span>*</span></p>         
         <div class="description"><?= $fetch_stories['result']; ?></div>
         <p>Evidence</p>
         <div class="description"><?= $fetch_stories['evidence']; ?></div>



         <form action="" method="post" class="flex-btn" >
            <input type="hidden" name="stories_id" value="<?= $stories_id; ?>">
            <a href="../update/update_stories.php?get_id=<?= $stories_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update story</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this story?');" name="delete"><i class="fa-solid fa-trash"></i> delete story</button>
            <a href="../print/print_story.php?get_id=<?= $stories_id; ?>" class="btn btn-success pull-right"><i class="fa-solid fa-print"></i> Print</a> 
         </form>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no story found!</p>';
      }
   ?>

</section>






<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
<script src="../js/jquery.min.js"></script>


</body>
</html>