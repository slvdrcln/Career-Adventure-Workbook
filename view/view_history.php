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
   header('location:../admin/history.php');
}

if(isset($_POST['delete_history'])){
   $delete_id = $_POST['history_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_history = $conn->prepare("DELETE FROM `history` WHERE id = ?");
   $delete_history->execute([$delete_id]);
   $message[] = 'Career history deleted!';
   header('location:../admin/history.php');

} 



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Career history details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Career history details</h1>

   <?php
      $select_history = $conn->prepare("SELECT * FROM `history` WHERE id = ? AND user_id = ?");
      $select_history->execute([$get_id, $user_id]);
      if($select_history->rowCount() > 0){
         while($fetch_history = $select_history->fetch(PDO::FETCH_ASSOC)){
            $history_id = $fetch_history['id'];
   ?>
   <div class="view" id="link">
   <div class="details"><span style="float: right; padding-top: 1rem; font-size: 2rem; color: #4472ca;"id="copy-btn"><i style="cursor: pointer;" class="fa-regular fa-clone"></i><span id="msg"></span></span>


   <div class="name">Organization name </div>
         <p class="description"><?= $fetch_history['org_name']; ?></p>
         <div class="name">Organization address</div>
         <p class="description"><?= $fetch_history['org_add']; ?></p>
         <div class="name">Organization phone</div>
         <p class="description"><?= $fetch_history['org_phone']; ?></p>
         <div class="name">Organization website</div>
         <p class="description"><?= $fetch_history['org_web']; ?></p>
         <div class="name">Actual job title</div>
         <p class="description"><?= $fetch_history['job_title']; ?></p>
         <div class="name">Start date</div>
         <p class="description"><?= $fetch_history['start_date']; ?></p>
         <div class="name">End date </div>
         <p class="description"><?= $fetch_history['end_date']; ?></p>
         <div class="name">Base pay</div>
         <p class="description"><?= $fetch_history['base_pay']; ?></p>
         <div class="name">Total annual compensation</div>
         <p class="description"><?= $fetch_history['annual_comp']; ?></p>
         <div class="name">Boss' name</div>
         <p class="description"><?= $fetch_history['boss_name']; ?></p>
         <div class="name">Boss' job title</div>
         <p class="description"><?= $fetch_history['boss_job_title']; ?></p>
         <div class="name">Boss' phone</div>
         <p class="description"><?= $fetch_history['boss_phone']; ?></p>
         <div class="name">Boss' email</div>
         <p class="description"><?= $fetch_history['boss_email']; ?></p>
         <div class="name">Reference's name</div>
         <p class="description"><?= $fetch_history['ref_name']; ?></p>
         <div class="name">Reference's job title</div>
         <p class="description"><?= $fetch_history['ref_job_title']; ?></p>
         <div class="name">Reference's personal phone</div>
         <p class="description"><?= $fetch_history['ref_phone']; ?></p>
         <div class="name">Reference's personal email</div>
         <p class="description"><?= $fetch_history['ref_email']; ?></p>
         <div class="name">Main task & results</div>
         <p class="description"><?= $fetch_history['main_task']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_one']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_two']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_three']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_four']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_five']; ?></p>
         <div class="name">Important tasks & results</p>
         <p class="description"><?= $fetch_history['imp_task_six']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_seven']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_eight']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_nine']; ?></p>
         <div class="name">Important tasks & results</div>
         <p class="description"><?= $fetch_history['imp_task_ten']; ?></p>
         <div class="name">Scope of role</div>
         <p class="description"><?= $fetch_history['scope_of_role']; ?></p>

         <div class="name">Position summary</p>
         <p class="description"><?= $fetch_history['pos_summary']; ?></p>
         <div class="name">Position headline</div>
         <p class="description"><?= $fetch_history['pos_headline']; ?></p>



         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="history_id" value="<?= $history_id; ?>">
            <a href="../update/update_history.php?get_id=<?= $history_id; ?>" class="option-btn"><i class="fa-solid fa-pen-nib"></i> Update</a>
            <!-- <input type="submit" value="delete history" class="delete-btn" onclick="return confirm('delete this history?');" name="delete_history"> -->
            <button type="submit" class="delete-btn" onclick="return confirm('Delete this history?')" name="delete_history"><i class="fa-solid fa-trash"></i> Delete</button>
            <a href="../print/print_history.php?get_id=<?= $history_id; ?>" class="btn btn-success pull-right"><i class="fa-solid fa-print"></i> Print</a> 
         </form>
         </div>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no history found!</p>';
      }
   ?>

</section>
















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
<script src="../js/jquery.min.js"></script>


</body>
</html>