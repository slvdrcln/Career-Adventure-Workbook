<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Career History Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

   <!-- <script src="//code/jquery.com/jquery-1.11.1/.min.js"></script> -->
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
<body style="justify-content: center; align-items: center;">
      <?php include '../components/admin_header.php'; ?>
<section class="playlist-details">

   
   <?php
      $select_history = $conn->prepare("SELECT * FROM `history` WHERE id = ? AND user_id = ?");
      $select_history->execute([$get_id, $user_id]);
      if($select_history->rowCount() > 0){
         while($fetch_history = $select_history->fetch(PDO::FETCH_ASSOC)){
            $history_id = $fetch_history['id'];
         
   ?>
   <div class="row">
    

      <div class="details">
        
      <p>Organization name</p>
         <div class="description"><?= $fetch_history['org_name']; ?></div>
         <p>Organization address</p>
         <div class="description"><?= $fetch_history['org_add']; ?></div>
         <p>Organization phone</p>
         <div class="description"><?= $fetch_history['org_phone']; ?></div>
         <p>Organization website</p>
         <div class="description"><?= $fetch_history['org_web']; ?></div>
         <p>Actual Job title</p>
         <div class="description"><?= $fetch_history['job_title']; ?></div>
         <p>Start date:</p>
         <div class="description"><?= $fetch_history['start_date']; ?></div>
         <p>End date </p>
         <div class="description"><?= $fetch_history['end_date']; ?></div>
         <p>Base pay:</p>
         <div class="description"><?= $fetch_history['base_pay']; ?></div>
         <p>Total Annual compensation</p>
         <div class="description"><?= $fetch_history['annual_comp']; ?></div>
         <p>Boss' name:</p>
         <div class="description"><?= $fetch_history['boss_name']; ?></div>
         <p>Boss' job title:</p>
         <div class="description"><?= $fetch_history['boss_job_title']; ?></div>
         <p>Boss' phone:</p>
         <div class="description"><?= $fetch_history['boss_phone']; ?></div>
         <p>Boss' email:</p>
         <div class="description"><?= $fetch_history['boss_email']; ?></div>
         <p>Reference's name:</p>
         <div class="description"><?= $fetch_history['ref_name']; ?></div>
         <p>Reference's job title:</p>
         <div class="description"><?= $fetch_history['ref_job_title']; ?></div>
         <p>Reference's personal phone:</p>
         <div class="description"><?= $fetch_history['ref_phone']; ?></div>
         <p>Reference's personal email:</p>
         <div class="description"><?= $fetch_history['ref_email']; ?></div>
         <p>Main tasks & results</p>
         <div class="description"><?= $fetch_history['main_task']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_one']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_two']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_three']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_four']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_five']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_six']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_seven']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_eight']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_nine']; ?></div>
         <p>Important tasks & results</p>
         <div class="description"><?= $fetch_history['imp_task_ten']; ?></div>

         <p>Scope of role</p>
         <div class="description"><?= $fetch_history['scope_of_role']; ?></div>

         <p>Position summary</p>
         <div class="description"><?= $fetch_history['pos_summary']; ?></div>

         <p>Position headline</p>
         <div class="description"><?= $fetch_history['pos_headline']; ?></div>


            <center><button id="PrintButton" onclick="PrintPage()" hidden>Print</button></center>

         </form>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No career history found!</p>';
      }
   ?>

</section>

















<script src="../js/admin_script.js"></script>
<script src="../js/jquery.min.js"></script>
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