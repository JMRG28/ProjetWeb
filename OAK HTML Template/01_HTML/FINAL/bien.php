<?php
include 'Bien.php' ;
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
if(isset($_POST['titre'])){ // à améliorer
  $servername = "86.210.13.52";
  $port="3307";
  $username = "jmr";
  $password = "BaseDonnees1234";
  $dbname = "jmr";



  try {


    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo $_POST['email']."<br>".md5($_POST['mdp'])."<br>".$_POST['nom']."<br>".$_POST['prenom']."<br>".$_POST['code_p']."<br>".$_POST['num_tel']."<br>".null."<br>".null."<br>".null."<br>".null."<br>".$_POST['sexe']."<br>". $_POST['statut']."<br>".conversion($_POST['date_n'])."<br>";

    $query=$bd->prepare('SELECT COUNT(*)  FROM BIEN');
    $query->execute();
    $result=$query->fetch();
    $id=$result[0]+1;


    //$prix=floatval($_POST['prixNeuf']);
    $bien=new Bien($id, $_POST['descriptif'],null, $_POST['prixNeuf'], 1, 1,null,$member->Email,  $_POST['titre'],md5($id));
    $bien->insert($bd);
    //echo $_FILES["fileToUpload"]["name"]);
    print_r($_FILES);
    $bien->upload();
    ($bien->Prop)->
    echo "Successfully added the new good " . $id;
  } catch (PDOException $e) {
    echo "DataBase Error: The good could not be added.<br>".$e->getMessage();
  } catch (Exception $e) {
    echo "General Error: The good could not be added.<br>".$e->getMessage();
  }finally{
    $bd=null;
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Le Bon Voisin</title>

    <!-- Icons font CSS-->
    <link href="js/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="js/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="js/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="js/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
     <link rel="stylesheet" href="css/menu.css">
    <link href="css/style_register.css" rel="stylesheet" media="all">

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
          <li> <a href="bien.php">Poster une proposition</a></li>
          <li><a href="gallery.php">Toutes les propositions</a></li>
         <li> <a a href="parameters.php">Paramètres</a></li>
       </ul>

<script src='https://unpkg.com/vue'></script>
<script src='https://unpkg.com/axios/dist/axios.min.js'></script>
<script src='https://use.fontawesome.com/releases/v5.0.4/js/all.js'></script>


        </div>
    </div>


    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title"> Proposition d'un bien</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Titre</label>
                                    <input class="input--style-4" type="text" name="titre">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Descriptif</label>
                                    <input class="input--style-4" type="text" name="descriptif">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Prix Neuf</label>
                                    <input class="input--style-4" type="numeric" name="prixNeuf">
                                </div>
                            </div>

                             <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Photo </label>
                                    <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
									      <input type="file" name="fileToUpload" id="fileToUpload">
									      <!-- </form> -->
                                </div>
                            </div>


                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Date de mise en service</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="date_n">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Sexe</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Homme
                                            <input type="radio" checked="checked" name="sexe" value="H">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Femme
                                            <input type="radio" name="sexe" value="H">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="label">Statut</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="statut">

                                    <option selected="selected">Particulier</option>
                                    <option>Auto-entrepreneur Independant</option>
                                    <option>Artisan Commerçant</option>
                                    <option>Association à but non lucratif</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="js/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="js/vendor/select2/select2.min.js"></script>
    <script src="js/vendor/datepicker/moment.min.js"></script>
    <script src="js/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
