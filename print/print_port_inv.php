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
   <title>Portfolio & Invention</title>

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
        $select_invention = $conn->prepare("SELECT * FROM `invention` WHERE user_id = ? ORDER BY date DESC");
        $select_invention->execute([$user_id]);
        if($select_invention->rowCount() > 0){
        while($fetch_invention = $select_invention->fetch(PDO::FETCH_ASSOC)){
          $invention_id = $fetch_invention['id'];
            ?>
            <h3 class="print">Invention</h3>
            <p><b>Invention name</b></p>
            <div class="history"><?php echo $fetch_invention['invention_name']; ?></div>
            <p><b>Number</b></p>
            <div class="history"><?php echo $fetch_invention['num']; ?></div>
            <p><b>Country</b></p>
            <div class="history"><?php echo $fetch_invention['country']; ?></div>
            <p><b>Date</b></p>
            <div class="history"><?php echo $fetch_invention['date_issued']; ?></div>
            <p><b>Co-inventor(s) name</b></p>
            <div class="history"><?php echo $fetch_invention['co_name']; ?></div>
            <p><b>Co-inventor(s) email</b></p>

            <div class="history"><?php echo $fetch_invention['co_email']; ?></div>
            <p><b>Co-inventor(s) phone</b></p>
            <div class="history"><?php echo $fetch_invention['co_phone']; ?></div>


            
         

            <?php
               }
            }
            else{
               echo '<p class="empty">No innovation found!</p>';
            }
            ?>
         

         </div>

         <div class="rightTwo">



            <?php
            $select_portfolio = $conn->prepare("SELECT * FROM `portfolio` WHERE user_id = ? ORDER BY date DESC");
            $select_portfolio->execute([$user_id]);
            if($select_portfolio->rowCount() > 0){
            while($fetch_portfolio = $select_portfolio->fetch(PDO::FETCH_ASSOC)){
              $portfolio_id = $fetch_portfolio['id'];
            ?>
            <h3 class="print">Portfolio</h3>
            <p><b>URL</b></p>
            <div class="history"><?php echo $fetch_portfolio['url']; ?></div>
            <p><b>Description</b></p>
            <div class="history"><?php echo $fetch_portfolio['portfolio_name']; ?></div>
            <?php
               }
            }
            else{
               echo '<p class="empty">no porfolio found!</p>';
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