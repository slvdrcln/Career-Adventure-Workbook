<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header" id="PrintButton">

   <section class="flex">
      <a href="../admin/dashboard.php" class="logo">Career Adventure</a>

      <form action="../admin/search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="Search" required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['email']; ?></span>
         <a href="../admin/profile.php" class="btn"><i class="fa-solid fa-eye"></i> view profile</a>
         <div class="flex-btn">
            <a href="/index.php" class="option-btn"><i class="fa-solid fa-right-to-bracket"></i><br>login</a>
            <a href="/index.php" class="option-btn"><i class="fa-solid fa-user-plus"></i> register</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn"><i class="fa-solid fa-arrow-left"></i> logout</a>
         <?php
            }else{
         ?>
         <h3>please login or register</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="/index.php" class="option-btn">register</a>
         </div>
         <?php
            }
         ?>
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <!-- <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt=""> -->
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['email']; ?></span>
         <a href="../admin/profile.php" class="btn"><i class="fa-solid fa-eye"></i> view profile</a>
         <?php
            }else{
         ?>
         <h3>please login or register</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="/index.php" class="option-btn">register</a>
         </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
   <a href="../admin/dashboard.php"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="../admin/stories.php"><i class="fa-solid fa-book"></i><span>STAR Stories</span></a>
      <a href="../admin/elevator_pitch.php"><i class="fa-sharp fa-solid fa-comments"></i><span>Career Adventure Summary</span></a>
      <a href="../admin/history.php"><i class="fa-solid fa-paperclip"></i><span>Career Adventure History</span></a>
      <a href="../admin/credentials.php"><i class="fa-solid fa-trophy"></i><span>Credentials</span></a>
      <a href="../admin/skills_preference.php"><i class="fa-solid fa-shield-halved"></i><span>Skills & Preferences</span></a>
      <a href="../admin/message.php"><i class="fa-solid fa-globe"></i><span>Networking</span></a>
      <a href="../print/print_docs.php"><i class="fa-solid fa-scroll"></i><span>Print documents</span></a>
      <a href="../admin/target_companies.php"><i class="fa-solid fa-bullseye"></i><span>Target Companies</span></a>
      <a href="../components/admin_logout.php" method="post" name="logout" onclick="return confirm('Logout from this website?');"><i class="fa-solid fa-arrow-left"></i><span>Logout</span></a>
   </nav>

</div>

<!-- side bar section ends -->