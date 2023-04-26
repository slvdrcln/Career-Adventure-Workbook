<?php

   include '../components/connect.php';

   if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      header('location:/index.php');
   }

if(isset($_POST['submit'])){

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $select_user->execute([$user_id]);
   $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

   $select_info = $conn->prepare("SELECT * FROM `add_info` WHERE user_id = ?");
   $select_info->execute([$user_id]);
   $fetch_info = $select_info->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $fetch_user['password'];


   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
      $message[] = 'Name updated successfully!';
   }

 if(!empty($phone)){
      $update_phone = $conn->prepare("UPDATE `users` SET phone = ? WHERE id = ?");
      $update_phone->execute([$phone, $user_id]);
      $message[] = 'Phone number updated successfully!';
   }


   if(!empty($email)){
      $select_email = $conn->prepare("SELECT email FROM `users` WHERE id = ? AND email = ?");
      $select_email->execute([$user_id, $email]);
      if($select_email->rowCount() > 0){
         $message[] = 'Email Already Taken!';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
         $message[] = 'Email Updated Successfully!';
      }
   }


   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'Old password not matched!';
      }elseif($new_pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$cpass, $user_id]);
            $message[] = 'Password updated successfully!';
         }else{
            $message[] = 'Please enter a new password!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- update starts  -->

<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Update Profile</h3>
      <div class="flex">
         <div class="col">
            <p>Name: </p>
            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="50"  class="box">
      
            <p>Email: </p>
            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="20"  class="box">

	<p>Phone number:</p>
        <input type="text" name="phone" placeholder="<?= $fetch_profile['phone']; ?>" maxlength="20"  class="box">
         </div>
         <div class="col">
            <p>Old password:</p>
            <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20"  class="box">
            <p>New password:</p>
            <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"  class="box">
            <p>Confirm password:</p>
            <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"  class="box">
         </div>
      </div>

      <input type="submit" name="submit" value="Update now" class="btn">
      
   </form>

</section>

<!-- update section ends -->










<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
   
</body>
</html>