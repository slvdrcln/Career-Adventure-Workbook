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
   <title>Awards & Recognition</title>

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
             $select_awards = $conn->prepare("SELECT * FROM `awards_recognition` WHERE user_id = ? ORDER BY date DESC");
             $select_awards->execute([$user_id]);
             if($select_awards->rowCount() > 0){
             while($fetch_awards = $select_awards->fetch(PDO::FETCH_ASSOC)){
               $awards_id = $fetch_awards['id'];
            ?>
            <h3 class="cert">Awards & Recognition</h3>
            <p><b>Award name</b></p>
            <div class="history"><?php echo $fetch_awards['award_name']; ?></div>
            <p><b>Date of award</b></p>
            <div class="history"><?php echo $fetch_awards['award_date']; ?></div>
            <p><b>Granting body</b></p>
            <div class="history"><?php echo $fetch_awards['granting']; ?></div>
            <p><b>What did you do to earn this award?</b></p>
            <div class="history"><?php echo $fetch_awards['q_one']; ?></div>
            <p><b>What does it signify?</b></p>
            <div class="history"><?php echo $fetch_awards['q_two']; ?></div>
            <p><b>Why do they offer it?</b></p>         
            <div class="history"><?php echo $fetch_awards['q_three']; ?></div>
            <?php
               }
            }
            else{
               echo '<p class="empty">No awards & recognition found!</p>';
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