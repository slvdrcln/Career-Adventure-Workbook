<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:../index.php');
   $message[] = 'Please Login to access this page';
}

$select_story = $conn->prepare("SELECT * FROM `stories` WHERE user_id = ?");
$select_story->execute([$user_id]);
$total_story = $select_story->rowCount();

$select_history = $conn->prepare("SELECT * FROM `history` WHERE user_id = ?");
$select_history->execute([$user_id]);
$total_history = $select_history->rowCount();

$select_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE user_id = ?");
$select_pitch->execute([$user_id]);
$total_pitch = $select_pitch->rowCount();


$select_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE user_id = ?");
$select_educ->execute([$user_id]);
$total_educ = $select_educ->rowCount();


$select_lic = $conn->prepare("SELECT * FROM `professional_license` WHERE user_id = ?");
$select_lic->execute([$user_id]);
$total_lic = $select_lic->rowCount();

$select_dev = $conn->prepare("SELECT * FROM `professional_development` WHERE user_id = ?");
$select_dev->execute([$user_id]);
$total_dev = $select_dev->rowCount();

$select_cert = $conn->prepare("SELECT * FROM `professional_certificate` WHERE user_id = ?");
$select_cert->execute([$user_id]);
$total_cert = $select_cert->rowCount();

$select_awards = $conn->prepare("SELECT * FROM `awards_recognition` WHERE user_id = ?");
$select_awards->execute([$user_id]);
$total_awards = $select_awards->rowCount();

$select_creation = $conn->prepare("SELECT * FROM `creation` WHERE user_id = ?");
$select_creation->execute([$user_id]);
$total_creation = $select_creation->rowCount();

$select_invention = $conn->prepare("SELECT * FROM `invention` WHERE user_id = ?");
$select_invention->execute([$user_id]);
$total_invention = $select_invention->rowCount();

$select_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE user_id = ?");
$select_portfolio->execute([$user_id]);
$total_portfolio = $select_portfolio->rowCount();

$select_skills = $conn->prepare("SELECT * FROM `skills` WHERE user_id = ?");
$select_skills->execute([$user_id]);
$total_skills = $select_skills->rowCount();

$select_preference = $conn->prepare("SELECT * FROM `preference` WHERE user_id = ?");
$select_preference->execute([$user_id]);
$total_preference = $select_preference->rowCount();

$select_mustHave = $conn->prepare("SELECT * FROM `must_have` WHERE user_id = ?");
$select_mustHave->execute([$user_id]);
$total_mustHave = $select_mustHave->rowCount();

$select_target = $conn->prepare("SELECT * FROM `target_company` WHERE user_id = ?");
$select_target->execute([$user_id]);
$total_target = $select_target->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="dashboard">

   <h1 class="heading">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="profile.php" class="btn"><i class="fa-solid fa-eye"></i> view profile</a>
      </div>

      <div class="box">
         <h3><?= $total_story; ?></h3>
         <p>Total STAR Stories</p>
         <a href="stories.php" class="btn">Add new STAR story</a>
      </div>

      <div class="box">
         <h3><?= $total_pitch; ?></h3>
         <p>Total Elevator Pitches</p>
         <a href="elevator_pitch.php" class="btn">Add new pitch</a>
      </div>

      <div class="box">
         <h3><?= $total_history; ?></h3>
         <p>Total Histories</p>
         <a href="history.php" class="btn">Add new history</a>
      </div>

      <div class="box">
         <h3><?php echo $total_educ + $total_lic + $total_dev + $total_cert + $total_awards + $total_creation + $total_invention + $total_portfolio; ?></h3>
         <p>Total Credentials</p>
         <a href="credentials.php" class="btn">Add new credential</a>
      </div>

      <div class="box">
         <h3><?= $total_skills + $total_preference + $total_mustHave; ?></h3>
         <p>Total Skills & Preferences</p>
         <a href="skills_preference.php" class="btn">Add new skills</a>
      </div>

      <div class="box">
         <h3><?= $total_target; ?></h3>
         <p>Total Target Companies</p>
         <a href="target_companies.php" class="btn">Add new target company</a>
      </div>

      <div class="box">
         <p>Print Documents</p>
         <a href="../print/print_docs.php" class="btn">Go to documents</a>
      </div>
      <div class="box">
         <p>Messages</p>
         <a href="message.php" class="btn">Go to messages</a>
      </div>


   </div>

</section>













<!-- footer section link  -->

<?php include '../components/footer.php'; ?>

<!-- custom js  -->
<script src="../js/admin_script.js"></script>

</body>
</html>