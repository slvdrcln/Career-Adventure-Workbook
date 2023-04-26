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
   <title>Certification & Development</title>

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

   
   <div class="row">
    

      <div class="details-cred">

      
         <div class="left">
 
         <?php
            $select_cert = $conn->prepare("SELECT * FROM `professional_certificate` WHERE user_id = ? ORDER BY date DESC");
            $select_cert->execute([$user_id]);
            if($select_cert->rowCount() > 0){
            while($fetch_cert = $select_cert->fetch(PDO::FETCH_ASSOC)){
              $cert_id = $fetch_cert['id'];
            ?>
            <h3 class="print">Professional Certification</h3>
            <p><b>Certificate name</b></p>
            <div class="history"><?php echo $fetch_cert['cert_name']; ?></div>
            <p><b>Number</b></p>
            <div class="history"><?php echo $fetch_cert['cert_number']; ?></div>
            <p><b>Date</b></p>
            <div class="history"><?php echo $fetch_cert['earned_date']; ?> - <?php echo $fetch_cert['expiry_date']; ?></div>
            <p><b>What it certifies</b></p>
            <div class="history"><?php echo $fetch_cert['certifies']; ?></div>
            <p><b>Certifying body</b></p>
            <div class="history"><?php echo $fetch_cert['cert_body']; ?></div>
            <p><b>Certifying body website, email or phone</b></p>         
            <div class="history"><?php echo $fetch_cert['cert_web']; ?></div>
            <?php
               }
            }
            else{
               echo '<p class="empty">No professional certification found!</p>';
            }
            ?>

         </div>

         <div class="rightTwo">


                 <?php
            $select_dev = $conn->prepare("SELECT * FROM `professional_development` WHERE user_id = ? ORDER BY date DESC");
            $select_dev->execute([$user_id]);
            if($select_dev->rowCount() > 0){
            while($fetch_dev = $select_dev->fetch(PDO::FETCH_ASSOC)){
              $dev_id = $fetch_dev['id'];
            ?>
            <h3 class="print">Professional Development</h3>
            <p><b>Course</b></p>
            <div class="history"><?php echo $fetch_dev['course_name']; ?></div>
            <p><b>Education body website, email, or phone</b></p>
            <div class="history"><?php echo $fetch_dev['educ_web']; ?></div>
            <p><b>Completion date</b></p>
            <div class="history"><?php echo $fetch_dev['comp_date']; ?></div>

            <?php
               }
            }
            else{
               echo '<p class="empty">No professional development found!</p>';
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