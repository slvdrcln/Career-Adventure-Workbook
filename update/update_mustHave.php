<?php
include'../components/connect.php';

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
    header('location:../admin/skills_pref.php');
 }

if(isset($_POST['submit'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $salary = $_POST['salary'];
   $salary = filter_var($salary, FILTER_SANITIZE_STRING);
   $benefits = $_POST['benefits'];
   $benefits = filter_var($benefits, FILTER_SANITIZE_STRING);

   $work_env = $_POST['work_env'];
   $work_env = filter_var($work_env, FILTER_SANITIZE_STRING);




   $update_mustHave = $conn->prepare("UPDATE `must_have` SET title = ?, salary = ?, benefits = ?, work_env = ? WHERE id = ?");
   $update_mustHave->execute([$title, $salary, $benefits, $work_env, $get_id]);

   $message[] = 'Must haves updated!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Must haves</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">


</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

<h1 class="heading">Update must haves</h1>

<?php
         $select_mustHave = $conn->prepare("SELECT * FROM `must_have` WHERE id = ?");
         $select_mustHave->execute([$get_id]);
         if($select_mustHave->rowCount() > 0){
         while($fetch_mustHave = $select_mustHave->fetch(PDO::FETCH_ASSOC)){
            $mustHave_id = $fetch_mustHave['id'];
      ?>
<form action="" method="post" enctype="multipart/form-data">
<input type="text" name="title" hidden value="Must haves"/>
<p>Minimum acceptable total compensation (salary + bonus):</p>
      <input type="text" name="salary" class="box" required value="<?= $fetch_mustHave['salary']; ?>">
      <p>Benefits you must have (from your employer): <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        e.g. health, dental, mental, vision, life, disability, prescription, workers compensation, and/or pet insurance; wellness program, meals, discounts, diversity program, etc.</span></i></span></p>
      <textarea name="benefits" class="box" required maxlength="1000" cols="30" rows="10"><?= $fetch_mustHave['benefits']; ?></textarea>
      <p>Culture and work environment (describe your desired company or team culture and behaviors):</p>
      <textarea name="work_env" class="box" required maxlength="1000" cols="30" rows="10"><?= $fetch_mustHave['work_env']; ?></textarea>



   <input type="submit" value="Create" name="submit" class="btn">
</form>
<?php
      } 
   }else{
      echo '<p class="empty">no must haves added yet!</p>';
   }
   ?>
</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
