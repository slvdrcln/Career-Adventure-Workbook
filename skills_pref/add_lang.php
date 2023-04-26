<?php
include'../components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:/index.php');
}

if(isset($_POST['add_lang'])){

	$id = unique_id();
	$languages = $_POST['languages'];

$stmt = $conn->prepare('INSERT INTO languages (id, user_id, languages) VALUES (?,?,?)');
foreach ($languages as $lang) {
    $stmt->execute([$id, $user_id, $lang]);
	$message[] = 'Spoken language added!';
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Spoken Language</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
   <link rel="stylesheet" href="../src/css/multi-select-tag.css">
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

   <h1 class="heading">Spoken Language</h1>
<form action="" method="post" enctype="multipart/form-data">
<p>Spoken languages: <span class="info"><i class="fa-sharp fa-solid fa-circle-info"></i> <span class="extra-info">
        programming languages should be listed under Skills</span></i></span></p>
	<select name="languages[]" id="languages" multiple class="box" required>

          <option value="Mandarin">Chinese, Mandarin</option>
          <option value="Spanish">Spanish</option>
          <option value="English">English</option>           
          <option value="Bengali">Bengali</option>
          <option value="Hindi">Hindi</option>
          <option value="Portuguese">Portuguese</option>
          <option value="Russian">Russian</option>
          <option value="Japanese">Japanese</option>
          <option value="German">German, Standard</option>
          <option value="Wu">Chinese, Wu</option>
          <option value="Javanese">Javanese</option>
          <option value="Korean">Korean</option>
          <option value="French">French</option>
          <option value="Vietnamese">Vietnamese</option>
          <option value="Telugu">Telugu</option>
          <option value="Chinese, Yue">Chinese, Yue</option>
          <option value="Marathi">Marathi</option>
          <option value="Tamil">Tamil</option>
          <option value="Turkish">Turkish</option>
          <option value="Urdu">Urdu</option>
          <option value="Min nan">Chinese, Min nan</option>
          <option value="Chinese, Jinyu">Chinese, Jinyu</option>
          <option value="Gujarati">Gujarati</option>
          <option value="Polish">Polish</option>
          <option value="Arabic">Arabic, Egypytian Spoken</option>
          <option value="Ukrainian">Ukrainian</option>
          <option value="Italian">Italian</option>
          <option value="Chinese, Xiang">Chinese, Xiang</option>
          <option value="Mayalayam">Mayalayam</option>
          <option value="Chinese, Hakka">Chinese, Hakka</option>
          <option value="Kannada">Kannada</option>
          <option value="Oriya">Oriya</option>
          <option value="Panjabi, Eastern">Panjabi, Eastern</option>
          <option value="Romanian">Romanian</option>
          <option value="Bhojpuri">Bhojpuri</option>
          <option value="Azerbaijani, South">Azerbaijani, South</option>
          <option value="Farsi, Western">Farsi, Western</option>
          <option value="Maithili">Maithili</option>
          <option value="Hausa">Hausa</option>
          <option value="Arabic, Algerian spoken">Arabic, Algerian spoken</option>
          <option value="Burmese">Burmese</option>
          <option value="Serbo-croatian">Serbo-croatian</option>
          <option value="Chinese, Gan">Chinese, Gan</option>
          <option value="Awadhi">Awadhi</option>
          <option value="Thai">Thai</option>
          <option value="Dutch">Dutch</option>
          <option value="Yoruba">Yoruba</option>
          <option value="Sindhi">Sindhi</option>
          <option value="Arabic, Moroccan spoken">Arabic, Moroccan spoken</option>
          <option value="Arabic, Saidi spoken">Arabic, Saidi spoken</option>
          <option value="Uzbek, Northern">Uzbek, Northern</option>
          <option value="Malay">Malay</option>
          <option value="Amharic">Amharic</option>
          <option value="Indonesian">Indonesian</option>
          <option value="Igbo">Igbo</option>
          <option value="Tagalog">Tagalog</option>
          <option value="Nepali">Nepali</option>
          <option value="Arabic, Sudanese spoken">Arabic, Sudanese spoken</option>
          <option value="Thai, Northeastern">Thai, Northeastern</option>
          <option value="Assamese">Assamese</option>
          <option value="Hungarian">Hungarian</option>
          <option value="Chittagonian">Chittagonian</option>
          <option value="Arabic, Mesopotamia spoken">Arabic, Mesopotamia spoken</option>
          <option value="Madura">Madura</option>
          <option value="Sinhala">Sinhala</option>
          <option value="Haryanvi">Haryanvi</option>
          <option value="Marwari">Marwari</option>
          <option value="Czech">Czech</option>
          <option value="Greek">Greek</option>
          <option value="Magahi">Magahi</option>
          <option value="Chhattisgarhi">Chhattisgarhi</option>
          <option value="Deccan">Deccan</option>
          <option value="Chinese, Min bei">Chinese, Min bei</option>
          <option value="Belarusan">Belarusan</option>
          <option value="Zhuang, Northern">Zhuang, Northern</option>
          <option value="Arabic, Najdi spoken">Arabic, Najdi spoken</option>
          <option value="Pashto, Northern">Pashto, Northern</option>
          <option value="Somali">Somali</option>
          <option value="Malagasy">Malagasy</option>
          <option value="Arabic, Tunisian spoken">Arabic, Tunisian spoken</option>
          <option value="Rwanda">Rwanda</option>
          <option value="Zulu">Zulu</option>
          <option value="Bulgarian">Bulgarian</option>
          <option value="Swedish">Swedish</option>
          <option value="Lombard">Lombard</option>
          <option value="Oromo, West-central">Oromo, West-central</option>
          <option value="Pashto, Southern">Pashto, Southern</option>
          <option value="Kazakh">Kazakh</option>
          <option value="Ilocano">Ilocano</option>
          <option value="Tatar">Tatar</option>
          <option value="Fulfulde, Nigerian">Fulfulde, Nigerian</option>
          <option value="Arabic, Sanaani spoken">Arabic, Sanaani spoken</option>
          <option value="Uyghur">Uyghur</option>
          <option value="Haitian creole french">Haitian creole french</option>
          <option value="Azerbaijani, North">Azerbaijani, North</option>
          <option value="Napoletano-calabrese">Napoletano-calabrese</option>
          <option value="Khmer, Central">Khmer, Central</option>
          <option value="Farsi, Eastern">Farsi, Eastern</option>
          <option value="Akan">Akan</option>
          <option value="Hiligaynon">Hiligaynon</option>
          <option value="Kurmanji">Kurmanji</option>
          <option value="Shona">Shona</option>
 
 
          </select>
<input type="submit" value="Create" name="add_lang" class="btn">
</form>



   
</section>
<br><br><br><br><br><br><br><br><br><br>














<?php include '../components/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
  <script>
      new MultiSelectTag('languages')  // id
  </script>
  

<script src="../js/admin_script.js"></script>

</body>
</html>