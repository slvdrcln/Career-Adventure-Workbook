<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

   <style>

*{
   transition: all .2s ease;
}


.extra-info {
  display: none;
  line-height: 20px;
  font-size: 14px;
  position: relative;
   transition: all .2s ease;
   padding: 2px;

}

.info:hover .extra-info {
  display: block;
  transition: all .2s ease;
  background-color: white;
  border-radius: 16px;
  background-color: #CECECE !important;
  margin: 0 auto;
  justify-content: center;
  align-items: center;
  text-align: center;

}

.info {
  font-size: 25px;
  padding-left: 10px;
  width: 30px;
  border-radius: 15px;
  color: black;
  transition: all .2s ease;
}

.info:hover {
  background-color: white;
  padding: 0 0 0 10px;
  width: 315px;
  text-align: right !important;
  transition: all .2s ease;
  color: black;

}
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlists">

   <h1 class="heading">STAR Story</h1>

   <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_stories = $conn->prepare("SELECT * FROM `stories` WHERE title LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_stories->execute([$user_id]);
         if($select_stories->rowCount() > 0){
         while($fetch_stories = $select_stories->fetch(PDO::FETCH_ASSOC)){
            $stories_id = $fetch_stories['id'];
      ?>
      <div class="box">
         <div class="flex">
         <div><i class="fas fa-book" style="<?php if($fetch_stories['status'] == 'Technical Skill' || 'Greatest Obstacle' || 'Improvement' || 'Lesson Learned' || 'Interpersonal Skill' || 'Greatest Accomplishment'){echo 'color:#4472ca'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_stories['status'] ==  'Technical Skill' || 'Greatest Obstacle' || 'Improvement' || 'Lesson Learned' || 'Interpersonal Skill' || 'Greatest Accomplishment'){echo 'color:grey'; }else{echo 'color:red';} ?>"><?= $fetch_stories['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_stories['date']; ?></span></div>
         </div>
       
         <h3 class="title"><?= $fetch_stories['title']; ?></h3>
         <p class="description"><?= $fetch_stories['situation']; ?></p>
         <p class="description"><?= $fetch_stories['think']; ?></p>
         <p class="description"><?= $fetch_stories['action']; ?></p>
         <p class="description"><?= $fetch_stories['result']; ?></p>
         <p class="description"><?= $fetch_stories['evidence']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="stories_id" value="<?= $stories_id; ?>">
         </form>
         <a href="../view/view_stories.php?get_id=<?= $stories_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No story found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for story title</span></i></span></p>';
      }
	}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>

</section>





<section class="playlists">

   <h1 class="heading">Elevator Pitch</h1>

   <div class="box-container">

   <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
      $search = $_POST['search'];
      $select_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE title LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
      $select_pitch->execute([$user_id]);
      if($select_pitch->rowCount() > 0){
         while($fetch_pitch = $select_pitch->fetch(PDO::FETCH_ASSOC)){ 
            $pitch_id = $fetch_pitch['id'];
   ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-calendar"></i><span><?= $fetch_pitch['date']; ?></span></div>
         </div>
         <h3 class="title"><?= $fetch_pitch['title']; ?></h3>
         <p class="description"><?= $fetch_pitch['step_one']; ?></p>
         <p class="description"><?= $fetch_pitch['step_two_one']; ?></p>
         <p class="description"><?= $fetch_pitch['step_two_two']; ?></p>
         <p class="description"><?= $fetch_pitch['step_three_one']; ?></p>
         <p class="description"><?= $fetch_pitch['step_three_two']; ?></p>
         <p class="description"><?= $fetch_pitch['step_three_three']; ?></p>
         <p class="description"><?= $fetch_pitch['step_four']; ?></p>

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="pitch_id" value="<?= $pitch_id; ?>">
         </form>
         <a href="../view/view_pitch.php?get_id=<?= $pitch_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
   <?php
         }
      }else{
         echo '<p class="empty">No elevator pitch found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for elevator pitch number</span></i></span></p>';
      }
   }else{
      echo '<p class="empty">Please search something!</p>';
   }
   ?>

   </div>

</section>


<section class="playlists">

   <h1 class="heading">Career History</h1>

   <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_history = $conn->prepare("SELECT * FROM `history` WHERE org_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_history->execute([$user_id]);
         if($select_history->rowCount() > 0){
         while($fetch_history = $select_history->fetch(PDO::FETCH_ASSOC)){
            $history_id = $fetch_history['id'];
      ?>
      <div class="box">
         <div class="flex">
	<div><i class="fa-sharp fa-solid fa-clock-rotate-left"></i></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_history['date']; ?></span></div>
         </div>
      
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
         </form>
         <a href="../view/view_history.php?get_id=<?= $history_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No history found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for organization name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>

</section>



<section class="playlists">

   <h1 class="heading">Credentials</h1>

   <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_formal_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE school_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_formal_educ->execute([$user_id]);
         if($select_formal_educ->rowCount() > 0){
         while($fetch_formal_educ = $select_formal_educ->fetch(PDO::FETCH_ASSOC)){
            $educ_id = $fetch_formal_educ['id'];
      ?>
      <div class="box">
         <div class="flex">
 <div><i class="fa-solid fa-graduation-cap"></i></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_formal_educ['date']; ?></span></div>
         </div>
        <h3 class="title"><?= $fetch_formal_educ['title']; ?></h3>
         <br>
         <h3 class="desc">School name</h3>
         <p class="description"><?= $fetch_formal_educ['school_name'];?></p>
         <h3 class="desc">School location</h3>
         <p class="description"><?= $fetch_formal_educ['school_location']; ?></p>
         <h3 class="desc">Start date</h3>
         <p class="description"><?= $fetch_formal_educ['start_date']; ?></p>
         <h3 class="desc">Graduation date</h3>
         <p class="description"><?= $fetch_formal_educ['graduation_date']; ?></p>
         <h3 class="desc">College Degree</h3>
         <p class="description"><?= $fetch_formal_educ['degree']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="educ_id" value="<?= $educ_id; ?>">
         </form>
         <a href="../view/view_formal_educ.php?get_id=<?= $educ_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No formal education found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for school name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>
<br><br>
 <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_lic = $conn->prepare("SELECT * FROM `professional_license` WHERE license_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_lic->execute([$user_id]);
         if($select_lic->rowCount() > 0){
         while($fetch_license = $select_lic->fetch(PDO::FETCH_ASSOC)){
            $lic_id = $fetch_license['id'];
      ?>
      <div class="box">
         <div class="flex">
<div><i class="fa-solid fa-id-card"></i></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_license['date']; ?></span></div>
         </div>
         <h3 class="title"><?= $fetch_license['title']; ?></h3>
         <br>
         <h3 class="desc">License name</h3>
         <p class="description"><?= $fetch_license['license_name'];?></p>
         
         <h3 class="desc">License number</h3>
         <p class="description"><?= $fetch_license['license_number']; ?></p>
         
         <h3 class="desc">Granting number</h3>
         <p class="description"><?= $fetch_license['granting']; ?></p>
         
         <h3 class="desc">Earned date</h3>
         <p class="description"><?= $fetch_license['earned_date']; ?></p>
         
         <h3 class="desc">Expiry date</h3>
         <p class="description"><?= $fetch_license['expiry_date']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="lic_id" value="<?= $lic_id; ?>">
         </form>
         <a href="../view/view_prof_lic.php?get_id=<?= $lic_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No professional license found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for license name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>

<br><br>
 <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_cert = $conn->prepare("SELECT * FROM `professional_certificate` WHERE cert_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_cert->execute([$user_id]);
         if($select_cert->rowCount() > 0){
         while($fetch_cert = $select_cert->fetch(PDO::FETCH_ASSOC)){
            $cert_id = $fetch_cert['id'];
      ?>
      <div class="box">
         <div class="flex">
<div><i class="fa-solid fa-certificate"></i></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_cert['date']; ?></span></div>
         </div>
        <h3 class="title"><?= $fetch_cert['title']; ?></h3>
         <br>
         <h3 class="desc">Certificate name</h3>
         <p class="description"><?= $fetch_cert['cert_name'];?></p>
         
         <h3 class="desc">Certificate number</h3>
         <p class="description"><?= $fetch_cert['cert_number']; ?></p>
         
         <h3 class="desc">Earned date</h3>
         <p class="description"><?= $fetch_cert['earned_date']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="cert_id" value="<?= $cert_id; ?>">
         </form>
         <a href="../view/view_prof_cert.php?get_id=<?= $cert_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No professional certificate found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for certificate name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>


<br><br>
 <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_professional_development = $conn->prepare("SELECT * FROM `professional_development` WHERE course_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_professional_development->execute([$user_id]);
         if($select_professional_development->rowCount() > 0){
         while($fetch_professional_development = $select_professional_development->fetch(PDO::FETCH_ASSOC)){
            $dev_id = $fetch_professional_development['id'];
      ?>
         <div class="box">
         <div class="flex">
            <div><i class="fa-solid fa-code"></i></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_professional_development['date']; ?></span></div>
         </div>
         
         <h3 class="title"><?= $fetch_professional_development['title']; ?></h3>
         <br>
         <h3 class="desc">Course name</h3>
         <p class="description"><?= $fetch_professional_development['course_name'];?></p>
         
         <h3 class="desc">Education body</h3>
         <p class="description"><?= $fetch_professional_development['educ_web']; ?></p>
         
         <h3 class="desc">Completion date</h3>
         <p class="description"><?= $fetch_professional_development['comp_date']; ?></p>

         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="dev_id" value="<?= $dev_id; ?>">
            <a href="../view/view_prof_dev.php?get_id=<?= $dev_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            
         </form>

      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No professional development found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for course name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>


<br><br>
 <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_awards = $conn->prepare("SELECT * FROM `awards_recognition` WHERE award_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_awards->execute([$user_id]);
         if($select_awards->rowCount() > 0){
         while($fetch_awards = $select_awards->fetch(PDO::FETCH_ASSOC)){
            $awards_id = $fetch_awards['id'];
      ?>
     <div class="box">
         <div class="flex">
            <div><i class="fa-solid fa-award"></i></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_awards['date']; ?></span></div>
         </div>
         
         <h3 class="title"><?= $fetch_awards['title']; ?></h3>
         <br>
         <h3 class="desc">Award name</h3>
         <p class="description"><?= $fetch_awards['award_name'];?></p>
         
         <h3 class="desc">Award date</h3>
         <p class="description"><?= $fetch_awards['award_date']; ?></p>
         
         <h3 class="desc">Granting body</h3>
         <p class="description"><?= $fetch_awards['granting']; ?></p>


         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="awards_id" value="<?= $awards_id; ?>">
            <a href="../view/view_awards.php?get_id=<?= $awards_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            
         </form>

      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No awards & recognition found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for award name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>


<br><br>
 <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_creation = $conn->prepare("SELECT * FROM `creation` WHERE creation_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_creation->execute([$user_id]);
         if($select_creation->rowCount() > 0){
         while($fetch_creation = $select_creation->fetch(PDO::FETCH_ASSOC)){
            $creation_id = $fetch_creation['id'];
      ?>
    <div class="box">
         <div class="flex">
            <div><i class="fa-solid fa-pen"></i></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_creation['date']; ?></span></div>
         </div>
         
         <h3 class="title"><?= $fetch_creation['title']; ?></h3>
         <br>
         <h3 class="desc">Creation name</h3>
         <p class="description"><?= $fetch_creation['creation_name'];?></p>
         
         <h3 class="desc">URL</h3>
         <p class="description"><?= $fetch_creation['url'];?></p>
         
         <h3 class="desc">Published date</h3>
         <p class="description"><?= $fetch_creation['published_date']; ?></p>
         
         <h3 class="desc">published website</h3>
         <p class="description"><?= $fetch_creation['publish_site']; ?></p>


         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="creation_id" value="<?= $creation_id; ?>">
            <a href="../view/view_creation.php?get_id=<?= $creation_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
         </form>

      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No creation & innovation found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for creation name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>

<br><br>
 <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_invention = $conn->prepare("SELECT * FROM `invention` WHERE invention_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_invention->execute([$user_id]);
         if($select_invention->rowCount() > 0){
         while($fetch_invention = $select_invention->fetch(PDO::FETCH_ASSOC)){
            $invention_id = $fetch_invention['id'];
      ?>
     <div class="box">
         <div class="flex">
    <div><i class="fa-solid fa-lightbulb"></i></div>
	<div><i class="fas fa-calendar"></i><span><?= $fetch_creation['date']; ?></span></div>
        

         </div>
         
         <h3 class="title"><?= $fetch_invention['title']; ?></h3>
         <br>
         <h3 class="desc">Name of invention</h3>
         <p class="description"><?= $fetch_invention['invention_name'];?></p>
         
         <h3 class="desc">Number</h3>
         <p class="description"><?= $fetch_invention['num'];?></p>
         
         <h3 class="desc">Country</h3>
         <p class="description"><?= $fetch_invention['country']; ?></p>
         
         <h3 class="desc">Date issued</h3>
         <p class="description"><?= $fetch_invention['date_issued']; ?></p>

         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="invention_id" value="<?= $invention_id; ?>">
            <a href="../view/view_invention.php?get_id=<?= $invention_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            
         </form>

      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No invention found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for invention name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>


<br><br>
 <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE portfolio_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_portfolio->execute([$user_id]);
         if($select_portfolio->rowCount() > 0){
         while($fetch_portfolio = $select_portfolio->fetch(PDO::FETCH_ASSOC)){
            $portfolio_id = $fetch_portfolio['id'];
      ?>
      <div class="box">
         <div class="flex">
	
            <div><i class="fa-regular fa-user"></i></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_portfolio['date']; ?></span></div>
         </div>
         
         <h3 class="title"><?= $fetch_portfolio['title']; ?></h3>
         <br>
         <p class="description"><?= $fetch_portfolio['portfolio_name'];?></p>
         <p class="description"><?= $fetch_portfolio['url'];?></p>

         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="portfolio_id" value="<?= $portfolio_id; ?>">
            <a href="../view/view_portfolio.php?get_id=<?= $portfolio_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this porfolio?');" name="delete_portfolio"><i class="fa-solid fa-trash"></i> Delete</button>
         </form>

      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No portfolio found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for portfolio name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>
</section>

<section class="playlists">

   <h1 class="heading">Skills & Preferences</h1>

   <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_skills = $conn->prepare("SELECT * FROM `skills` WHERE title LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
         $select_skills->execute([$user_id]);
         if($select_skills->rowCount() > 0){
         while($fetch_skills = $select_skills->fetch(PDO::FETCH_ASSOC)){
            $skills_id = $fetch_skills['id'];
      ?>
            <div class="box">
         <div class="flex">
         <div hidden><?= $i++;?></div>

         </div>
         
         <h3 class="title"><?= $fetch_skills['title']; ?></h3>
         <br>
         <h3 class="desc">Spoken Languages</h3>
         <p class="description"><?= $fetch_skills['language_one'];?></p>
         <p class="description"><?= $fetch_skills['language_two'];?></p>
         <p class="description"><?= $fetch_skills['language_three'];?></p>
         <br>
         <h3 class="desc">Skills</h3>
         <p class="description"><?= $fetch_skills['skill_one'];?></p>
         <p class="description"><?= $fetch_skills['skill_two'];?></p>
         <p class="description"><?= $fetch_skills['skill_three'];?></p>
         <p class="description"><?= $fetch_skills['skill_four'];?></p>
         <p class="description"><?= $fetch_skills['skill_five'];?></p>


         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="skills_id" value="<?= $skills_id; ?>">
            <a href="../view/view_skills.php?get_id=<?= $skills_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
            
         </form>

      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No skills found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for title</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>

<br><br>
  <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_pref = $conn->prepare("SELECT * FROM `preference` WHERE title LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
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
         <h3 class="desc">Preferred Place</h3>
         <p class="description"><?= $fetch_pref['pref_place'];?></p>
         <h3 class="desc">Preferred Days</h3>
         <p class="description"><?= $fetch_pref['days'];?></p>
         <h3 class="desc">Preferred working hours</h3>
         <p class="description"><?= $fetch_pref['hours'];?></p>
         <br>


         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="pref_id" value="<?= $pref_id; ?>">
         <a href="../view/view_preferences.php?get_id=<?= $pref_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
         </form>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No preferences found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for title</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>


<br><br>
  <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_mustHave = $conn->prepare("SELECT * FROM `must_have` WHERE title LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
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
            <a href="../view/view_mustHave.php?get_id=<?= $mustHave_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view</a>
         </form>

      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No must haves found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for title</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
      }
      ?>

   </div>
</section>

<section class="playlists">

   <h1 class="heading">Target Company</h1>

   <div class="box-container">
   
      <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
         $search = $_POST['search'];
         $select_target = $conn->prepare("SELECT * FROM `target_company` WHERE company_name LIKE '%{$search}%' AND user_id = ? ORDER BY date DESC");
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
         <h3 class="desc">Favorite Company</h3>
         <p class="description"><?= $fetch_target['company_name']; ?></p>
         <h3 class="desc">Resume sent</h3>
         <p class="description"><?= $fetch_target['resume']; ?></p>
         <h3 class="desc">Cover Letter sent</h3>
         <p class="description"><?= $fetch_target['cover']; ?></p>
         <h3 class="desc">Position</h3>
         <p class="description"><?= $fetch_target['position']; ?></p>
         <h3 class="desc">Company location</h3>
         <p class="description"><?= $fetch_target['location']; ?></p>
         <h3 class="desc">Company industry</h3>
         <p class="description"><?= $fetch_target['industry']; ?></p>

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="target_id" value="<?= $target_id; ?>">
            <a href="../update/update_target.php?get_id=<?= $target_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> update</a>
            <button type="submit" class="delete-btn" value="<?= $target_id; ?>" onclick="return confirm('delete this target company?');" name="delete"><i class="fa-solid fa-trash"></i> delete</button>
         </form>
         <a href="../view/view_target.php?get_id=<?= $target_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> view target</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No target company found! <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        please search for company name</span></i></span></p>';
      }}else{
         echo '<p class="empty">Please search something!</p>';
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