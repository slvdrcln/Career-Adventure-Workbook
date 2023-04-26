<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}



   if(isset($_POST['delete_skill'])){
      $delete_id = $_POST['skill_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_skills = $conn->prepare("SELECT * FROM `skills` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_skills->execute([$delete_id, $user_id]);
   
      if($verify_skills->rowCount() > 0){
   
      
      $delete_skills = $conn->prepare("DELETE FROM `skills` WHERE id = ?");
      $delete_skills->execute([$delete_id]);
      $message[] = 'Skills deleted!';
      }else{
         $message[] = 'Skills already deleted!';
      }
   }

   if(isset($_POST['delete_pref'])){
      $delete_id = $_POST['pref_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_pref = $conn->prepare("SELECT * FROM `preference` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_pref->execute([$delete_id, $user_id]);
   
      if($verify_pref->rowCount() > 0){
   
      
      $delete_pref = $conn->prepare("DELETE FROM `preference` WHERE id = ?");
      $delete_pref->execute([$delete_id]);
      $message[] = 'Preference deleted!';
      }else{
         $message[] = 'Preference already deleted!';
      }
   }

   if(isset($_POST['delete_mustHave'])){
      $delete_id = $_POST['mustHave_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_mustHave = $conn->prepare("SELECT * FROM `must_have` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_mustHave->execute([$delete_id, $user_id]);
   
      if($verify_mustHave->rowCount() > 0){
   
      $delete_mustHave = $conn->prepare("DELETE FROM `must_have` WHERE id = ?");
      $delete_mustHave->execute([$delete_id]);
      $message[] = 'Must have deleted!';
      }else{
         $message[] = 'Must have already deleted!';
      }
   }

   






?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Skills and Preferences</title>

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

<h1 class="heading">Add skills & preferences</h1>
   <!-- <p class="description"><b>Your fourth step</b></p> -->

   <div class="box-container">
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Skills</h3>
         <a href="../skills_pref/add_skills.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>

         <a href="#skills" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>

<!-- <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Spoken language</h3>
	<a href="../skills_pref/add_lang.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#skills" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div> -->

      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Preferred working hours & days</h3>
         <a href="../skills_pref/add_pref.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#days" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Must haves</h3>
         <a href="../skills_pref/add_mustHave.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#must_have" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>

   </div>

</section>





<section id="skills" class="playlists">

   <h1 class="heading">Skills</h1>
   <p class="description"><b></b></p>

   <div class="box-container">
   

   <?php
      $select_skills = $conn->prepare("SELECT * FROM `skills` WHERE user_id = ? ORDER BY date DESC");
      $select_skills->execute([$user_id]);
      if($select_skills->rowCount() > 0){
      while($fetch_skills = $select_skills->fetch(PDO::FETCH_ASSOC)){
         $skill_id = $fetch_skills['id'];
      ?>
      <div class="box">
         <div class="flex">
         <div hidden><?= $i++;?></div>

         </div>
         
         <h3 class="title"><?= $fetch_skills['title']; ?></h3>
         <br>
         <h3 class="desc">Spoken languages</h3>
	
         <p class="description"><?= $fetch_skills['language_one'];?>, <?= $fetch_skills['prof_lang_one'];?></p>
         <p class="description"><?= $fetch_skills['language_two'];?>, <?= $fetch_skills['prof_lang_two'];?></p>
         <p class="description"><?= $fetch_skills['language_three'];?>, <?= $fetch_skills['prof_lang_three'];?></p>
         <br>
         <h3 class="desc">Skills</h3>
         <p class="description"><?= $fetch_skills['skill_one'];?></p>
         <p class="description"><?= $fetch_skills['skill_two'];?></p>
         <p class="description"><?= $fetch_skills['skill_three'];?></p>
         <p class="description"><?= $fetch_skills['skill_four'];?></p>
         <p class="description"><?= $fetch_skills['skill_five'];?></p>


         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="skill_id" value="<?= $skill_id; ?>">
            <a href="../update/update_skills.php?get_id=<?= $skill_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
            <button type="submit" class="delete-btn" value="<?= $skill_id; ?>"onclick="return confirm('delete this skill?');" name="delete_skill"><i class="fa-solid fa-trash"></i> delete</button>
         </form>
<a href="../view/view_skills.php?get_id=<?= $skill_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No skills added yet!</p>';
      }
      ?>

   </div>

</section>




<section id="days" class="playlists">

   <h1 class="heading">Preferences</h1>
   <p class="description"><b></b></p>

   <div class="box-container">
   
     
      
   <?php
      $select_pref = $conn->prepare("SELECT * FROM `preference` WHERE user_id = ? ORDER BY date DESC");
      $select_pref->execute([$user_id]);
      if($select_pref->rowCount() > 0){
      while($fetch_pref = $select_pref->fetch(PDO::FETCH_ASSOC)){
         $pref_id = $fetch_pref['id'];
      ?>
      <div class="box">
         <div class="flex">
         <div hidden><?= $i++;?></div>

         </div>
         <br>
         
         <h3 class="title"><?= $fetch_pref['title']; ?></h3>
         <br>
         <h3 class="desc">Preferred places</h3>
         <p class="description"><?= $fetch_pref['pref_place_one'];?></p>
<p class="description"><?= $fetch_pref['pref_place_two'];?></p>
<p class="description"><?= $fetch_pref['pref_place_three'];?></p>
<p class="description"><?= $fetch_pref['pref_place_four'];?></p>
<p class="description"><?= $fetch_pref['pref_place_five'];?></p>
         <h3 class="desc">Preferred days</h3>
         <p class="description"><?= $fetch_pref['days'];?></p>
         <h3 class="desc">Preferred working hours</h3>
         <p class="description"><?= $fetch_pref['hours'];?></p>
         <br>


         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="pref_id" value="<?= $pref_id; ?>">
<a href="../update/update_pref.php?get_id=<?= $pref_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
         
            <button type="submit" class="delete-btn" value="<?=$pref_id;?>"onclick="return confirm('delete this preference?');" name="delete_pref"><i class="fa-solid fa-trash"></i> delete</button>
         </form>
<a href="../view/view_preferences.php?get_id=<?= $pref_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No preferences added yet!</p>';
      }
      ?>

   </div>

</section>

<section id="must_have" class="playlists">

   <h1 class="heading">Must haves</h1>
   <p class="description"><b></b></p>

   <div class="box-container">
   
     
     
   <?php
      $select_mustHave = $conn->prepare("SELECT * FROM `must_have` WHERE user_id = ? ORDER BY date DESC");
      $select_mustHave->execute([$user_id]);
      if($select_mustHave->rowCount() > 0){
      while($fetch_mustHave = $select_mustHave->fetch(PDO::FETCH_ASSOC)){
         $mustHave_id = $fetch_mustHave['id'];
      ?>
      <div class="box">
         <div class="flex">
         <div hidden><?= $i++;?></div>

         </div>
         
         <h3 class="title">Must haves</h3>
         <br>
         <h3 class="desc">Benefits</h3>
         <p class="description"><?= $fetch_mustHave['benefits'];?></p>
         <h3 class="desc">Salary + Bonus</h3>
         <p class="description"><?= $fetch_mustHave['salary'];?></p>
         <h3 class="desc">Culture & Work Environment</h3>
         <p class="description"><?= $fetch_mustHave['work_env'];?></p>

         
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="mustHave_id" value="<?= $mustHave_id; ?>">
<a href="../update/update_mustHave.php?get_id=<?= $mustHave_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
<button type="submit" class="delete-btn" value="<?= $mustHave_id; ?>"onclick="return confirm('Delete this must have?');" name="delete_mustHave"><i class="fa-solid fa-trash"></i> delete</button>

</form>
            <a href="../view/view_mustHave.php?get_id=<?= $mustHave_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No must haves added yet!</p>';
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