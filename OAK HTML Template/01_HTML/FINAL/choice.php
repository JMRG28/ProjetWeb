<?php

function conversion($d){
  $nd=explode("/",$d);
  $r=[];
  array_push($r, $nd[2], $nd[1],$nd[0]);
  $res=implode("-",$r);
  return $res;
}

ini_set("display_errors",1);error_reporting(E_ALL);

if(isset($_POST["valeur"])){
	if($_POST["valeur"]=="service"){
		header('Location: service.php');
	}
	if($_POST["valeur"]=="bien"){
		header('Location: bien.php');
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
    <title>Le bon voisin</title>

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
          <li> <a href="choice.php">Poster une proposition</a></li>
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
                    <h2 class="title">Que souhaitez-vous proposer ?</h2>
                    <form method="POST">
                        <div class="row row-space">
                        
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label"></label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Un bien
                                            <input type="radio" checked="checked" name="valeur" value="bien">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Un service
                                            <input type="radio" name="valeur" value="service">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
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
