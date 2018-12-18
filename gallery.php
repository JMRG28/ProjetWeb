<?php
include 'Bien.php' ;
include 'header.php';
include 'bd.php';

function conversion($d){
  $nd=explode("/",$d);
  $r=[];
  array_push($r, $nd[2], $nd[1],$nd[0]);
  $res=implode("-",$r);
  return $res;
}

ini_set("display_errors",1);error_reporting(E_ALL);
$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$biens=[];
if(isset($_POST["cat"])){
  //WARNING
  foreach($bd->query("select * from BIEN,CATEGORIE where Categorie=ID_Categorie and (ID_Categorie='".$_POST['cat']."' or SuperCategorie='".$_POST['cat']."')") as $row ){
    $bien=new Bien($row["ID_Bien"],$row["Descriptif"],$row["Photo"],$row["PrixNeuf"],$row["Actif"],$row["DateDebut"],$row["EmailProp"],$row["Titre"],$row["URL"],$row["Categorie"],$row["DateFin"]);
    //  $bien->createFromTab($row);
    array_push($biens, $bien);
  }
}else{
  foreach($bd->query("select * from BIEN") as $row ){
    $bien=new Bien($row["ID_Bien"],$row["Descriptif"],$row["Photo"],$row["PrixNeuf"],$row["Actif"],$row["DateDebut"],$row["EmailProp"],$row["Titre"],$row["URL"],$row["Categorie"],$row["DateFin"]);
    //$bien->createFromTab($row);
    array_push($biens, $bien);
  }
}

?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Toutes les propositions</title>
  <!-- /<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'> -->
  <!--
  <link rel='stylesheet' href='https://npmcdn.com/basscss@8.0.0/css/basscss.min.css'>
  <link rel="stylesheet" href="css/style_gallery.css">
  <link rel="stylesheet" href="css/menu.css"> -->
  <style>
  .one {
    font-family:arial;
    font-weight:bold;
  }
  </style>
</head>

<body>
  <div class="toolbar mb2 mt2">
    <button class="btn fil-cat" href="" data-rel="all">All</button>
    <button class="btn fil-cat" data-rel="biens">Biens</button>
    <button class="btn fil-cat" data-rel="services">Services</button>

    <div class="tab-pane" id="search">
      <h2></h2>
      <hr>
      <form method="post" > <!-- action="traitement.php"> -->
        <label for="categories">Choisissez la catégorie</label><br/>
        <select name="cat" id="cat">

          <?php
          foreach($bd->query('SELECT * FROM CATEGORIE where SuperCategorie IS NULL') as $row ){
            echo  "<option class='one' value=".$row["ID_Categorie"].">".$row["Nom"]."</option>";
            foreach($bd->query('SELECT * FROM CATEGORIE where SuperCategorie="'.$row["ID_Categorie"].'"') as $row2){
              echo  "<option value=".$row2["ID_Categorie"].">".$row2["Nom"]."</option>";
            }
          }

          ?>

        </select>
        <button > Valider</button>

      </form>



    </div>
    <div id="portfolio" class="wrap">
      <?php

      foreach($biens as $i){
        $i->affiche();
      }
      ?>
    </div>

    <div style="clear:both;"></div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script  src="js/js_gallery.js"></script>

  </body>

  </html>
