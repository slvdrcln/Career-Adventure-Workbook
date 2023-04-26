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
   $pref_place_one = $_POST['pref_place_one'];
   $pref_place_one = filter_var($pref_place_one, FILTER_SANITIZE_STRING);

    $pref_place_two = $_POST['pref_place_two'];
    $pref_place_two = filter_var($pref_place_two, FILTER_SANITIZE_STRING);

    $pref_place_three = $_POST['pref_place_three'];
    $pref_place_three = filter_var($pref_place_three, FILTER_SANITIZE_STRING);

    $pref_place_four = $_POST['pref_place_four'];
    $pref_place_four = filter_var($pref_place_four, FILTER_SANITIZE_STRING);

    $pref_place_five = $_POST['pref_place_five'];
    $pref_place_five = filter_var($pref_place_five, FILTER_SANITIZE_STRING);
    $days = $_POST['days'];
    $days = filter_var($days, FILTER_SANITIZE_STRING);

    $hours = $_POST['hours'];
    $hours = filter_var($hours, FILTER_SANITIZE_STRING);

    $update_mustHave = $conn->prepare("UPDATE `preference` SET pref_place_one = ?, pref_place_two = ?, pref_place_three = ?, pref_place_four = ?, pref_place_five = ?, days = ?, hours = ? WHERE id = ?");
    $update_mustHave->execute([$pref_place_one, $pref_place_two, $pref_place_three, $pref_place_four, $pref_place_five, $days, $hours, $get_id]);

   $message[] = 'Preferences updated!';  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Skills</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">


</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

<h1 class="heading">Update skills</h1>

<?php
         $select_pref = $conn->prepare("SELECT * FROM `preference` WHERE id = ?");
         $select_pref->execute([$get_id]);
         if($select_pref->rowCount() > 0){
         while($fetch_pref = $select_pref->fetch(PDO::FETCH_ASSOC)){
            $pref_id = $fetch_pref['id'];
      ?>
<form action="" method="post" enctype="multipart/form-data">
<select name="title" class="box" hidden required value="<?= $fetch_pref['title']; ?>">
      <option value="Preferred working hour & days" selected>Days of week</option>
   </select>

   <p>Preferred place(s) to live and work: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
     list the cities/states/countries where you want to live and work and/or include “remote”</span></i></span></p>
   <input type="text" name="pref_place_one" class="box" value="<?= $fetch_pref['pref_place_one']; ?>">
<input type="text" name="pref_place_two" class="box" value="<?= $fetch_pref['pref_place_two']; ?>">
<input type="text" name="pref_place_three" class="box" value="<?= $fetch_pref['pref_place_three']; ?>">
<input type="text" name="pref_place_four" class="box" value="<?= $fetch_pref['pref_place_four']; ?>">
<input type="text" name="pref_place_five" class="box" value="<?= $fetch_pref['pref_place_five']; ?>" >
   <p>Preferred working days:</p>      
   <input type="text" name="days" class="box" value="<?= $fetch_pref['days']; ?>">


   <p>Preferred working hours:</p>
   <input type="text" name="hours" class="box" value="<?= $fetch_pref['hours']; ?>">
         

      <input type="submit" value="Create" name="submit" class="btn">
   </form>
<?php
      } 
   }else{
      echo '<p class="empty">no preference added yet!</p>';
   }
   ?>
</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
