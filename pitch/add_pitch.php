<?php

include '../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);

   $step_one = $_POST['step_one'];
   $step_one = filter_var($step_one, FILTER_SANITIZE_STRING);

   $step_two_one = $_POST['step_two_one'];
   $step_two_one = filter_var($step_two_one, FILTER_SANITIZE_STRING); 
   $step_two_two = $_POST['step_two_two'];
   $step_two_two = filter_var($step_two_two, FILTER_SANITIZE_STRING);

   $step_three_one = $_POST['step_three_one'];
   $step_three_one = filter_var($step_three_one, FILTER_SANITIZE_STRING);
   $step_three_two = $_POST['step_three_two'];
   $step_three_two = filter_var($step_three_two, FILTER_SANITIZE_STRING);   
   $step_three_three = $_POST['step_three_three'];
   $step_three_three = filter_var($step_three_three, FILTER_SANITIZE_STRING);

   $step_four = $_POST['step_four'];
   $step_four = filter_var($step_four, FILTER_SANITIZE_STRING);
   



   $add_pitch = $conn->prepare("INSERT INTO `pitch`(id, user_id, title, step_one, step_two_one, step_two_two, step_three_one, step_three_two, step_three_three, step_four) VALUES(?,?,?,?,?,?,?,?,?,?)");
   $add_pitch->execute([$id, $user_id, $title, $step_one, $step_two_one, $step_two_two, $step_three_one, $step_three_two, $step_three_three, $step_four]);


   $message[] = 'New Elevator Pitch added!';  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Elevator pitch</title>

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

   <h1 class="heading">Elevator Pitch</h1>

   <form action="" method="post" enctype="multipart/form-data">

      <p>Title:</p>
      <select name="title" class="box" required>
      <option value="" selected disabled>-- select number of pitch</option>
         <option value="Elevator Pitch #1">Elevator Pitch #1</option>
         <option value="Elevator Pitch #2">Elevator Pitch #2</option>
         <option value="Elevator Pitch #3">Elevator Pitch #3</option>
         <option value="Elevator Pitch #4">Elevator Pitch #4</option>
         <option value="Elevator Pitch #5">Elevator Pitch #5</option>
      </select>
      <br>
      <p>Share your <b style="color: black;">STAR</b> stories with other people via email and ask them for their reaction or what the stories tell them about you.<span>*</span></p>
      <textarea name="step_one" class="textArea" required placeholder="copy-paste their response here..." maxlength="1000" cols="50" rows="10"></textarea>
      <p>Word Cloud<span>*</span></p>
      <p style="text-indent: 1rem;">STAR stories word cloud <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">image of word cloud based on all STAR Stories</span></i></span></p>
      <input type="text" name="step_two_one" maxlength="300" placeholder="" class="box">
<p style="text-indent: 1rem;">Story Reaction word cloud <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">image of word cloud based on the big reaction text above</span></i></span></p>
      <input type="text" name="step_two_two" maxlength="100" placeholder="" class="box">
      <p>Observations<span>*</span></p>
      <textarea name="step_three_one" class="box" required placeholder="What you do exceptionally well..." maxlength="1000" cols="30" rows="10"></textarea>
      <textarea name="step_three_two" class="box" required placeholder="Why people like you..." maxlength="1000" cols="30" rows="10"></textarea>
      <textarea name="step_three_three" class="box" required placeholder="Your key experiences (jobs, industries)..." maxlength="1000" cols="30" rows="10"></textarea>
      <p>Streamline and Practice<span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        can be said aloud in about ten (10) seconds, captures attention and is interesting, listener wants to know more, said with excitement or passion, is 100% true</span></i></span></p>
      <textarea name="step_four" class="box" required placeholder="Type your elevator pitch here..." maxlength="1000" cols="30" rows="10"></textarea>     



      <input type="submit" value="Create pitch" name="submit" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>