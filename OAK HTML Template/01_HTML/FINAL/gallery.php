<?php
include 'Bien.php' ;
include 'Membre.php';
session_start();
$member=unserialize($_SESSION['member']);
$member->toString();

function conversion($d){
  $nd=explode("/",$d);
  $r=[];
  array_push($r, $nd[2], $nd[1],$nd[0]);
  $res=implode("-",$r);
  return $res;
}

ini_set("display_errors",1);error_reporting(E_ALL);
// à améliorer
  $servername = "86.210.13.52";
  $port="3307";
  $username = "jmr";
  $password = "BaseDonnees1234";
  $dbname = "jmr";

  try {
    

    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo $_POST['email']."<br>".md5($_POST['mdp'])."<br>".$_POST['nom']."<br>".$_POST['prenom']."<br>".$_POST['code_p']."<br>".$_POST['num_tel']."<br>".null."<br>".null."<br>".null."<br>".null."<br>".$_POST['sexe']."<br>". $_POST['statut']."<br>".conversion($_POST['date_n'])."<br>";


    $biens=[];
    $bien=new Bien(null,null,null,null,null,null,null,null,null);


    foreach($bd->query('SELECT * FROM BIEN') as $row ){
      //print_r($row);
    $bien->createFromTab($row);
    array_push($biens, $bien);
    }
   
  }finally{
    $bd=null;
  }

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
          <li> <a href="demande.html">Poster une proposition</a></li>
          <li><a href="propositions.html">Toutes les propositions</a></li>
         <li> <a a href="parameters.html">Paramètres</a></li>
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
 
<div id="portfolio">

  <?php 
    foreach($biens as $i){
      $i->affiche();
    }

  ?>
  <!-- 
  <div class="tile scale-anm web all">
        <a href="aff_bien.php"> <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/2-mon_1092-300x234.jpg" alt="" /></a>
  </div>
  <div class="tile scale-anm bcards all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/jti-icons_08-300x172.jpg" alt="" />
  </div>
  <div class="tile scale-anm web all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/emi_haze-300x201.jpg" alt="" />
  </div>
  <div class="tile scale-anm web all">
            <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/codystretch-300x270.jpg" alt="" />
  </div>
  <div class="tile scale-anm flyers all">
        <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97190&w=350&h=190" alt="" />
  </div>
  <div class="tile scale-anm bcards all">
            <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" />
  </div>
  <div class="tile scale-anm flyers all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/jti-icons_08-300x172.jpg" alt="" />
  </div>
  <div class="tile scale-anm flyers all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/transmission_01-300x300.jpg" alt="" />
  </div>
  <div class="tile scale-anm web all">
        <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" />
  </div>
  <div class="tile scale-anm flyers all">
           <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" /> 
  </div>
  <div class="tile scale-anm web all">
        <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/the-ninetys-brand_02-300x300.jpg" alt="" />
  </div>
  <div class="tile scale-anm bcards all">
            <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/15-dia_1092-1-300x300.jpg" alt="" />
  </div>
  <div class="tile scale-anm web all">
       <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97190&w=350&h=190" alt="" /> 
  </div>
  <div class="tile scale-anm bcards all">
          <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/emi_haze-300x201.jpg" alt="" />  
  </div>
  <div class="tile scale-anm web all">
            <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/transmission_01-300x300.jpg" alt="" />
  </div> 
  <div class="tile scale-anm web all">
      <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97190&w=350&h=190" alt="" />  
  </div> 
  <div class="tile scale-anm bcards all">     
            <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" />
  </div>
-->
</div>

<div style="clear:both;"></div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

  

    <script  src="js/js_gallery.js"></script>




</body>

</html>
