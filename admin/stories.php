<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['delete'])){
   $delete_id = $_POST['stories_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_stories = $conn->prepare("SELECT * FROM `stories` WHERE id = ? AND user_id = ? LIMIT 1");
   $verify_stories->execute([$delete_id, $user_id]);

   if($verify_stories->rowCount() > 0){

   
   $delete_stories = $conn->prepare("DELETE FROM `stories` WHERE id = ?");
   $delete_stories->execute([$delete_id]);
   $message[] = 'Story deleted!';
   }else{
      $message[] = 'Story already deleted!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Stories</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <script src="https://kit.fontawesome.com/c5467de8d1.js" crossorigin="anonymous"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>



<section class="playlists">

   <h1 class="heading">Start with your stories!</h1>
   <p class="description"><b>You should create as many STAR stories as possible, but you must create at least five (5).</b></p>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Add an Accomplishment</h3>
         <a href="../stories/add_accomplishment.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>

      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Add a Technical Skill</h3>
         <a href="../stories/add_tech_skill.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>

      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Add an Interpersonal Skill</h3>
         <a href="../stories/add_int_skill.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Add a Lesson Learned</h3>
         <a href="../stories/add_lesson_learned.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>  <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Add an Improvement</h3>
         <a href="../stories/add_improvement.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>  
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Add an Obstacle</h3>
         <a href="../stories/add_obstacle.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Add your own STAR Story</h3>
         <a href="../stories/add_own.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
      </div>
      <?php
         $select_stories = $conn->prepare("SELECT * FROM `stories` WHERE user_id = ? ORDER BY date DESC");
         $select_stories->execute([$user_id]);
         if($select_stories->rowCount() > 0){
         while($fetch_stories = $select_stories->fetch(PDO::FETCH_ASSOC)){
            $stories_id = $fetch_stories['id'];
      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-book" style="<?php if($fetch_stories['status'] == 'Technical Skill' || 'Greatest Obstacle' || 'Improvement' || 'Lesson Learned' || 'Interpersonal Skill' || 'Accomplishment'){echo 'color:#4472ca'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_stories['status'] ==  'Technical Skill' || 'Greatest Obstacle' || 'Improvement' || 'Lesson Learned' || 'Interpersonal Skill' || 'Accomplishment'){echo 'color:#grey'; }else{echo 'color:red';} ?>"><?= $fetch_stories['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_stories['date']; ?></span></div>
         </div>
         <h3 class="title"><?= $fetch_stories['title']; ?></h3>
         <h3 class="desc">Situation</h3>
         <p class="description"><?= $fetch_stories['situation']; ?></p>
         <h3 class="desc">Thinking</h3>
         <p class="description"><?= $fetch_stories['think']; ?></p>
         <h3 class="desc">Action</h3>
         <p class="description"><?= $fetch_stories['action']; ?></p>
         <h3 class="desc">Result</h3>
         <p class="description"><?= $fetch_stories['result']; ?></p>
   

         

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="stories_id" value="<?= $stories_id; ?>">
            <a href="../update/update_stories.php?get_id=<?= $stories_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
            <!-- <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this story?');" name="delete"> -->
            <button type="submit" class="delete-btn" onclick="return confirm('Delete this story?');" name="delete"><i class="fa-solid fa-trash"></i> delete</button>
         </form>
         <a href="../view/view_stories.php?get_id=<?= $stories_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view story</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No STAR stories added yet!</p>';
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