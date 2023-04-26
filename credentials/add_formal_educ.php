<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_educ'])){
 
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $school_name = $_POST['school_name'];
   $school_name = filter_var($school_name, FILTER_SANITIZE_STRING);
   $school_location = $_POST['school_location'];
   $school_location = filter_var($school_location, FILTER_SANITIZE_STRING);
   $start_date = $_POST['start_date'];
   $start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
   $graduation_date = $_POST['graduation_date'];
   $graduation_date = filter_var($graduation_date, FILTER_SANITIZE_STRING);
   $degree = $_POST['degree'];
   $degree = filter_var($degree, FILTER_SANITIZE_STRING);
   $major = $_POST['major'];
   $major = filter_var($major, FILTER_SANITIZE_STRING);
   $minor = $_POST['minor'];
   $minor = filter_var($minor, FILTER_SANITIZE_STRING);
   $overall_gpa = $_POST['overall_gpa'];
   $overall_gpa = filter_var($overall_gpa, FILTER_SANITIZE_STRING);
   $major_gpa = $_POST['major_gpa'];
   $major_gpa = filter_var($major_gpa, FILTER_SANITIZE_STRING);
   $project = $_POST['project'];
   $project = filter_var($project, FILTER_SANITIZE_STRING);
   $groups = $_POST['groups'];
   $groups = filter_var($groups, FILTER_SANITIZE_STRING);

   $add_educ = $conn->prepare("INSERT INTO `formal_educ`(id, user_id, title, school_name, school_location, start_date, graduation_date, degree, major, minor, overall_gpa, major_gpa, project, groups) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
   $add_educ->execute([$id, $user_id, $title, $school_name, $school_location, $start_date, $graduation_date, $degree, $major, $minor, $overall_gpa, $major_gpa, $project, $groups]);

   $message[] = 'New formal education added!';  
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

   <h1 class="heading">Formal Education</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Title:</p>
      <input type="text" name="title" value="Formal Education" class="box" readonly>
      <br>
      <br>
      
      <p>Name of school:</p>
      <input type="text" name="school_name" maxlength="100" placeholder="" class="box">
      <p>Location:</p>
      <input type="text" name="school_location" maxlength="100" placeholder="" class="box">
      <p>Start date:</p>
	 <input onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" name="start_date" maxlength="100" class="box" required>  
      <p>Graduation date: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        enter your graduation date or either “current student” if currently enrolled or “did not graduate” if not currently enrolled</span></i></span></p>
      <input type="text" name="graduation_date" maxlength="100" placeholder="" class="box"> 
      <p>Degree/Diploma received:</p>
      <input type="text" name="degree" maxlength="100" placeholder="" class="box">
      <p>Major(s):</p>
      <input type="text" name="major" maxlength="100" placeholder="" class="box">
      <p>Minor(s):</p>
      <input type="text" name="minor" maxlength="100" placeholder="" class="box">
      <p>Overall GPA:</p>
      <input type="text" name="overall_gpa" maxlength="100" placeholder="" class="box">
      <p>Major GPA:</p>
      <input type="text" name="major_gpa" maxlength="100" placeholder="" class="box">
      <p>Relevant coursework or projects:</p>
      <input type="text" name="project" maxlength="100" placeholder="" class="box">
      <p>Group affiliations: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        honor roll, athletics, fraternity/sorority, etc.</span></i></span></p>
      <input type="text" name="groups" maxlength="100" placeholder="" class="box">

      <input type="submit" value="Create" name="add_educ" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
