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
   <title>Credentials</title>

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
			margin: 0;  /* this affects the margin in the printer settings from 0 to all 1 */
		}
</style>
</head>
<body>
      <?php include '../components/admin_header.php'; ?>
<section class="playlist-details">

      <!-- <div class="textProfile">
         <h3><?php echo $users->displayName ;?> <br /><span><?php echo $users->email ;?></span></h3>
        </div> -->
   
   <div class="row">
    

      <div class="details-cred">

      
         <div class="left">

            <?php
             $select_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE user_id = ? ORDER BY date DESC");
             $select_educ->execute([$user_id]);
             if($select_educ->rowCount() > 0){
             while($fetch_educ = $select_educ->fetch(PDO::FETCH_ASSOC)){
               $educ_id = $fetch_educ['id'];
            ?>
            <h3 class="print">Formal Education</h3>
            <p><b>Name of School</b></p>
            <div class="history"><?php echo $fetch_educ['school_name']; ?></div>
            <p><b>Location</b></p>
            <div class="history"><?php echo $fetch_educ['school_location']; ?></div>
            <p><b>Date</b></p>
            <div class="history"><?php echo $fetch_educ['start_date']; ?> - <?php echo $fetch_educ['graduation_date']; ?></div>
            <p><b>Degree/Diploma received</b></p>
            <div class="history"><?php echo $fetch_educ['degree']; ?></div>
            <p><b>Major(s)</b></p>         
            <div class="history"><?php echo $fetch_educ['major']; ?></div>
            <p><b>Minor(s)</b></p>
            <div class="history"><?php echo $fetch_educ['minor']; ?></div>
            <p><b>Overall GPA</b></p>
            <div class="history"><?php echo $fetch_educ['overall_gpa']; ?></div>
            <p><b>Major GPA</b></p>
            <div class="history"><?php echo $fetch_educ['major_gpa']; ?></div>
            <p><b>Relevant course works or project</b></p>
            <div class="history"><?php echo $fetch_educ['project']; ?></div>
            <p><b>Group affiliation</b></p>
            <div class="history"><?php echo $fetch_educ['groups']; ?></div>
            <?php
               }
            }
            else{
               echo '<p class="empty">No formal education found!</p>';
            }
            ?>
         </div>
        

         <div class="rightTwo">
         <?php
            $select_lic = $conn->prepare("SELECT * FROM `professional_license` WHERE user_id = ? ORDER BY date DESC");
            $select_lic->execute([$user_id]);
            if($select_lic->rowCount() > 0){
            while($fetch_lic = $select_lic->fetch(PDO::FETCH_ASSOC)){
              $lic_id = $fetch_lic['id'];
            ?>
            <h3 class="print">Professional License</h3>
            <p><b>License name</b></p>
            <div class="history"><?php echo $fetch_lic['license_name']; ?></div>
            <p><b>License number</b></p>
            <div class="history"><?php echo $fetch_lic['license_number']; ?></div>
            <p><b>Granting body</b></p>
            <div class="history"><?php echo $fetch_lic['granting']; ?></div>
            <p><b>Date</b></p>
            <div class="history"><?php echo $fetch_lic['earned_date']; ?> - <?php echo $fetch_lic['expiry_date']; ?></div>



            <?php
               }
            }
            else{
               echo '<p class="empty">No professional license found!</p>';
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