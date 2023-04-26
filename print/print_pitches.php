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
   <title>Elevator Pitch</title>

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
  $select_pitch = $conn->prepare("SELECT * FROM `pitch` WHERE user_id = ? ORDER BY date DESC");
  $select_pitch->execute([$user_id]);
  if($select_pitch->rowCount() > 0){
  while($fetch_pitch = $select_pitch->fetch(PDO::FETCH_ASSOC)){
    $pitch_id = $fetch_pitch['id'];
           
    
   ?>
   <div class="row">
    

      <div class="details">

      
        
         <h3 class="print"><?php echo $fetch_pitch['title']; ?></h3>
         <br>
         <p><b>STAR Stories</b></p>
         <div class="star"><?php echo $fetch_pitch['step_one']; ?></div>
         <p><b>Word clouds</b></p>
         <div class="star"><?php echo $fetch_pitch['step_two_one']; ?></div>
         <div class="star"><?php echo $fetch_pitch['step_two_two']; ?></div>
         <p><b>Observations</b></p>
         <div class="star"><?php echo $fetch_pitch['step_three_one']; ?></div>
         <div class="star"><?php echo $fetch_pitch['step_three_two']; ?></div>
         <div class="star"><?php echo $fetch_pitch['step_three_three']; ?></div>
         <p><b>Streamline & Practice</b></p>
         <div class="star"><?php echo $fetch_pitch['step_four']; ?></div>


            <center><button id="PrintButton" onclick="PrintPage()" hidden>Print</button></center>
         </form>
      </div>
   </div>
   <?php
         }
      }
      else{
         echo '<p class="empty">No elevator pitch found!</p>';
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