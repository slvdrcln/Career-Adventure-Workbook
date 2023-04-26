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
   $situation = $_POST['situation'];
   $situation = filter_var($situation, FILTER_SANITIZE_STRING);
   
   $think = $_POST['think'];
   $think = filter_var($think, FILTER_SANITIZE_STRING);

   $action = $_POST['action'];
   $action = filter_var($action, FILTER_SANITIZE_STRING);   

   $result = $_POST['result'];
   $result = filter_var($result, FILTER_SANITIZE_STRING);
   $evidence = $_POST['evidence'];
   $evidence = filter_var($evidence, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $add_stories = $conn->prepare("INSERT INTO `stories`(id, user_id, title, situation, think, action, result, evidence, status) VALUES(?,?,?,?,?,?,?,?,?)");
   $add_stories->execute([$id, $user_id, $title, $situation, $think, $action, $result, $evidence, $status]);

   $message[] = 'New story added!';  

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create your own story</title>

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

   <h1 class="heading">You can add up to 15 more STAR stories</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Story <span>*</span></p>
   <select name="status" class="box" required>
         <option value="Accomplishment">Accomplishment</option>
         <option value="Improvement">Improvement</option>
         <option value="Lesson Learned">Lesson Learned</option>
         <option value="Interpersonal Skill">Interpersonal Skill</option>
         <option value="Technical Skill">Technical Skill</option>
         <option value="Obstacle">Obstacle</option>
      </select>
      <br> <br>
      <p>Story Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="title" class="box">
      <p>What was the <b style="color: black;">S</b>ituation? Who, what, why, how, when, where, and to what degree? Be clear about the size and scope of the obstacle that you faced.<span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        date, job title, company, what was happening</span></i></span></p>
      <textarea name="situation" class="box" required placeholder="write something..." maxlength="1000" cols="30" rows="10"></textarea>
      <p>What did you <b style="color: black;">T</b>hink when the challenge was first presented to you? <span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        your assessment, idea(s), & why this idea</span></i></span></p>
      <textarea name="think" class="box" required placeholder="write something..." maxlength="1000" cols="30" rows="10"></textarea>

      <p>What <b style="color: black;">A</b>ctions did you take? List the steps in order and what your role was in each step. <span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        from start to end — all the steps you took, also others' actions</span></i></span></p>
      <textarea name="action" class="box" required placeholder="write something..." maxlength="1000" cols="30" rows="10"></textarea>
      <p>What were the final <b style="color: black;">R</b>esults? Include numbers, statistics, and other measurable facts. Be clear about the lessons learned - and how you have applied those lessons elsewhere (as evidence that you won't just repeat the mistakes in this job).
<span>*</span><span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        actual outcomes, desired results, include measures and quotes</span></i></span></p>
      <textarea name="result" class="box" required placeholder="write something..." maxlength="1000" cols="30" rows="10"></textarea>
      <p>Evidence</p>
      <input type="text" name="evidence" maxlength="100" placeholder="URL to proof of accomplishment" class="box">
      <input type="submit" value="Create story" name="submit" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>