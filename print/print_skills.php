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
   <title>Skills & Preferences</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

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
			margin: 1;  /* this affects the margin in the printer settings from 0 to all 1 */
		}
</style>
</head>
<body>
      <?php include '../components/admin_header.php'; ?>
<section class="playlist-details">

   
   <div class="row">
    

      <div class="details-cred">

      
         <div class="left">
 



         <?php
           $select_pref = $conn->prepare("SELECT * FROM `preference` WHERE user_id = ? ORDER BY date DESC");
           $select_pref->execute([$user_id]);
           if($select_pref->rowCount() > 0){
           while($fetch_pref = $select_pref->fetch(PDO::FETCH_ASSOC)){
             $pref_id = $fetch_pref['id'];
                    
         ?>
            <h3 class="print">Preferences</h3>
            <p><b>Preferred place to live</b></p>
            <div class="history"><?php echo $fetch_pref['pref_place']; ?></div>
            <p><b>Preferred working days</b></p>
            <div class="history"><?php echo $fetch_pref['days']; ?></div>
            <p><b>Preferred working hours</b></p>
            <div class="history"><?php echo $fetch_pref['hours']; ?></div>

         <?php
               }
            }
            else{
               echo '<p class="empty">No preferences found!</p>';
            }
         ?>
         

         <?php
             $select_mustHave = $conn->prepare("SELECT * FROM `must_have` WHERE user_id = ? ORDER BY date DESC");
             $select_mustHave->execute([$user_id]);
             if($select_mustHave->rowCount() > 0){
             while($fetch_mustHave = $select_mustHave->fetch(PDO::FETCH_ASSOC)){
               $mustHave_id = $fetch_mustHave['id'];
         ?>
            <h3 class="print">Must haves</h3>
            <p><b>Minimum Acceptable Total Compensation</b></p>
            <div class="history"><?php echo $fetch_mustHave['salary']; ?></div>
            <p><b>Benefits</b></p>
            <div class="history"><?php echo $fetch_mustHave['benefits']; ?></div>
            <p><b>Culture and Work Environment</b></p>
            <div class="history"><?php echo $fetch_mustHave['work_env']; ?></div>

         <?php
               }
            }
            else{
               echo '<p class="empty">No must haves found!</p>';
            }
         ?>

         
         

         </div>

         <div class="rightTwo">

         <?php
             $select_skills = $conn->prepare("SELECT * FROM `skills` WHERE user_id = ? ORDER BY date DESC");
             $select_skills->execute([$user_id]);
             if($select_skills->rowCount() > 0){
             while($fetch_skills = $select_skills->fetch(PDO::FETCH_ASSOC)){
               $skills_id = $fetch_skills['id'];
            ?>
            <h3 class="print">Skills</h3>
            <p><b>Spoken Languages</b></p>
            <div class="history"><?php echo $fetch_skills['language_one']; ?></div>
            <div class="history"><?php echo $fetch_skills['language_two']; ?></div>
            <div class="history"><?php echo $fetch_skills['language_three']; ?></div>
            <p><b>Skills</b></p>
            <div class="history"><?php echo $fetch_skills['skill_one']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_two']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_three']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_four']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_five']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_six']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_seven']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_eight']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_nine']; ?></div>
            <div class="history"><?php echo $fetch_skills['skill_ten']; ?></div>


            
         

            <?php
               }
            }
            else{
               echo '<p class="empty">No skills & preference found!</p>';
            }
            ?>

         
         </div>


      </div>
   </div>

</section>




<script src="script.js"></script>
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