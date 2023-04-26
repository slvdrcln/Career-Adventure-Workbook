<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_creation'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $creation_name = $_POST['creation_name'];
   $creation_name = filter_var($creation_name, FILTER_SANITIZE_STRING);
   $url = $_POST['url'];
   $url = filter_var($url, FILTER_SANITIZE_STRING);
   $published_date = $_POST['published_date'];
   $published_date = filter_var($published_date, FILTER_SANITIZE_STRING);
   $publish_site = $_POST['publish_site'];
   $publish_site = filter_var($publish_site, FILTER_SANITIZE_STRING);
   $publisher = $_POST['publisher'];
   $publisher = filter_var($publisher, FILTER_SANITIZE_STRING);
   $publisher_email = $_POST['publisher_email'];
   $publisher_email = filter_var($publisher_email, FILTER_SANITIZE_STRING);
   $publisher_phone = $_POST['publisher_phone'];
   $publisher_phone = filter_var($publisher_phone, FILTER_SANITIZE_STRING);
   $publisher_web = $_POST['publisher_web'];
   $publisher_web = filter_var($publisher_web, FILTER_SANITIZE_STRING);


   $add_educ = $conn->prepare("INSERT INTO `creation`(id, user_id, title, creation_name, url, published_date, publish_site, publisher, publisher_email, publisher_phone, publisher_web) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $creation_name, $url, $published_date, $publish_site, $publisher, $publisher_email, $publisher_phone, $publisher_web]);

   $message[] = 'New creation & innovation added!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Creation & Innovations</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

  

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Creation & Innovations</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Title:</p>
	<input type="text" name="title" value="Creation & Innovations" class="box" readonly>
     
      <br>
      <br>
      
      <p>Name of creation/innovation:<span>*</span> <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        article, book, song, art, movie, app etc.</span></i></span></p>
      <input type="text" name="creation_name" maxlength="100" placeholder="" class="box" required>
      <p>URL link:</p>
      <input type="text" name="url" maxlength="100" placeholder="" class="box">
      <p>Date published:<span>*</span></p>
      <input onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" name="published_date" maxlength="100" placeholder="" class="box" required>
      <p>Name of publish site: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        where it was published (youtube, twitter, magazine)</span></i></span></p>
      <input type="text" name="publish_site" maxlength="100" placeholder="" class="box">
      <p>Publisher:</p>
      <input type="text" name="publisher" maxlength="100" placeholder="" class="box">
      <p>Publisher's website:</p>
      <input type="text" name="publisher_web" maxlength="100" placeholder="" class="box">
      <p>Publisher's email:</p>
      <input type="text" name="publisher_email" maxlength="100" placeholder="" class="box">
      <p>Publisher's phone: </p>
      <input type="text" name="publisher_phone" maxlength="100" placeholder="" class="box">
     

      <input type="submit" value="Create" name="add_creation" class="btn">

   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
