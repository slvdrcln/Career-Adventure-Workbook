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
   header('location:credentials.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Formal Education</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Formal Education</h1>
   <?php

      $select_formal_educ = $conn->prepare("SELECT * FROM `formal_educ` WHERE id = ? AND user_id = ?");
      $select_formal_educ->execute([$get_id, $user_id]);
      if($select_formal_educ->rowCount() > 0){
         while($fetch_formal_educ = $select_formal_educ->fetch(PDO::FETCH_ASSOC)){
            $formal_educ_id = $fetch_formal_educ['id'];
        
        ?>

   <div class="view" id="link">
   <span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #4472ca;"id="copy-btn"><i class="fa-regular fa-clone"></i><span id="msg"></span></span>
   
      <div class="name">School name</div>
      <p class="description"><?= $fetch_formal_educ['school_name']; ?></p>
      <div class="name">School location</div>
      <p class="description"><?= $fetch_formal_educ['school_location']; ?></p>
      <div class="name">Start date</div>
      <p class="description"><?= $fetch_formal_educ['start_date']; ?></p>
      <div class="name">Graduation date</div>
      <p class="description"><?= $fetch_formal_educ['graduation_date']; ?></p>
      <div class="name">Degree</div>
      <p class="description"><?= $fetch_formal_educ['degree']; ?></p>
      <div class="name">Major(s)</div>
      <p class="description"><?= $fetch_formal_educ['major']; ?></p>
      <div class="name">Minor(s)</div>
      <p class="description"><?= $fetch_formal_educ['minor']; ?></p>
      <div class="name">Overall GPA</div>
      <p class="description"><?= $fetch_formal_educ['overall_gpa']; ?></p>
      <div class="name">Major GPA</div>
      <p class="description"><?= $fetch_formal_educ['major_gpa']; ?></p>
      <div class="name">Relevant coursework or projects</div>
      <p class="description"><?= $fetch_formal_educ['project']; ?></p>
      <div class="name">Group affiliations</div>
      <p class="description"><?= $fetch_formal_educ['groups']; ?></p>
   </div>
   <?php
        }

    } else {
    echo '<p class="empty">no formal education added yet!</p>';
    header('location: credentials.php');
    exit();
    }
      ?>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
<script>

var copybtn = document.getElementById("copy-btn");
   var link = document.getElementById("link");


 copybtn.onclick = function(){
   navigator.clipboard.writeText(link.innerText);
   copybtn.innerText = "Copied";
   setTimeout(() => {
      copybtn.innerText
   }, 2000);
 }
</script>

</body>
</html>