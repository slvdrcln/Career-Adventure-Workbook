<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:playlist.php');
}

if(isset($_POST['submit'])){

   $org_name = $_POST['org_name'];
   $org_name = filter_var($org_name, FILTER_SANITIZE_STRING);
   $org_add = $_POST['org_add'];
   $org_add = filter_var($org_add, FILTER_SANITIZE_STRING);
   $org_phone = $_POST['org_phone'];
   $org_phone = filter_var($org_phone, FILTER_SANITIZE_STRING);
   $org_web = $_POST['org_web'];
   $org_web = filter_var($org_web, FILTER_SANITIZE_STRING);   
   
   $job_title = $_POST['job_title'];
   $job_title = filter_var($job_title, FILTER_SANITIZE_STRING);
   $start_date = $_POST['start_date'];
   $start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
   $end_date = $_POST['end_date'];
   $end_date = filter_var($end_date, FILTER_SANITIZE_STRING);

   $base_pay = $_POST['base_pay'];
   $base_pay = filter_var($base_pay, FILTER_SANITIZE_STRING);
   $annual_comp = $_POST['annual_comp'];
   $annual_comp = filter_var($annual_comp, FILTER_SANITIZE_STRING);

   $boss_name = $_POST['boss_name'];
   $boss_name = filter_var($boss_name, FILTER_SANITIZE_STRING);   
   $boss_job_title = $_POST['boss_job_title'];
   $boss_job_title = filter_var($boss_job_title, FILTER_SANITIZE_STRING);
   $boss_phone = $_POST['boss_phone'];
   $boss_phone = filter_var($boss_phone, FILTER_SANITIZE_STRING);
   $boss_email = $_POST['boss_email'];
   $boss_email = filter_var($boss_email, FILTER_SANITIZE_STRING);

   $ref_name = $_POST['ref_name'];
   $ref_name = filter_var($ref_name, FILTER_SANITIZE_STRING);
   $ref_job_title = $_POST['ref_job_title'];
   $ref_job_title = filter_var($ref_job_title, FILTER_SANITIZE_STRING);
   $ref_phone = $_POST['ref_phone'];
   $ref_phone = filter_var($ref_phone, FILTER_SANITIZE_STRING);
   $ref_email = $_POST['ref_email'];
   $ref_email = filter_var($ref_email, FILTER_SANITIZE_STRING);


   $main_task = $_POST['main_task'];
   $main_task = filter_var($main_task, FILTER_SANITIZE_STRING);

   $imp_task_one = $_POST['imp_task_one'];
   $imp_task_one = filter_var($imp_task_one, FILTER_SANITIZE_STRING);
   $imp_task_two = $_POST['imp_task_two'];
   $imp_task_two = filter_var($imp_task_two, FILTER_SANITIZE_STRING);
   $imp_task_three = $_POST['imp_task_three'];
   $imp_task_three = filter_var($imp_task_three, FILTER_SANITIZE_STRING);
   $imp_task_four = $_POST['imp_task_four'];
   $imp_task_four = filter_var($imp_task_four, FILTER_SANITIZE_STRING);
   $imp_task_five = $_POST['imp_task_five'];
   $imp_task_five = filter_var($imp_task_five, FILTER_SANITIZE_STRING);
   $imp_task_six = $_POST['imp_task_six'];
   $imp_task_six = filter_var($imp_task_six, FILTER_SANITIZE_STRING);
   $imp_task_seven = $_POST['imp_task_seven'];
   $imp_task_seven = filter_var($imp_task_seven, FILTER_SANITIZE_STRING);
   $imp_task_eight = $_POST['imp_task_eight'];
   $imp_task_eight = filter_var($imp_task_eight, FILTER_SANITIZE_STRING);
   $imp_task_nine = $_POST['imp_task_nine'];
   $imp_task_nine = filter_var($imp_task_nine, FILTER_SANITIZE_STRING);
   $imp_task_ten = $_POST['imp_task_ten'];
   $imp_task_ten = filter_var($imp_task_ten, FILTER_SANITIZE_STRING);


   $scope_of_role = $_POST['scope_of_role'];
   $scope_of_role = filter_var($scope_of_role, FILTER_SANITIZE_STRING);
   $pos_summary = $_POST['pos_summary'];
   $pos_summary = filter_var($pos_summary, FILTER_SANITIZE_STRING);
   $pos_headline = $_POST['pos_headline'];
   $pos_headline = filter_var($pos_headline, FILTER_SANITIZE_STRING);


   $update_history = $conn->prepare("UPDATE `history` SET org_name = ?, org_add = ?, org_phone = ?, org_web =?, job_title = ?, start_date = ?, end_date = ?, base_pay = ?, annual_comp = ?, boss_name = ?, boss_job_title = ?, boss_phone = ?, boss_email = ?, ref_name = ?, ref_job_title = ?, ref_phone = ?, ref_email = ?, main_task = ?, imp_task_one = ?, imp_task_two = ?, imp_task_three = ?, imp_task_four =?, imp_task_five = ?, imp_task_six = ?, imp_task_seven = ?, imp_task_eight = ?, imp_task_nine = ?, imp_task_ten = ?, scope_of_role = ?, pos_summary = ?, pos_headline = ? WHERE id = ?");
   $update_history->execute([$org_name, $org_add, $org_phone, $org_web, $job_title, $start_date, $end_date, $base_pay, $annual_comp, $boss_name, $boss_job_title, $boss_phone, $boss_email, $ref_name, $ref_job_title, $ref_phone, $ref_email, $main_task, $imp_task_one, $imp_task_two, $imp_task_three, $imp_task_four, $imp_task_five, $imp_task_six, $imp_task_seven, $imp_task_eight, $imp_task_nine, $imp_task_ten, $scope_of_role, $pos_summary, $pos_headline, $get_id]);

   $message[] = 'Career history updated!';  

}

if(isset($_POST['delete'])){
   $delete_id = $_POST['history_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $delete_history = $conn->prepare("DELETE FROM `history` WHERE id = ?");
   $delete_history->execute([$delete_id]);
   header('location:career_history.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update career history</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

<style>

*{
   transition: all .2s ease;
}


.extra-info {
  display: none;
  line-height: 20px;
  font-size: 14px;
	position: relative;
   transition: all .2s ease;
   padding: 2px;

}

.info:hover .extra-info {
  display: inline-block;
  transition: all .2s ease;
  background-color: white;
  border-radius: 16px;
  background-color: #CECECE !important;
  margin: 0 auto;
  justify-content: center;
  align-items: center;
  text-align: center;

}

.info {
  font-size: 20px;
  padding-left: 10px;
  width: 30px;
  border-radius: 15px;
  color: black;
  transition: all .2s ease;
}

.info:hover {
  background-color: white;
  padding: 0 0 0 5px;
  width: 315px;
  text-align: left !important;
  transition: all .2s ease;
  color: black;

}
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">update history</h1>

   <?php
         $select_history = $conn->prepare("SELECT * FROM `history` WHERE id = ?");
         $select_history->execute([$get_id]);
         if($select_history->rowCount() > 0){
         while($fetch_history = $select_history->fetch(PDO::FETCH_ASSOC)){
            $history_id = $fetch_history['id'];
      ?>
   <form action="" method="post" enctype="multipart/form-data">
   <p>Organization name:<span>*</span></p>
      <input type="text" id="myInput" required name="org_name" maxlength="100" placeholder="" value="<?= $fetch_history['org_name']; ?>" class="box">
 
      <p>Organization address:<span>*</span></p>
      <input type="text" name="org_add" maxlength="100" required value="<?= $fetch_history['org_add']; ?>" class="box">


      <p>Organization phone:<span>*</span></p>
      <input type="text" name="org_phone" maxlength="100" required value="<?= $fetch_history['org_phone']; ?>" class="box">

      <p>Organization website:</p>
      <input type="text" name="org_web" maxlength="100" value="<?= $fetch_history['org_web']; ?>" class="box">

      <p>Actual job title:<span>*</span></p>
      <input type="text" name="job_title" maxlength="100" value="<?= $fetch_history['job_title']; ?>" class="box">
      <p>Start date:<span>*</span></p>
      <input type="date" name="start_date" maxlength="100" value="<?= $fetch_history['start_date']; ?>" class="box">  
      <p>End date: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        if this is your current job, type "present" in this field</span></i></span></p>
      <input type="text" name="end_date" maxlength="100" placeholder="mm/dd/yyyy" class="box" value="<?= $fetch_history['end_date']; ?>">
      
      <p>Base pay:</p>
      <input type="text" name="base_pay" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['base_pay']; ?>">
      <p>Total annual compensation:</p>
      <input type="text" name="annual_comp" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['annual_comp']; ?>">
      <p>Boss' name:</p>
      <input type="text" name="boss_name" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['boss_name']; ?>">
      <p>Boss' actual title:</p>
      <input type="text" name="boss_job_title" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['boss_job_title']; ?>">
      <p>Boss' phone:</p>
      <input type="text" name="boss_phone" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['boss_phone']; ?>">
      <p>Boss' email:</p>
      <input type="text" name="boss_email" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['boss_email']; ?>">
      <p>Reference's name:</p>
      <input type="text" name="ref_name" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['ref_name']; ?>">
      <p>Reference's job title:</p>
      <input type="text" name="ref_job_title" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['ref_job_title']; ?>">
      <p>Reference's personal phone:</p>
      <input type="text" name="ref_phone" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['ref_phone']; ?>">
      <p>Reference's personal email:</p>
      <input type="text" name="ref_email" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['ref_email']; ?>">
      <p>Main task & results:<span>*</span> <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="main_task" class="box" required maxlength="1000" cols="30" rows="10"><?= $fetch_history['main_task']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_one" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_one']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_two" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_two']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_three" class="box"maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_three']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_four" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_four']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_five" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_five']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_six" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_six']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_seven" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_seven']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_eight" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_eight']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_nine" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_nine']; ?></textarea>
      <p>Important tasks & results: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        for each task add the desired outcomes, your actual outcomes, and links to evidence of those outcomes (e.g. URL to an image showing numbers or quotes)</span></i></span></p>
      <textarea name="imp_task_ten" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_history['imp_task_ten']; ?></textarea>
      <p>Scope of role:<span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        total budget managed, # of direct reports/employees in your food chain, decision authority, accountabilities, major requirements, based in time spent or impact on the organization.</span></i></span></p>
      <input type="text" name="scope_of_role" maxlength="100" placeholder="" class="box" value="<?= $fetch_history['scope_of_role']; ?>">
      <p>Position summary:<span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        summary of this role in 1-3 sentences.</span></i></span></p>
      <textarea name="pos_summary" class="box" required placeholder="What do you exceptionally well..." maxlength="1000" cols="30" rows="10"><?= $fetch_history['pos_summary']; ?></textarea>
      <p>Position headline:<span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i><span class="extra-info">
        3-6 words that a news article would use as a title for the story about your position at this organization</span></i></span></p>
      <input type="text" name="pos_headline" required maxlength="100" required class="box" value="<?= $fetch_history['pos_headline']; ?>">

      <div class="flex-btn">
         <input type="submit" value="update history" name="submit" class="btn">
      </div>
   </form>
   <?php
      } 
   }else{
      echo '<p class="empty">no career history added yet!</p>';
   }
   ?>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>