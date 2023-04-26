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
   <title>Print Documents</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <script src="https://kit.fontawesome.com/c5467de8d1.js" crossorigin="anonymous"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">



</head>
<body>

<?php include '../components/admin_header.php'; ?>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      
   }
}

?>


<section class="playlists">
   <h1 class="heading">Print your documents</h1>
   <p class="description">You can print your resume and documents that help you prepare for an interview</p>

   <div class="box-container">

      <div class="box" style="text-align: center;"><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
      This includes the following: <br>Full name, Contact information, Formal education, Spoken languages, Career history, Professional licenses, Professional certifications, and your Portfolio</span></i></span>
         <h3 class="title" style="margin-bottom: .5rem;">Print Standard Resume</h3>
         <a href="print_resume.php" class="btn"><i class="fa-solid fa-print"></i> Print</a>
      </div>

      <div class="box" style="text-align: center;"><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
      This includes the following: <br>Accomplishments, Technical skills, Interpersonal skills, Lesson learned, Improvements, and Obstacles STAR stories</span></i></span>
         <h3 class="title" style="margin-bottom: .5rem;">Print STAR Stories</h3>
         <a href="print_star.php" class="btn"><i class="fa-solid fa-print"></i> Print</a>
      </div>

      <div class="box" style="text-align: center;"><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
      This includes the following: <br>Elevator pitches that you have added.</span></i></span>
         <h3 class="title" style="margin-bottom: .5rem;">Print Elevator Pitches</h3>
         <a href="print_pitches.php" class="btn"><i class="fa-solid fa-print"></i> Print</a>
      </div>

      <div class="box" style="text-align: center;"><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
      This includes the following: <br>histories that you have added.</span></i></span>
         <h3 class="title" style="margin-bottom: .5rem;">Print Career Histories</h3>
         <a href="print_histories.php" class="btn"><i class="fa-solid fa-print"></i> Print</a>
      </div>

    

      <div class="box" style="text-align: center;"><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
      This includes the following: <br>all of the preferences that you have added.</span></i></span>
         <h3 class="title" style="margin-bottom: .5rem;">Print Skills & Preferences</h3>
         <a href="print_skills.php" class="btn"><i class="fa-solid fa-print"></i> Print</a>
      </div>

      <div class="box" style="text-align: center;"><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
      This includes the following: <br>all of the credentials that you have added.</span></i></span>
         <h3 class="title" style="margin-bottom: .5rem;">Print Credentials</h3>
         <div class="flex-btn">
         <a href="print_educ_lic.php" class="btn"><i class="fa-solid fa-print"></i> Formal Education &<br>License</a>
         <a href="print_cert_dev.php" class="btn"><i class="fa-solid fa-print"></i> Certificate & <br>Development</a>
         </div>

         <div class="flex-btn">
         <a href="print_creation.php" class="btn"><i class="fa-solid fa-print"></i> Creation & Innovation</a>
         <a href="print_recognition.php" class="btn"><i class="fa-solid fa-print"></i> Awards & Recognition</a>

         </div>
         <a href="print_port_inv.php" class="btn"><i class="fa-solid fa-print"></i> Invention & Portfolio</a>

         

      </div>

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