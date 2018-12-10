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
    </ul>

    <script src='https://unpkg.com/vue'></script>
    <script src='https://unpkg.com/axios/dist/axios.min.js'></script>
    <script src='https://use.fontawesome.com/releases/v5.0.4/js/all.js'></script>

  </div>
</div>
<div class="toolbar mb2 mt2">
  <button class="btn fil-cat" href="" data-rel="all">All</button>
  <button class="btn fil-cat" data-rel="biens">Biens</button>
  <button class="btn fil-cat" data-rel="services">Services</button>
</div>
</body>
</html>