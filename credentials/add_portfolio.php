<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_portfolio'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $portfolio_name = $_POST['portfolio_name'];
   $portfolio_name = filter_var($portfolio_name, FILTER_SANITIZE_STRING);
   $url = $_POST['url'];
   $url = filter_var($url, FILTER_SANITIZE_STRING);
   


   $add_educ = $conn->prepare("INSERT INTO `portfolio`(id, user_id, title, portfolio_name, url) VALUES(?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $portfolio_name, $url]);

   $message[] = 'New portfolio added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Invention</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

  

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Portfolio</h1>

   <form action="" method="post" enctype="multipart/form-data">
   <p>Title:</p>
      <input type="text" name="title" value="Portfolio" class="box" readonly>
      <br>
      <br>

      <p>URL link: <span>*</span></p>
      <input type="text" name="url" maxlength="100" placeholder="" class="box" required>
      <p>Description: <span>*</span> <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        linkedin, personal website, github etc.</span></i></span></p>
      <input type="text" name="portfolio_name" maxlength="100" placeholder="" class="box" required>
     
     

      <input type="submit" value="Create" name="add_portfolio" class="btn">

   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
