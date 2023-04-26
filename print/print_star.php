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
   <title>STAR stories</title>

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
  $select_stories = $conn->prepare("SELECT * FROM `stories` WHERE user_id = ? ORDER BY date DESC");
  $select_stories->execute([$user_id]);
  if($select_stories->rowCount() > 0){
  while($fetch_stories = $select_stories->fetch(PDO::FETCH_ASSOC)){
    $stories_id = $fetch_stories['id'];
   ?>
   <div class="row">
    

      <div class="details">

      
        
         <h3 class="print"><?php echo $fetch_stories['title']; ?></h3>
         <br>
         <p><b>What was the Situation? Who, what, why, how, when, where, and to what degree?</b></p>
         <div class="star"><?php echo $fetch_stories['situation']; ?></div>
         <p><b>What did you Think when the challenge was first presented to you?</b></p>
         <div class="star"><?php echo $fetch_stories['think']; ?></div>
         <p><b>What Actions did you take? List the steps in order and what your role was in each step.</b></p>
         <div class="star"><?php echo $fetch_stories['action']; ?></div>
         <p><b>What ended up happening? What were the final Results? Include factual information such as numbers or quotes from stakeholders. Be clear about the before and after changes.</b></p>         
         <div class="star"><?php echo $fetch_stories['result']; ?></div>


            <center><button id="PrintButton" onclick="PrintPage()" hidden>Print</button></center>
         </form>
      </div>
   </div>
   <?php
  }
         }
      
      else{
         echo '<p class="empty">No story found!</p>';
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