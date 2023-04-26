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
   <title>Creation & Innovation</title>

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
               $select_creation = $conn->prepare("SELECT * FROM `creation` WHERE user_id = ? ORDER BY date DESC");
               $select_creation->execute([$user_id]);
               if($select_creation->rowCount() > 0){
               while($fetch_creation = $select_creation->fetch(PDO::FETCH_ASSOC)){
                 $creation_id = $fetch_creation['id'];
            ?>
            <h3 class="print">Creation & innovation</h3>
            <p><b>Creation name</b></p>
            <div class="history"><?php echo $fetch_creation['creation_name']; ?></div>
            <p><b>URL link</b></p>
            <div class="history"><?php echo $fetch_creation['url']; ?></div>
            <p><b>Date published</b></p>
            <div class="history"><?php echo $fetch_creation['published_date']; ?></div>
            <p><b>Name of published site</b></p>
            <div class="history"><?php echo $fetch_creation['publish_site']; ?></div>
            <p><b>Publisher</b></p>
            <div class="history"><?php echo $fetch_creation['publisher']; ?></div>
            <p><b>Publisher's website</b></p>
            <div class="history"><?php echo $fetch_creation['publisher_web']; ?></div>
            <p><b>Publisher's email</b></p>
            <div class="history"><?php echo $fetch_creation['publisher_email']; ?></div>
            <p><b>Publisher's phone</b></p>
            <div class="history"><?php echo $fetch_creation['publisher_phone']; ?></div>



            <?php
                  }
               }
               else{
                  echo '<p class="empty">No creation & innovation found!</p>';
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