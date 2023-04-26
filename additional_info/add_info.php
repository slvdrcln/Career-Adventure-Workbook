<?php
include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_info'])){

   $id = unique_id();
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

   $add_info = $conn->prepare("INSERT INTO `add_info`(id, user_id, title, nickname, country, region, city, fb, ig, linkedin, site) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
   $add_info->execute([$id, $user_id, $title, $nickname, $country, $region, $city, $fb, $ig, $linkedin, $site]);

   $message[] = 'New additional information added!';


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Additional Information</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

   

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Additional Information</h1>

   <form action="" method="post" enctype="multipart/form-data">

	<input type="text" value="Additional Information" name="title" hidden>
      <p>Nickname:</p>
      <input type="text" name="nickname" maxlength="100" placeholder="" class="box" required>
      <p>Home address: </p>
      <input type="text" name="country" maxlength="100" placeholder="Country" class="box">
      <input type="text" name="region" maxlength="100" placeholder="Region/State" class="box">
      <input type="text" name="city" maxlength="100" placeholder="City" class="box">
      <p>Social Media:</p>
      <input type="text" name="fb" maxlength="100" placeholder="Facebook URL" class="box"> 
      <input type="text" name="ig" maxlength="100" placeholder="Instagram URL" class="box"> 
      <input type="text" name="linkedin" maxlength="100" placeholder="Linkedin URL" class="box"> 
      <p>Website:</p>
      <input type="text" name="site" maxlength="100" placeholder="Personal website URL" class="box"> 

      <button type="submit" class="btn" name="add_info">Add</button>
   </form>

</section>







<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
