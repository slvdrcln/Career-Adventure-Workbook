<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}


   $count_formal_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE user_id = ?");
   $count_formal_educ->execute([$user_id]);
   $total_education = $count_formal_educ->rowCount();

   $select_professional_license = $conn->prepare("SELECT * FROM `professional_license` WHERE user_id = ?");
   $select_professional_license->execute([$user_id]);
   $total_prof_lic = $select_professional_license->rowCount();

   $select_professional_certificate = $conn->prepare("SELECT * FROM `professional_certificate` WHERE user_id = ?");
   $select_professional_certificate->execute([$user_id]);
   $total_prof_cert = $select_professional_certificate->rowCount();

   $select_professional_development = $conn->prepare("SELECT * FROM `professional_development` WHERE user_id = ?");
   $select_professional_development->execute([$user_id]);
   $total_prof_dev = $select_professional_development->rowCount();

   $select_awards = $conn->prepare("SELECT * FROM `awards_recognition` WHERE user_id = ?");
   $select_awards->execute([$user_id]);
   $total_awards = $select_awards->rowCount();

   $select_invention = $conn->prepare("SELECT * FROM `invention` WHERE user_id = ?");
   $select_invention->execute([$user_id]);
   $total_invention = $select_invention->rowCount();

   $select_creation = $conn->prepare("SELECT * FROM `creation` WHERE user_id = ?");
   $select_creation->execute([$user_id]);
   $total_creation = $select_creation->rowCount();

   $select_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE user_id = ?");
   $select_portfolio->execute([$user_id]);
   $total_portfolio = $select_portfolio->rowCount();

   if(isset($_POST['delete_educ'])){
      $delete_id = $_POST['educ_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_educ->execute([$delete_id, $user_id]);
   
      if($verify_educ->rowCount() > 0){
   
      
      $delete_educ = $conn->prepare("DELETE FROM `formal_educ` WHERE id = ?");
      $delete_educ->execute([$delete_id]);
      $message[] = 'Formal education deleted!';
      }else{
         $message[] = 'Formal education already deleted!';
      }
   }

   if(isset($_POST['delete_prof_lic'])){
      $delete_id = $_POST['lic_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_lic = $conn->prepare("SELECT * FROM `professional_license` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_lic->execute([$delete_id, $user_id]);
   
      if($verify_lic->rowCount() > 0){
   
      
      $delete_lic = $conn->prepare("DELETE FROM `professional_license` WHERE id = ?");
      $delete_lic->execute([$delete_id]);
      $message[] = 'Professional license deleted!';
      }else{
         $message[] = 'Professional license already deleted!';
      }
   }

   if(isset($_POST['delete_prof_cert'])){
      $delete_id = $_POST['cert_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_cert = $conn->prepare("SELECT * FROM `professional_certificate` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_cert->execute([$delete_id, $user_id]);
   
      if($verify_cert->rowCount() > 0){
   
      $delete_cert = $conn->prepare("DELETE FROM `professional_certificate` WHERE id = ?");
      $delete_cert->execute([$delete_id]);
      $message[] = 'Professional certificate deleted!';
      }else{
         $message[] = 'Professional certificate already deleted!';
      }
   }

   
   if(isset($_POST['delete_prof_dev'])){
      $delete_id = $_POST['dev_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_dev = $conn->prepare("SELECT * FROM `professional_development` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_dev->execute([$delete_id, $user_id]);
   
      if($verify_dev->rowCount() > 0){
   
      $delete_dev = $conn->prepare("DELETE FROM `professional_development` WHERE id = ?");
      $delete_dev->execute([$delete_id]);
      $message[] = 'Professional development deleted!';
      }else{
         $message[] = 'Professional development already deleted!';
      }
   }


   
   if(isset($_POST['delete_awards'])){
      $delete_id = $_POST['awards_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_awards = $conn->prepare("SELECT * FROM `awards_recognition` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_awards->execute([$delete_id, $user_id]);
   
      if($verify_awards->rowCount() > 0){
   
      $delete_awards = $conn->prepare("DELETE FROM `awards_recognition` WHERE id = ?");
      $delete_awards->execute([$delete_id]);
      $message[] = 'Awards & recognition deleted!';
      }else{
         $message[] = 'Awards & recognition already deleted!';
      }
   }


   if(isset($_POST['delete_creation'])){
      $delete_id = $_POST['creation_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_creation = $conn->prepare("SELECT * FROM `creation` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_creation->execute([$delete_id, $user_id]);
   
      if($verify_creation->rowCount() > 0){
   
      $delete_creation = $conn->prepare("DELETE FROM `creation` WHERE id = ?");
      $delete_creation->execute([$delete_id]);
      $message[] = 'Creation & innovation deleted!';
      }else{
         $message[] = 'Creation & innovation already deleted!';
      }
   }

   if(isset($_POST['delete_invention'])){
      $delete_id = $_POST['invention_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_invention = $conn->prepare("SELECT * FROM `invention` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_invention->execute([$delete_id, $user_id]);
   
      if($verify_invention->rowCount() > 0){
   
      $delete_invention = $conn->prepare("DELETE FROM `invention` WHERE id = ?");
      $delete_invention->execute([$delete_id]);
      $message[] = 'Invention deleted!';
      }else{
         $message[] = 'Invention already deleted!';
      }
   }

   if(isset($_POST['delete_portfolio'])){
      $delete_id = $_POST['portfolio_id'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE id = ? AND user_id = ? LIMIT 1");
      $verify_portfolio->execute([$delete_id, $user_id]);
   
      if($verify_portfolio->rowCount() > 0){
   
      $delete_portfolio = $conn->prepare("DELETE FROM `portfolio` WHERE id = ?");
      $delete_portfolio->execute([$delete_id]);
      $message[] = 'Portfolio deleted!';
      }else{
         $message[] = 'Portfolio already deleted!';
      }
   }
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Credentials</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <script src="https://kit.fontawesome.com/c5467de8d1.js" crossorigin="anonymous"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">Add your credentials</h1>

   <div class="box-container">

      <div class="box">
         <h3><?= $total_education; ?></h3>
         <p>Formal Education</p>
         <a href="../credentials/add_formal_educ.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#formal_educ" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>

      <div class="box">
         <h3>
         <?= $total_prof_lic; ?>
         </h3>
         <p>Professional License</p>
         <a href="../credentials/add_prof_lic.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#prof_lic" class="btn"><i class="fa-solid fa-eye"></i> View</a>

      </div>

      <div class="box">
         <h3>
         <?= $total_prof_cert; ?>
         </h3>
         <p>Professional Certification</p>
         <a href="../credentials/add_prof_cert.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#prof_cert" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>

      <div class="box">
         <h3>
         <?= $total_prof_dev; ?>
         </h3>
         <p>Professional Development</p>
         <a href="../credentials/add_prof_dev.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#prof_dev" class="btn"><i class="fa-solid fa-eye"></i> View</a>

      </div>

      <div class="box">
         <h3>
         <?= $total_awards; ?>
         </h3>
         <p>Awards & Recognition</p>
         <a href="../credentials/add_recognition.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#recognition" class="btn"><i class="fa-solid fa-eye"></i> View</a>

      </div>

      <div class="box">
         <h3>
         <?= $total_creation; ?>
         </h3>
         <p>Creations & Innovations</p>
         <a href="../credentials/add_creation.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#creation" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>

      <div class="box">
         <h3>
         <?= $total_invention; ?>
         </h3>
         <p>Inventions</p>
         <a href="../credentials/add_invention.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#invention" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>

      <div class="box">
         <h3>
         <?= $total_portfolio; ?>
         </h3>
         <p>Portfolio</p>
         <a href="../credentials/add_portfolio.php" class="btn"><i class="fa-solid fa-plus"></i> Add</a>
         <a href="#portfolio" class="btn"><i class="fa-solid fa-eye"></i> View</a>
      </div>
      
   </div>

</section>





<section id="formal_educ" class="playlists">

   <h1 class="heading" >Formal Education</h1>

   <div class="box-container">
      <?php
       $select_formal_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE user_id = ? ORDER BY date DESC");
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
            <a href="../view/view_educ.php?get_id=<?= $educ_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>

            <button type="submit" class="delete-btn" onclick="return confirm('delete this formal education?');" name="delete_educ"><i class="fa-solid fa-trash"></i> Delete</button>
         
         </form>

      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No formal education added yet!</p>';
      }
      ?>

   </div>

</section>

<section id="prof_lic" class="playlists">

   <h1 class="heading">Professional License</h1>

   <div class="box-container">
   

      <?php
       $select_professional_license = $conn->prepare("SELECT * FROM `professional_license` WHERE user_id = ? ORDER BY date DESC");
       $select_professional_license->execute([$user_id]);
       if($select_professional_license->rowCount() > 0){
       while($fetch_professional_license = $select_professional_license->fetch(PDO::FETCH_ASSOC)){
          $lic_id = $fetch_professional_license['id'];
      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fa-solid fa-id-card"></i></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_professional_license['date']; ?></span></div>
         </div>
         
         <h3 class="title"><?= $fetch_professional_license['title']; ?></h3>
         <br>
         <h3 class="desc">License name</h3>
         <p class="description"><?= $fetch_professional_license['license_name'];?></p>
         
         <h3 class="desc">License number</h3>
         <p class="description"><?= $fetch_professional_license['license_number']; ?></p>
         
         <h3 class="desc">Granting number</h3>
         <p class="description"><?= $fetch_professional_license['granting']; ?></p>
         
         <h3 class="desc">Earned date</h3>
         <p class="description"><?= $fetch_professional_license['earned_date']; ?></p>
         
         <h3 class="desc">Expiry date</h3>
         <p class="description"><?= $fetch_professional_license['expiry_date']; ?></p>

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="lic_id" value="<?= $lic_id; ?>">
            <a href="../view/view_prof_lic.php?get_id=<?= $lic_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this professional license?');" name="delete_prof_lic"><i class="fa-solid fa-trash"></i> Delete</button>
         </form>
      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No professional license added yet!</p>';
      }
      ?>

   </div>

</section>

<section id="prof_cert" class="playlists">

   <h1 class="heading">Professional Certification</h1>
   <div class="box-container">
   
    
      <?php
   $select_professional_certificate = $conn->prepare("SELECT * FROM `professional_certificate` WHERE user_id = ? ORDER BY date DESC");
   $select_professional_certificate->execute([$user_id]);
   if($select_professional_certificate->rowCount() > 0){
   while($fetch_professional_certificate = $select_professional_certificate->fetch(PDO::FETCH_ASSOC)){
      $cert_id = $fetch_professional_certificate['id'];
      ?>
      <div class="box">
         <div class="flex">
         <div><i class="fa-solid fa-certificate"></i></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_professional_certificate['date']; ?></span></div>

         </div>
         
         <h3 class="title"><?= $fetch_professional_certificate['title']; ?></h3>
         <br>
         <h3 class="desc">Certificate name</h3>
         <p class="description"><?= $fetch_professional_certificate['cert_name'];?></p>
         
         <h3 class="desc">Certificate number</h3>
         <p class="description"><?= $fetch_professional_certificate['cert_number']; ?></p>
         
         <h3 class="desc">Earned date</h3>
         <p class="description"><?= $fetch_professional_certificate['earned_date']; ?></p>


         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="cert_id" value="<?= $cert_id; ?>">
            <a href="../view/view_prof_cert.php?get_id=<?= $cert_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this professional certificate?');" name="delete_prof_cert"><i class="fa-solid fa-trash"></i> Delete</button>
         </form>

      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No professional certification added yet!</p>';
      }
      ?>

   </div>

</section>

<section id="prof_dev" class="playlists">

   <h1 class="heading">Professional Development</h1>

   <div class="box-container">

      <?php
    $select_professional_development = $conn->prepare("SELECT * FROM `professional_development` WHERE user_id = ? ORDER BY date DESC");
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
         <p class="description"><?= $fetch_professional_development['educ_body']; ?></p>

         <h3 class="desc">Education body website, email or phone</h3>
         <p class="description"><?= $fetch_professional_development['educ_web']; ?></p>
         
         <h3 class="desc">Completion date</h3>
         <p class="description"><?= $fetch_professional_development['comp_date']; ?></p>

         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="dev_id" value="<?= $dev_id; ?>">
            <a href="../view/view_prof_dev.php?get_id=<?= $dev_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this professional development?');" name="delete_prof_dev"><i class="fa-solid fa-trash"></i> Delete</button>
         </form>

      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No professional development added yet!</p>';
      }
      ?>

   </div>

</section>



<section id="recognition" class="playlists">

   <h1 class="heading">Awards & Recognition</h1>

   <div class="box-container">
   

      <?php
      $select_awards = $conn->prepare("SELECT * FROM `awards_recognition` WHERE user_id = ? ORDER BY date DESC");
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
         <p class="description"><?= $fetch_awards['granting_body']; ?></p>
         <h3 class="desc">Granting body website, email or phone</h3>
         <p class="description"><?= $fetch_awards['granting']; ?></p>


         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="awards_id" value="<?= $awards_id; ?>">
            <a href="../view/view_awards.php?get_id=<?= $awards_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this awards & recognition?');" name="delete_awards"><i class="fa-solid fa-trash"></i> Delete</button>
         </form>

      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No awards & recognition added yet!</p>';
      }
      ?>

   </div>

</section>

<section id="creation" class="playlists">

   <h1 class="heading">Creations & Innovations</h1>

   <div class="box-container">
   

      <?php
     $select_creation = $conn->prepare("SELECT * FROM `creation` WHERE user_id = ? ORDER BY date DESC");
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
         
         <h3 class="desc">Published website</h3>
         <p class="description"><?= $fetch_creation['publish_site']; ?></p>


         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="creation_id" value="<?= $creation_id; ?>">
            <a href="../view/view_creation.php?get_id=<?= $creation_id; ?>" class="btn"><i class="fa-solid fa-eye"></i> View</a>
            <button type="submit" class="delete-btn" onclick="return confirm('delete this creation & innovation?');" name="delete_creation"><i class="fa-solid fa-trash"></i> Delete</button>
         </form>

      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No creations & innovations added yet!</p>';
      }
      ?>

   </div>

</section>

<section id="invention" class="playlists">

   <h1 class="heading">Inventions</h1>

   <div class="box-container">
   

      <?php
         $select_invention = $conn->prepare("SELECT * FROM `invention` WHERE user_id = ? ORDER BY date DESC");
         $select_invention->execute([$user_id]);
         if($select_invention->rowCount() > 0){
         while($fetch_invention = $select_invention->fetch(PDO::FETCH_ASSOC)){
            $invention_id = $fetch_invention['id'];
      ?>
      <div class="box">
         <div class="flex">

            <div><i class="fa-solid fa-lightbulb"></i></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_invention['date']; ?></span></div>
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
            <button type="submit" class="delete-btn" onclick="return confirm('delete this invention?');" name="delete_invention"><i class="fa-solid fa-trash"></i> Delete</button>
         </form>

      </div>
      <?php
         }
         } else{
         echo '<p class="empty">No inventions added yet!</p>';
      }
      ?>

   </div>

</section>

<section id="portfolio" class="playlists">

   <h1 class="heading">Portfolio</h1>

   <div class="box-container">
   

      <?php
       $select_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE user_id = ? ORDER BY date DESC");
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
         } else{
         echo '<p class="empty">No portfolios added yet!</p>';
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