<?php
include "Membre.php";
include "Bien.php";


session_start();
if (!isset($_SESSION['member'])){
  header('Location: login2.php');
}
$member=unserialize($_SESSION['member']);
$member->toString();


$callback=false; 
$callback_B=false; 
$member=unserialize($_SESSION['member']); 
$member->toString(); 
function updateDB($v,$k){ 
  $servername = "86.210.13.52"; 
  $port="3307"; $username = "jmr"; 
  $password = "BaseDonnees1234"; 
  $dbname = "jmr"; 
  $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
  $member=unserialize($_SESSION['member']);
   //$member->toString(); 
   $member->update($bd,$v,$k); 
   $member->$v=$k ; 
   $_SESSION['member']=serialize($member);
    //header('Location: parameters.php'); 
 } 

 function updateDB_Bien($id,$v,$k){ 
  $servername = "86.210.13.52"; 
  $port="3307"; $username = "jmr"; 
  $password = "BaseDonnees1234"; 
  $dbname = "jmr"; 
  $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  $row=$bd->query("SELECT * FROM BIEN WHERE ID_Bien='".$_POST["bien"]."'");
  $bien=new Bien($row[0], $row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9]); 
  $bien->update($bd,$v,$k); 
  $member->$v=$k ; 
 } 
/*
 if(isset($_POST["enregistrer_B"] && isset($_POST["bien"])){ 
  if($_POST["titre_B"]!=""){ 
    updateDB_Bien($_POST["bien"],"Titre",$_POST["titre_B"]);
     $callback_B=true; 
  } 
}
*/

if(isset($_POST["enregistrer"])){ 
  if($_POST["first_name"]!=""){ 
    updateDB("Prenom",$_POST["first_name"]);
     $callback=true; 
  } 
  if($_POST["last_name"]!=""){
    updateDB("Nom",$_POST["last_name"]); 
    $callback=true;
  } 
  if($_POST["mobile"]!=""){ 
    updateDB("NumeroTel",$_POST["mobile"]);
    $callback=true; 
  } 
  if($_POST["codeP"]!=""){ 
    updateDB("CodePostal",$_POST["codeP"]); 
    $callback=true; 
  } 
  if($_POST["description"]!=""){ 
    updateDB("Description",$_POST["description"]); 
    $callback=true; } 
  if($callback){ 
    header('Location: parameters.php'); 
  } 
}

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <title>Paramètres</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/menu.css">
</head>


<hr>

  <div class="header">
        <div class="container">
            <div class="logo">
                <a href="index.html">
                    <img src="img/logo.jpg" alt="Logo">
                </a>
            </div>


       <div class="menu">
          <a a href="index.html" class="link">
            <div class="title">Accueil</div>
            <div class="bar"></div>
          </a>
           <a href="bien.php" class="link">
            <div class="title">Poster une proposition</div>
            <div class="bar"></div>
          </a>
           <a href="gallery.php" class="link">
            <div class="title">Toutes les propositions</div>
            <div class="bar"></div>
          </a>

          <a a href="parameters.php"class="link">
            <div class="title">Paramètres</div>
            <div class="bar"></div>
          </a>

          <div class="container">

</div>
  <script src='https://unpkg.com/vue'></script>
<script src='https://unpkg.com/axios/dist/axios.min.js'></script>
<script src='https://use.fontawesome.com/releases/v5.0.4/js/all.js'></script>


        </div>
      </div>
    </div>


<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1><?php echo $member->Prenom." ".$member->Nom; ?></h1></div>
    	<!-- <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div> -->
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->


      <div class="text-center">
        <img src="<?php echo $member->Photo;?>" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a different photo...</h6>
        <form action="upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <button class="btn btn-sm btn-success" type="submit" name="submit">Submit</button>
      </form>
      </div></hr> <br>



          <div class="panel panel-default">
            <div class="panel-heading">Cagnotte <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body">1938€</div>
          </div>



          <ul class="list-group">
            <li class="list-group-item text-muted">Statistiques <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Demandes totale</strong></span> <?php echo $member->Recu; ?></li>
              <li class="list-group-item text-right"><span class="pull-left"><strong>Biens ou services rendus</strong></span> <?php echo $member->Rendu ;?></li>

            <!--
            <li class="list-group-item text-right"><span class="pull-left"><strong>biens empruntés</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>services </strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>biens loués</strong></span> 78</li>
          -->
          </ul>

          <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
            	<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>

        </div><!--/col-3-->
    	<div class="col-sm-9">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Mon compte</a></li>
                <li><a data-toggle="tab" href="#biens">Mes biens</a></li>
                <li><a data-toggle="tab" href="#test">Mes services</a></li>
                <li><a data-toggle="tab" href="#settings">Tableau de bord</a></li>
              </ul>



          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="first_name"><h4>Prénom</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder=<?php echo $member->Prenom; ?> title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                            <label for="last_name"><h4>Nom de famille</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder=<?php echo $member->Nom; ?> title="enter your last name if any.">
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Numéro de téléphone</h4></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder=<?php echo $member->NumeroTel; ?> title="enter your mobile number if any.">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="email"><h4>Code Postal</h4></label>
                              <input type="email" class="form-control" id="location" placeholder=<?php echo $member->CodePostal; ?> title="enter a location">
                          </div>
                      </div>

                       <div class="form-group">

                          <div class="col-xs-6">
                            <label for="description"><h4>Description</h4></label>
                              <input type="text" class="form-control" name="description" id="last_name" placeholder=<?php echo $member->Description; ?> title="enter your last name if any.">
                          </div>
                      </div>

                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="password"><h4>Mot de passe</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                            <label for="password2"><h4>Vérification du mot de passe</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" name="enregistrer"><i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Annuler</button>
                            </div>
                      </div>
              	</form>

              <hr>

             </div><!--/tab-pane-->


               <div class="tab-pane" id="test">
                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="titre"><h4>Titre</h4></label>
                              <input type="text" class="form-control" name="titre" id="titre" placeholder=<?php echo $member->Prenom; ?> >
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                            <label for="descriptif"><h4>Descriptif</h4></label>
                              <input type="text" class="form-control" name="descriptif" id="descriptif" placeholder=<?php echo $member->Nom; ?> >
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Prix</h4></label>
                              <input type="numeric" class="form-control" name="" id="prix" placeholder=<?php echo $member->Prenom; ?> >
                          </div>
                      </div>

                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Annuler</button>
                            </div>
                      </div>
                </form>

              <hr>

             </div>
             <div class="tab-pane" id="biens">

               <h2></h2>



               <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <form method="post" action="traitement.php"> 
                         <p>
                               <label for="pays">Choisissez le bien à modifier</label><br />
                               <select name="bien" id="bien">

                                <?php
                                  ini_set("display_errors",1);error_reporting(E_ALL);
                                  $servername = "86.210.13.52";
                                  $port="3307";
                                  $username = "jmr";
                                  $password = "BaseDonnees1234";
                                  $dbname = "jmr";

                                  try {
                                    echo $member->Email;
                                    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
                                    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    foreach($bd->query("SELECT * FROM BIEN WHERE EmailProp='".$member->Email."'") as $row){
                                      //$bien=new Bien($row[0], $row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9]);
                                      echo  "<option value=".$row[0].">".$row[8]."</option>";
                                      //affiche($bien);
                                      }

                                  }finally{
                                    $bd=null;
                                  }

                                ?>

                               </select>
                           </p>
                           <button > Sélectionner</button>
                         </form>

                              <?php
                                  ini_set("display_errors",1);error_reporting(E_ALL);
                                  $servername = "86.210.13.52";
                                  $port="3307";
                                  $username = "jmr";
                                  $password = "BaseDonnees1234";
                                  $dbname = "jmr";

                                  try {
                                    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
                                    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                  
                                    if($_POST!=null){
                                      echo "<form class='form' action='##'' method='post' id='bienForm'> <div class='form-group'>";
                                    foreach($bd->query("SELECT * FROM BIEN WHERE ID_Bien='".$_POST["bien"]."'") as $row){
                                      $bien=new Bien($row[0], $row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9]);
                                      echo " <div class='form-group'> <div class='col-xs-6'>";
                                      echo "<label for='first_name'><h4>Titre</h4></label>";
                                      echo "<input type='text' class='form-control' name='titre_B' id='titre_B' placeholder=".$bien->Titre.">";
                                      echo "</div> </div>";

                                      echo "<div class='form-group'> <div class='col-xs-6'>";
                                      echo "<label for='mobile'><h4>Descriptif</h4></label>";
                                      echo "<input type='numeric' class='form-control' name='descriptif_B' id='descriptif_B' placeholder=".$bien->Descriptif.">";
                                      echo "</div> </div>";

                                      echo "<div class='form-group'> <div class='col-xs-6'>";
                                      echo "<label for='mobile'><h4>Prix</h4></label>";
                                      echo "<input type='numeric' class='form-control' name='prix_B' id='prix_B' placeholder=".$bien->PrixNeuf.">";
                                      echo "</div> </div>";
                                      }
                                    }
                                    echo "<div class='form-group'> <div class='col-xs-12'><br>";
                                    echo "<button class='btn btn-lg btn-success' type='submit' name='enregistrer_B'><i class='glyphicon glyphicon-ok-sign'></i> Enregistrer</button>";
                                    echo "<button class='btn btn-lg' type='reset'><i class='glyphicon glyphicon-repeat'></i> Annuler</button>";
                                    echo "</div> </div>";
                                    echo "</div> ";

 
                                  }finally{
                                    $bd=null;
                                  } 

                                ?>

                        </form>
                      


             </div><!--/tab-pane-->
             <div class="tab-pane" id="settings">


                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="first_name"><h4>Rechercher un nom d'utilisateur à bannir</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name"  title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">





                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<!--<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>-->
                            </div>
                      </div>
              	</form>
              </div>

              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
