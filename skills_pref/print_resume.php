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
    <title>Standard Resume</title>

       <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <script src="https://kit.fontawesome.com/c5467de8d1.js" crossorigin="anonymous"></script>


   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

   <style>
    	@media print{
			#print {
				display:none;
			}
		}
		@media print {
			#PrintButton {
				display: none;
			}
		}
 
		@page {
			size: auto;   /* auto is the initial value */
			margin: 0;  /* this affects the margin in the printer settings from 0 to all 1 */
		}
</style>
</head>
<body>
   <?php include '../components/admin_header.php'; ?>

<div class="cont">
      <div class="top">
        <div class="imgBx">
          <!-- <div class="box">
            <img src="img.jpg" alt="" />
          </div> -->
        </div>
        <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
        <div class="profileText">
          <h3><?= $fetch_profile['name'] ;?> <br /><span><?= $fetch_profile['email'];?></span></h3>
        </div>
      </div>
      <div class="contentBox">
        <div class="leftSide">
          <h3>Contact Information</h3>
          <ul>
            <li>
              <span class="icon"
                ><i class="fa-solid fa-phone"></i></span>
              <span class="text"><?php echo $fetch_profile['phone'] ;?></span>
            </li>
            <li>
              <span class="icon"
                ><i class="fa-solid fa-envelope"></i></span>
              <span class="text"><?php echo $fetch_profile['email'] ;?></span>
            </li>

            <?php 
            }
            ?>



            <?php
          $select_info = $conn->prepare("SELECT * FROM `add_info` WHERE user_id = ? ORDER BY date DESC");
          $select_info->execute([$user_id]);
          if($select_info->rowCount() > 0){
          while($fetch_info = $select_info->fetch(PDO::FETCH_ASSOC)){
            $info_id = $fetch_info['id'];
         
      ?>
            <!-- <li>
              <span class="icon"
                ><i class="fa-solid fa-globe"></i></span>
              <span class="text"><?php echo $fetch_info['site']; ?></span>
            </li> -->
            <li>
              <span class="icon"
                ><i class="fa-solid fa-location-dot"></i></span>
              <span class="text"><?php echo $fetch_info['city']; ?>, <?php echo $fetch_info['region']; ?>, <?php echo $fetch_info['country']; ?></span>
            </li>
            <?php
         }
          }
      else{
         echo '<p class="empty">No additional information found!</p>';
      }
      ?>
          </ul>
          <h3>Education</h3>
          <ul class="education">
          <?php
     $select_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE user_id = ? ORDER BY date DESC");
     $select_educ->execute([$user_id]);
     if($select_educ->rowCount() > 0){
     while($fetch_educ = $select_educ->fetch(PDO::FETCH_ASSOC)){
       $educ_id = $fetch_educ['id'];
    
      ?>
            <li>
              <h5><?php echo $fetch_educ['start_date'];?> - <?php echo $fetch_educ['graduation_date'];?></h5>
              <h4><?php echo $fetch_educ['degree'];?></h4>
              <h6><?php echo $fetch_educ['school_name'];?></h6>
            </li>


            <?php
     }
         } else{
         echo '<p class="empty">No formal education found!</p>';
      }
      ?>
          </ul>
          <h3>Language</h3>
          <?php
        $select_skills = $conn->prepare("SELECT * FROM `skills` WHERE user_id = ? ORDER BY date DESC");
        $select_skills->execute([$user_id]);
        if($select_skills->rowCount() > 0){
        while($fetch_skills = $select_skills->fetch(PDO::FETCH_ASSOC)){
          $skills_id = $fetch_skills['id'];


          ?>
          <ul class="language">
            <li>
              <span class="text"><?php echo $fetch_skills['language_one']; ?></span>
              <span class="percent">
	<div style="<?php if($fetch_skills['prof_lang_one'] ==  '25%'){echo 'width: 25%'; }else{echo 'color:red';} ?>"></div>
		<div><?php echo $fetch_skills['prof_lang_one']; ?></div>
		<div style="width: <?php echo $fetch_skills['prof_lang_one']; ?>%;"></div>
              </span>
            </li>
            <li>
              <span class="text"><?php echo $fetch_skills['language_two']; ?></span>
               <span class="percent">
                <div style="width: 95%"></div>
              </span>
            </li>
            <li>
              <span class="text"><?php echo $fetch_skills['language_three']; ?></span>
              <!-- <span class="percent">
                <div style="width: 60%"></div>
              </span> -->
            </li>
            <!-- <li>
              <span class="text"><?php echo $fetch_skills['others']; ?></span>
              <span class="percent">
                <div style="width: 60%"></div>
              </span>
            </li> -->
            <?php
        }
         } else{
         echo '<p class="empty">No skills found!</p>';
      }
      ?>
          </ul>
          <!-- <h3>Interest</h3>
          <ul class="interest">
            <li>
              <span class="icon"
                ><i class="fa-solid fa-language"></i></span
              >Coding
            </li>
            <li>
              <span class="icon"><ion-icon name="mic-outline"></ion-icon></span
              >Singing
            </li>

            <li>
              <span class="icon"><ion-icon name="book-outline"></ion-icon></span
              >Reading
            </li>
            <li>
              <span class="icon"><ion-icon name="play-outline"></ion-icon></span
              >Watching
            </li>
          </ul> -->

          <h3>Professional Licenses</h3>
          <ul class="education">
          <?php
      $select_lic = $conn->prepare("SELECT * FROM `professional_license` WHERE user_id = ? ORDER BY date DESC");
      $select_lic->execute([$user_id]);
      if($select_lic->rowCount() > 0){
      while($fetch_lic = $select_lic->fetch(PDO::FETCH_ASSOC)){
        $lic_id = $fetch_lic['id'];
      ?>
            <li>
              <h5><?php echo $fetch_lic['earned_date'];?> - <?php echo $fetch_lic['expiry_date'];?></h5>
              <h4><?php echo $fetch_lic['license_number'];?></h4>
              <h6><?php echo $fetch_lic['license_name'];?></h6>
            </li>


            <?php
         }
         } else{
         echo '<p class="empty">No professional license found!</p>';
      }
      ?>
          </ul>

          <!-- <h3>Professional Development</h3>
          <ul class="education">
          <?php
           $select_dev = $conn->prepare("SELECT * FROM `professional_development` WHERE user_id = ? ORDER BY date DESC");
           $select_dev->execute([$user_id]);
           if($select_dev->rowCount() > 0){
           while($fetch_dev = $select_dev->fetch(PDO::FETCH_ASSOC)){
             $dev_id = $fetch_dev['id'];
      ?>
            <li>
              <h5><?php echo $fetch_dev['comp_date'];?></h5>
              <h4><?php echo $fetch_dev['educ_web'];?></h4>
              <h6><?php echo $fetch_dev['course_name'];?></h6>
            </li>


            <?php
         }
         } else{
         echo '<p class="empty">No professional development found!</p>';
      }
      ?>
          </ul> -->
        </div>
        <div class="rightSide">
          <!-- <div class="about">
            <h3>Profile</h3>
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed
              tenetur sunt commodi possimus quisquam dolores molestiae aliquam
              laborum sit quaerat, atque repellendus, enim facere, facilis quas
              eum perferendis nihil saepe. <br /><br />Lorem ipsum dolor sit
              amet consectetur adipisicing elit. Consequuntur nostrum quia autem
              recusandae ut itaque deserunt dignissimos sint! Quibusdam velit
              rem molestias! Odit consequuntur dolores veniam perferendis modi
              aut illum?
            </p>
          </div> -->
          <div class="about">
          <h3>Experience</h3>

          <?php
           $select_history = $conn->prepare("SELECT * FROM `history` WHERE user_id = ? ORDER BY date DESC");
           $select_history->execute([$user_id]);
           if($select_history->rowCount() > 0){
           while($fetch_history = $select_history->fetch(PDO::FETCH_ASSOC)){
             $history_id = $fetch_history['id'];
      ?>
            <div class="box">
              <div class="year_company">
                <h5><?php echo $fetch_history['start_date']; ?> - <?php echo $fetch_history['end_date']; ?></h5>
                <h5><?php echo $fetch_history['org_name']; ?></h5>
              </div>
              <div class="text">
                <h4><?php echo $fetch_history['job_title']; ?></h4>
                <p>
                  <?php echo $fetch_history['main_task']; ?>
                </p>
              </div>
            </div>
            

            <?php
         }
         } else{
         echo '<p class="empty">No career history added!</p>';
      }
      ?>
          </div>

          
          <!-- <div class="about skills">
            <h3>Professional Skills</h3>
            <div class="box">
              <h4>JavaScript</h4>
              <span class="percent">
                <div style="width: 70%"></div>
              </span>
            </div>
            <div class="box">
              <h4>HTML</h4>
              <span class="percent">
                <div style="width: 90%"></div>
              </span>
            </div>
            <div class="box">
              <h4>CSS</h4>
              <span class="percent">
                <div style="width: 85%"></div>
              </span>
            </div>
            <div class="box">
              <h4>PHP</h4>
              <span class="percent">
                <div style="width: 80%"></div>
              </span>
            </div>
          </div> -->


          <h3>Certification</h3>
          <ul class="education">
          <?php
        $select_cert = $conn->prepare("SELECT * FROM `professional_certificate` WHERE user_id = ? ORDER BY date DESC");
        $select_cert->execute([$user_id]);
        if($select_cert->rowCount() > 0){
        while($fetch_cert = $select_cert->fetch(PDO::FETCH_ASSOC)){
          $cert_id = $fetch_cert['id'];
      ?>
            <li>
              <h5><?php echo $fetch_cert['earned_date'];?> - <?php echo $fetch_cert['expiry_date'];?></h5>
              <h4><?php echo $fetch_cert['cert_number'];?></h4>
              <h6><?php echo $fetch_cert['cert_name'];?></h6>
            </li>


            <?php
         }
         } else{
         echo '<p class="empty">No professional certification found</p>';
      }
      ?>
          </ul>

          <h3>Portfolio</h3>
          <ul class="education">
          <?php
            $select_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE user_id = ? ORDER BY date DESC");
            $select_portfolio->execute([$user_id]);
            if($select_portfolio->rowCount() > 0){
            while($fetch_portfolio = $select_portfolio->fetch(PDO::FETCH_ASSOC)){
              $portfolio_id = $fetch_portfolio['id'];
      ?>
            <li>
              <h5><?php echo $fetch_portfolio['portfolio_name'];?></h5>
              <h4><?php echo $fetch_portfolio['url'];?></h4>
            </li>


            <?php
         }
         } else{
         echo '<p class="empty">No portfolio found!</p>';
      }
      ?>
          </ul>


        </div>

        
      </div><!--CLOSING TAG OF CONTENT BOX-->
    </div>





    

<script src="../js/admin_script.js"></script>

<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
    window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
	});
</script>
</body>
</html>