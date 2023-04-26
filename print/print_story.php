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
   <title>Print Story</title>

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
			margin: 0;  /* this affects the margin in the printer settings from 0 to all 1 */
		}
</style>
</head>
<body style="justify-content: center; align-items: center;">
      <?php include '../components/admin_header.php'; ?>
<section class="playlist-details">

   <!-- <h1 class="heading">story details</h1> -->
   
   <?php
      $select_stories = $conn->prepare("SELECT * FROM `stories` WHERE id = ? AND user_id = ?");
      $select_stories->execute([$get_id, $user_id]);
      if($select_stories->rowCount() > 0){
         while($fetch_stories = $select_stories->fetch(PDO::FETCH_ASSOC)){
            $stories_id = $fetch_stories['id'];
         
   ?>
   <div class="row">
    

      <div class="details">
        
         <h3 class="title"><?php echo $fetch_stories['title']; ?></h3>

            <!-- <div><i class="fas fa-circle-dot" style="<?php if($fetch_stories['status'] == 'Technical Skill' || 'Obstacle' || 'Improvement' || 'Lesson Learned' || 'Interpersonal Skill' || 'Accomplishment'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_stories['status'] ==  'Technical Skill' || 'Obstacle' || 'Improvement' || 'Lesson Learned' || 'Interpersonal Skill' || 'Accomplishment'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_stories['status']; ?></span></div> -->


         <div class="date"><i class="fas fa-calendar"></i><span><?php echo $fetch_stories['date']; ?></span></div>
         <p>What was the Situation? Who, what, why, how, when, where, and to what degree? <span>*</span></p>
         <div class="description"><?php echo $fetch_stories['situation']; ?></div>
         <p>What did you Think when the challenge was first presented to you? <span>*</span></p>
         <div class="description"><?php echo $fetch_stories['think']; ?></div>
         <p>What Actions did you take? List the steps in order and what your role was in each step. <span>*</span></p>
         <div class="description"><?php echo $fetch_stories['action']; ?></div>
         <p>What ended up happening? What were the final Results? Include factual information such as numbers or quotes from stakeholders. Be clear about the before and after changes.
<span>*</span></p>         
         <div class="description"><?php echo $fetch_stories['result']; ?></div>


            <center><button id="PrintButton" onclick="PrintPage()" hidden>Print</button></center>

         </form>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No story found!</p>';
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