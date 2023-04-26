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
   header('location:profile.php');
}


if(isset($_POST['update_info'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);

   $nickname = $_POST['nickname'];
   $nickname = filter_var($nickname, FILTER_SANITIZE_STRING);

   $country = $_POST['country'];
   $country = filter_var($country, FILTER_SANITIZE_STRING);

   $region = $_POST['region'];
   $region = filter_var($region, FILTER_SANITIZE_STRING);   

   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);

   $fb = $_POST['fb'];
   $fb = filter_var($fb, FILTER_SANITIZE_STRING);

   $ig = $_POST['ig'];
   $ig = filter_var($ig, FILTER_SANITIZE_STRING);

   $linkedin = $_POST['linkedin'];
   $linkedin = filter_var($linkedin, FILTER_SANITIZE_STRING);

   $site = $_POST['site'];
   $site = filter_var($site, FILTER_SANITIZE_STRING);

   $update_info = $conn->prepare("UPDATE `add_info` SET title = ?, country = ?, region = ?, city = ?, nickname = ?, fb = ?, ig = ?, linkedin =?, site = ? WHERE id = ?");
   $update_info->execute([$title, $country, $region, $city, $nickname, $fb, $ig, $linkedin, $site, $get_id]);

   $message[] = 'Additional information updated!';  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Information</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Update Information</h1>

   <?php
    $select_info = $conn->prepare("SELECT * FROM `add_info` WHERE id = ?");
    $select_info->execute([$get_id]);
    if($select_info->rowCount() > 0){
    while($fetch_info = $select_info->fetch(PDO::FETCH_ASSOC)){
       $info_id = $fetch_info['id'];
        
        ?>
            
   <form action="" method="post" enctype="multipart/form-data">
      <input type="text" name="title" value="<?= $fetch_info['title']; ?>" hidden>
      <p>Nickname:</p>      
      <input type="text" name="nickname" maxlength="100"  value="<?= $fetch_info['nickname']; ?>" class="box">
      <p>Home address:</p>
      <input type="text" name="country" maxlength="100"  value="<?= $fetch_info['country']; ?>" class="box">
      <input type="text" name="region" maxlength="100"  value="<?= $fetch_info['region']; ?>" class="box">
      <input type="text" name="city" maxlength="100"  value="<?= $fetch_info['city']; ?>" class="box">
      <p>Social Media:</p>
      <input type="text" name="fb" maxlength="100"  value="<?= $fetch_info['fb']; ?>" class="box">
      <input type="text" name="ig" maxlength="100"  value="<?= $fetch_info['ig']; ?>" class="box">
      <input type="text" name="linkedin" maxlength="100"  value="<?= $fetch_info['linkedin']; ?>" class="box">
      <p>Website:</p>
      <input type="text" name="site" maxlength="100"  value="<?= $fetch_info['site']; ?>" class="box">

      <input type="submit" value="Update" name="update_info" class="btn">
      <div class="flex-btn">
        <button type="submit" class="delete-btn" onclick="return confirm('Delete this information?')" name="delete_info">Delete</button>

      </div>
   </form>

   <?php

        
        }

    } else {
    echo '<p class="empty">No additional information added yet!</p>';
    header('location: profile.php');
    exit();
    }

      ?>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>