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
   <title>Career History</title>

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
<body style="justify-content: center; align-items: center;">
      <?php include '../components/admin_header.php'; ?>
<section class="playlist-details">

   
   <?php
  $select_history = $conn->prepare("SELECT * FROM `history` WHERE user_id = ? ORDER BY date DESC");
  $select_history->execute([$user_id]);
  if($select_history->rowCount() > 0){
  while($fetch_history = $select_history->fetch(PDO::FETCH_ASSOC)){
    $history_id = $fetch_history['id'];
           
    
   ?>
   <div class="row">
    

    <div class="details-history">

    
    <div class="left">
       <h3 class="print">Career History</h3>
       <p><b>Position headline</b></p>
       <div class="history"><?php echo $fetch_history['pos_headline']; ?></div>
       <p><b>Organization name</b></p>
       <div class="history"><?php echo $fetch_history['org_name']; ?></div>
       <p><b>Organization address</b></p>
       <div class="history"><?php echo $fetch_history['org_add']; ?></div>
       <p><b>Organization website</b></p>
       <div class="history"><?php echo $fetch_history['org_web']; ?></div>
       <p><b>Organization phone #</b></p>         
       <div class="history"><?php echo $fetch_history['org_phone']; ?></div>
       <p><b>Actual Job Title</b></p>
       <div class="history"><?php echo $fetch_history['job_title']; ?></div>
       <p><b>Date</b></p>
       <div class="history"><?php echo $fetch_history['start_date']; ?> - <?php echo $fetch_history['end_date']; ?></div>
       <p><b>Base Pay</b></p>
       <div class="history"><?php echo $fetch_history['base_pay']; ?></div>
       <p><b>Total annual compensation</b></p>
       <div class="history"><?php echo $fetch_history['annual_comp']; ?></div>
       <p><b>Boss name</b></p>
       <div class="history"><?php echo $fetch_history['boss_name']; ?></div>
       <p><b>Boss job title</b></p>
       <div class="history"><?php echo $fetch_history['boss_job_title']; ?></div>
       <p><b>Boss phone number</b></p>
       <div class="history"><?php echo $fetch_history['boss_phone']; ?></div>
       <p><b>Boss email address</b></p>
       <div class="history"><?php echo $fetch_history['boss_email']; ?></div>
       <p><b>Reference's name</b></p>
       <div class="history"><?php echo $fetch_history['ref_name']; ?></div>
       <p><b>Reference's job title</b></p>
       <div class="history"><?php echo $fetch_history['ref_job_title']; ?></div>
       <p><b>Reference's phone number</b></p>
       <div class="history"><?php echo $fetch_history['ref_phone']; ?></div>
       <p><b>Reference's email address</b></p>
       <div class="history"><?php echo $fetch_history['ref_email']; ?></div>
       
    </div>

    <div class="right">
       
       <p><b>Position summary</b></p>
       <div class="history"><?php echo $fetch_history['pos_summary']; ?></div>
       <p><b>Scope of role</b></p>
       <div class="history"><?php echo $fetch_history['scope_of_role']; ?></div>
       <p><b>Main task & result</b></p>
       <div class="history"><?php echo $fetch_history['main_task']; ?></div>
       <p><b>Important tasks & results</b></p>
       <div class="history"><?php echo $fetch_history['imp_task_one']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_two']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_three']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_four']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_five']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_six']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_seven']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_eight']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_nine']; ?></div>
       <div class="history"><?php echo $fetch_history['imp_task_ten']; ?></div>
       




    </div>












          <center><button id="PrintButton" onclick="PrintPage()" hidden>Print</button></center>
       </form>
    </div>
 </div>
   <?php
         }
      }
      else{
         echo '<p class="empty">No career history found!</p>';
      }
   ?>

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