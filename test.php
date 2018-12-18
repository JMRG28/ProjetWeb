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
    <meta charset="utf-8">
    <title>Propositions</title>
    <meta name="description" content="">
    <meta name="msapplication-tap-highlight" content="yes" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />

    <!-- Google Web Font -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lekton:400,700,400italic' rel='stylesheet' type='text/css'>

    <!--  Bootstrap 3-->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- OWL Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">

    <!--  Slider -->
    <link rel="stylesheet" href="css/jquery.kenburnsy.css">

    <!-- Animate -->
    <link rel="stylesheet" href="css/animate.css">

    <!-- Web Icons Font -->
    <link rel="stylesheet" href="css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="css/iconmoon.css">
    <link rel="stylesheet" href="css/et-line.css">
    <link rel="stylesheet" href="css/ionicons.css">

    <!-- Magnific PopUp -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Tabs -->
    <link rel="stylesheet" type="text/css" href="css/tabs.css" />
    <link rel="stylesheet" type="text/css" href="css/tabstyles.css" />

    <!-- Loader Style -->
    <link rel="stylesheet" href="css/loader-1.css">

    <!-- Costum Styles -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="favicon.ico">

    <!-- Modernizer & Respond js -->
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
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
      

<div class="container margin-top">
        <div class="portfolio-wrapper">
            
            
            <div class="js-masonry">
                <div class="row" id="work-grid">
                    <!-- Begin of Thumbs Portfolio -->
                    <div class="col-md-4 col-sm-4 col-xs-12 ">
                      <div class="tile scale-anm biens all">
                        <div class="img home-portfolio-image">
                            <img src="uploads/fer.jpg" alt="Portfolio Item">
                            <div class="overlay-thumb">
                                <a href="javascript:void(0)" class="like-product">
                                    <i class="ion-ios-heart-outline"></i>
                                    <span class="like-product">Liked</span>
                                    <span class="output">250</span>
                                </a>
                                <div class="details">
                                    <span class="title">STYLE FASHION</span>
                                    <span class="info">NEW BAG & STYLE FASHION</span>
                                </div>
                                <span class="btnBefore"></span>
                                <span class="btnAfter"></span>
                                <a class="main-portfolio-link" href="single-project.html"></a>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="load-more">
                <a href="javascript:void(0)" id="load-more"><i class="icon-refresh"></i></a>
            </div>
        </div>
    </div>






    </div>

    <div style="clear:both;"></div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script  src="js/js_gallery.js"></script>

  </body>

  </html>
