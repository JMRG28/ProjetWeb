<?php
include_once( "Membre.php");
session_start();
$member=unserialize($_SESSION['member']);

?>


<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Toutes les propositions</title>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>

  <link rel='stylesheet' href='https://npmcdn.com/basscss@8.0.0/css/basscss.min.css'>
  <link rel="stylesheet" href="css/style_gallery.css">
  <link rel="stylesheet" href="css/menu.css">
</head>

<body>
 <div class="header">
  <div class="logo">
    <a href="index.html">
      <img src="img/shared/logo.jpg" alt="Logo">
    </a>
  </div>

  <div class="menu">
    <ul>
      <li> <a a href="index.html">Accueil</a></li>
      <li> <a href="choice.php">Poster une proposition</a></li>
      <li><a href="gallery.php">Toutes les propositions</a></li>
      <li> <a a href="parameters.php">Paramètres</a></li>
      <li> <a href="deconnexion.php">Déconnexion</a></li>
      <li><a href="profile.php" >
        <img src=<?php echo $member->Photo;?> alt="Logo" class="monIcon">
      </a></li>
    </ul>

    <script src='https://unpkg.com/vue'></script>
    <script src='https://unpkg.com/axios/dist/axios.min.js'></script>
    <script src='https://use.fontawesome.com/releases/v5.0.4/js/all.js'></script>

  </div>
</div>

</body>
</html>