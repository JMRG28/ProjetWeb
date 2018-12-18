<?php
include "Membre.php";
include "Bien.php";
include "Service.php";
include 'bd.php';
include "header.php";

if (!isset($_SESSION['member'])){
	header('Location: login2.php');
}

$callback=false;
$callback_B=false;
$callback_U=false;
$callback_S=false;
$member=unserialize($_SESSION['member']);
//$member->toString();

//Améliorer les fonctions
function updateDB($v,$k){
	$servername = "k1nd0ne.com";
	$port="3307";
	$username = "jmr";
	$password = "BaseDonnees1234";
	$dbname = "jmr";
	echo $dbname;
	$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$member=unserialize($_SESSION['member']);
	$member->update($bd,$v,$k);
	$member->$v=$k ;
	$_SESSION['member']=serialize($member);
	//header('Location: parameters.php');
}

function updateDB_Bien($id,$v,$k){
	$servername = "k1nd0ne.com";
	$port="3307";
	$username = "jmr";
	$password = "BaseDonnees1234";
	$dbname = "jmr";
	$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query=$bd->prepare("SELECT * FROM BIEN WHERE ID_Bien='".$_SESSION["current_b"]."'");
	$query->execute();
	$row=$query->fetch();
	//WARNING
	$bien=new Bien(null,null,null,null,null,null,null,null,null,null,null);
	$bien->createFromTab($row);
	$bien->update($bd,$v,$k);
	$bien->$v=$k ;
}

function updateDB_Service($id,$v,$k){
	$servername = "k1nd0ne.com";
	$port="3307";
	$username = "jmr";
	$password = "BaseDonnees1234";
	$dbname = "jmr";
	$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query=$bd->prepare("SELECT * FROM SERVICE WHERE ID_Service='".$_SESSION["current_s"]."'");
	$query->execute();
	$row=$query->fetch();
	//WARNING
	$service=new Service(null,null,null,null,null,null,null,null,null,null);
	$service->createFromTab($row);
	$service->update($bd,$v,$k);
	$service->$v=$k ;
}

//SUPPRESSION DUN BIEN
function deleteBien($id){
	$servername = "k1nd0ne.com";
	$port="3307";
	$username = "jmr";
	$password = "BaseDonnees1234";
	$dbname = "jmr";
	$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query=$bd->prepare("DELETE FROM CONSOMMATION WHERE ID_BS='".$_SESSION["current_b"]."'");
	$query->execute();
	$query=$bd->prepare("DELETE FROM BIEN WHERE ID_Bien='".$_SESSION["current_b"]."'");
	$query->execute();
}

function deleteService($id){
	$servername = "k1nd0ne.com";
	$port="3307";
	$username = "jmr";
	$password = "BaseDonnees1234";
	$dbname = "jmr";
	$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query=$bd->prepare("DELETE FROM CONSOMMATION WHERE ID_BS='".$_SESSION["current_s"]."'");
	$query->execute();
	$query=$bd->prepare("DELETE FROM SERVICE WHERE ID_Service='".$_SESSION["current_s"]."'");
	$query->execute();
}

function updateDB_StatutUser($email,$v,$k){
	$servername = "k1nd0ne.com";
	$port="3307";
	$username = "jmr";
	$password = "BaseDonnees1234";
	$dbname = "jmr";
	$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query=$bd->prepare("SELECT * FROM MEMBRE WHERE Email='".$email."'");
	$query->execute();
	$row=$query->fetch();
	$member=new Membre(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
	$member->createFromTab($row);
	$member->update($bd,$v,$k);
	$member->$v=$k ;
}

if(isset($_POST["enregistrer_B"])){
	if($_POST["titre_B"]!=""){
		updateDB_Bien($_SESSION["current_b"],"Titre",$_POST["titre_B"]);
		$callback_B=true;
	}
	if($_POST["descriptif_B"]!=""){
		updateDB_Bien($_SESSION["current_b"],"Descriptif",$_POST["descriptif_B"]);
		$bien->upload();
		$callback_B=true;
	}
	if($_POST["prix_B"]!=""){
		updateDB_Bien($_SESSION["current_b"],"PrixNeuf",$_POST["prix_B"]);
		$callback_B=true;
	}
	if($_POST["statut_B"]=="actif"){
		updateDB_Bien($_SESSION["current_b"],"Actif",1);
	}
	if($_POST["statut_B"]=="desactive"){
		updateDB_Bien($_SESSION["current_b"],"Actif",0);
	}
	if($_POST["statut_B"]=="asupprimer"){
		//ICI
		deleteBien($_SESSION["current_b"]);
		$callback_B=true;
	}
}


if(isset($_POST["enregistrer_S"])){
	if($_POST["titre_S"]!=""){
		updateDB_Service($_SESSION["current_s"],"Titre",$_POST["titre_S"]);
		$callback_S=true;
	}
	if($_POST["descriptif_S"]!=""){
		updateDB_Service($_SESSION["current_s"],"Descriptif",$_POST["descriptif_S"]);
		//$service->upload();
		$callback_S=true;
	}
	if($_POST["prix_S"]!=""){
		updateDB_Service($_SESSION["current_s"],"PrixH",$_POST["prix_S"]);
		$callback_S=true;
	}
	if($_POST["statut_S"]=="actif"){
		updateDB_Service($_SESSION["current_s"],"Actif",1);
	}
	if($_POST["statut_S"]=="desactive"){
		updateDB_Service($_SESSION["current_s"],"Actif",0);
	}
	if($_POST["statut_S"]=="asupprimer"){
		//ICI
		deleteService($_SESSION["current_s"]);
		$callback_S=true;
	}
}



//ICI
//VERIFICATION SI EST
if(isset($_POST["enregistrer_A"])){
	if($_POST["nom_D"]!=""){
		if($_POST["duree"]=="definitif"){
			updateDB_StatutUser($_POST["nom_D"],"Suspendu",1);
			echo "suspendu";
			$callback_U=true;
		}
		if($_POST["duree"]=="temporaire"){
			updateDB_StatutUser($_POST["nom_D"],"Actif",0);
			echo "tmp";
			$callback_U=true;
		}
		if($_POST["duree"]=="activer"){
			updateDB_StatutUser($_POST["nom_D"],"Actif",1);
			echo "actif";
			$callback_U=true;
		}
	}
}

if(isset($_POST["enregistrer"])){
	if($_POST["first_name"]!=""){
		updateDB("Prenom",$_POST["first_name"]);
		$callback=true;
	}
	if($_POST["last_name"]!=""){
		updateDB("Nom",$_POST["last_name"]);
		$callback=true;
	}
	if($_POST["adresse"]!=""){
		updateDB("Adresse",$_POST["adresse"]);
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

	<div class="container bootstrap snippet">
		<h1><?php echo $member->Prenom." ".$member->Nom; ?></h1>
		<div class="row">

			<div class="col-sm-10" title="profile image" class="img-circle img-responsive">

			</div>
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

				<!--
				<div class="panel panel-default">
				<div class="panel-heading">Cagnotte <i class="fa fa-link fa-1x"></i></div>
				<div class="panel-body">1938€</div>
			</div> -->

			<ul class="list-group">
				<li class="list-group-item text-muted">Statistiques </li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Propositions</strong></span> <?php echo $member->Recu; ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Biens ou services reçus</strong></span> <?php echo $member->Rendu ;?></li>
			</ul>


		</div> <!--/col-3-->
		<div class="col-sm-9">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Mon compte</a></li>
				<li><a data-toggle="tab" id="bien" href="#biens">Mes biens</a></li>
				<li><a data-toggle="tab" href="#services">Mes services</a></li>
				<li><a data-toggle="tab" href="#settings">Notifications </a></li>
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
								<label for="codePostal"><h4>Code Postal</h4></label>
								<input type="text" name="codePostal" class="form-control" id="location" placeholder=<?php echo $member->CodePostal; ?> title="enter a location">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="adresse"><h4>Adresse</h4></label>
								<input type="text" name="adresse" class="form-control" id="adresse" placeholder="<?php echo $member->Adresse; ?>" title="enter a location">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="description"><h4>Description</h4></label>
								<input type="text" class="form-control" name="description" id="last_name" placeholder="<?php echo $member->Description; ?>" title="enter your last name if any.">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="password"><h4>Mot de passe</h4></label>
								<input type="password" class="form-control" name="password" id="password"  title="enter your password.">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="password2"><h4>Vérification du mot de passe</h4></label>
								<input type="password" class="form-control" name="password2" id="password2"  title="enter your password2.">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12"> <br>
								<button class="btn btn-lg btn-success" type="submit" name="enregistrer"><i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
								<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Annuler</button>
							</div>
						</div>
					</form>
					<hr>
				</div><!--/tab-pane-->

				<div class="tab-pane" id="biens">
					<h2></h2>
					<hr>
					<div class=bienModif>
						<form method="post" > <!-- action="traitement.php"> -->

							<label for="pays">Choisissez le bien à modifier</label><br/>
							<select name="bien" id="bien">

								<?php
								try {
									echo $member->Email;
									$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
									$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

									foreach($bd->query("SELECT * FROM BIEN WHERE EmailProp='".$member->Email."'") as $row){
										echo  "<option value=".$row[0].">".$row[7]."</option>";
									}

								}finally{
									$bd=null;
								}

								?>

							</select>

							<button class="btn btn-sm btn-success" type="submit"> Sélectionner </button>
						</form>
					</div>
					<form id="updateimgbien" action="upload2.php" method="post" enctype="multipart/form-data"></form>
					<?php
					try {
						$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
						$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						if(isset($_POST["bien"])){
							echo '<script type="text/javascript">',
							'document.getElementById("bien").click()',
							'</script>';
							$_SESSION["current_b"]=$_POST["bien"];
							echo "<form class='form' action='##'' method='post' id='bienForm'> <div class='form-group'>";
							foreach($bd->query("SELECT * FROM BIEN WHERE ID_Bien='".$_POST["bien"]."'") as $row){
								$bien=new Bien(null,null,null,null,null,null,null,null,null,null,null);
								$bien->createFromTab($row);
								$_SESSION["bien"]=serialize($bien);
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

								echo "<div class='form-group'>";
								echo "<div class='col-xs-6'>";
								echo "<label for='statut'><h4>Statut</h4></label>";
								echo "<br>";
								echo "<label class='radio-container m-r-45'>Actif";
								echo "<input type='radio' checked='checked' name='statut_B' value='actif'>";
								echo "<span class='checkmark'></span>";
								echo "</label>";
								echo "<label class='radio-container'> Désactivé";
								echo "<input type='radio' name='statut_B' value='desactive'>";
								echo "<span class='checkmark'></span>";
								echo "<label class='radio-container'> Je souhaite supprimer ce bien";
								echo "<input type='radio' name='statut_B' value='asupprimer'>";
								echo "<span class='checkmark'></span>";
								echo "</label>";
								echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
								echo "<div class='col-xs-6'>";

								echo "<img style='width:300px;' src=".$bien->Photo.">";
								echo "</div>";
								echo "</div>";
								echo ' <h4>Image</h4>
								<input form="updateimgbien" type="file" name="fileToUpload" id="fileToUpload">
								<button form="updateimgbien" class="btn btn-sm btn-success" type="submit" name="submit2">Submit</button>
								</form>';

							}

							echo "<div class='form-group'> <div class='col-xs-12'><br>";
							echo "<button class='btn btn-lg btn-success' type='submit' name='enregistrer_B'><i class='glyphicon glyphicon-ok-sign'></i> Enregistrer</button>";
							echo "<button class='btn btn-lg' type='reset'><i class='glyphicon glyphicon-repeat'></i> Annuler</button>";
							echo "</div> </div>";
							echo "</div> </form>";
						}

					}finally{
						$bd=null;
					}

					?>

				</div><!--/tab-pane-->


				<div class="tab-pane" id="services">
					<h2></h2>
					<hr>
					<div class=bienModif>
						<form method="post" > <!-- action="traitement.php"> -->

							<label for="pays">Choisissez le service  à modifier</label><br/>
							<select name="service" id="service">

								<?php
								try {
									echo $member->Email;
									$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
									$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

									foreach($bd->query("SELECT * FROM SERVICE WHERE EmailProp='".$member->Email."'") as $row){
										echo  "<option value=".$row[0].">".$row[7]."</option>";
									}

								}finally{
									$bd=null;
								}

								?>

							</select>

							<button class="btn btn-sm btn-success" type="submit"> Sélectionner </button>
						</form>
					</div>
					<!-- WARNING -->
					<form id="updateimgservice" action="upload2.php" method="post" enctype="multipart/form-data"></form>
					<?php
					try {
						$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
						$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						if(isset($_POST["service"])){
							echo '<script type="text/javascript">',
							'document.getElementById("service").click()',
							'</script>';
							// WARNING
							$_SESSION["current_s"]=$_POST["service"];
							echo "<form class='form' action='##'' method='post' id='serviceForm'> <div class='form-group'>";
							foreach($bd->query("SELECT * FROM SERVICE WHERE ID_Service='".$_POST["service"]."'") as $row){
								$service=new Service(null,null,null,null,null,null,null,null,null,null);
								$service->createFromTab($row);
								$_SESSION["service"]=serialize($service);
								echo " <div class='form-group'> <div class='col-xs-6'>";
								echo "<label for='first_name'><h4>Titre</h4></label>";
								echo "<input type='text' class='form-control' name='titre_S' id='titre_S' placeholder=".$service->Titre.">";
								echo "</div> </div>";

								echo "<div class='form-group'> <div class='col-xs-6'>";
								echo "<label for='mobile'><h4>Descriptif</h4></label>";
								echo "<input type='numeric' class='form-control' name='descriptif_S' id='descriptif_S' placeholder=".$service->Descriptif.">";
								echo "</div> </div>";

								echo "<div class='form-group'> <div class='col-xs-6'>";
								echo "<label for='mobile'><h4>Prix</h4></label>";
								echo "<input type='numeric' class='form-control' name='prix_S' id='prix_S' placeholder=".$service->PrixH.">";
								echo "</div> </div>";

								echo "<div class='form-group'>";
								echo "<div class='col-xs-6'>";
								echo "<label for='statut'><h4>Statut</h4></label>";
								echo "<br>";
								echo "<label class='radio-container m-r-45'>Actif";
								echo "<input type='radio' checked='checked' name='statut_S' value='actif'>";
								echo "<span class='checkmark'></span>";
								echo "</label>";
								echo "<label class='radio-container'> Désactivé";
								echo "<input type='radio' name='statut_S' value='desactive'>";
								echo "<span class='checkmark'></span>";
								echo "<label class='radio-container'> Je souhaite supprimer ce bien";
								echo "<input type='radio' name='statut_S' value='asupprimer'>";
								echo "<span class='checkmark'></span>";
								echo "</label>";
								echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
								echo "<div class='col-xs-6'>";

								
								echo "</div>";
								echo "</div>";

							}

							echo "<div class='form-group'> <div class='col-xs-12'><br>";
							echo "<button class='btn btn-lg btn-success' type='submit' name='enregistrer_S'><i class='glyphicon glyphicon-ok-sign'></i> Enregistrer</button>";
							echo "<button class='btn btn-lg' type='reset'><i class='glyphicon glyphicon-repeat'></i> Annuler</button>";
							echo "</div> </div>";
							echo "</div> </form>";
						}

					}finally{
						$bd=null;
					}

					?>

				</div><!--/tab-pane-->


				<div class="tab-pane" id="settings">

					<?php
					if($member->Admin==1){

						try {
							$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
							$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

							echo "<h2> Utilisateurs à surveiller</h2>";
								//MODIFIER
							foreach($bd->query("SELECT * FROM MEMBRE WHERE (RECU - RENDU) >= 1 AND Actif=1 AND Banni=0") as $row){
								echo  $row[0];
							}

						}finally{
							$bd=null;
						}


						echo "<hr>";
						echo "<form class='form' action='##'' method='post' id='userToDeleteForm'>";
						echo "<div class='form-group'>";
						echo "<div class='col-xs-6'>";
						echo "<label for='first_name'><h4>Email de l'utilisateur</h4></label>";
						echo "<input type='text' class='form-control' name='nom_D' id='nom_D'>";
						echo "</div>";
						echo "</div>";

						echo "<div class='form-group'>";
						echo "<div class='col-xs-6'>";
						echo "<label class='radio-container m-r-45'>Désactiver temporairement";
						echo "<input type='radio' checked='checked' name='duree' value='temporaire'>";
						echo "<span class='checkmark'></span>";
						echo "</label>";
						echo "<label class='radio-container'>Désactiver définitivement";
						echo "<input type='radio' name='duree' value='definitif'>";
						echo "<span class='checkmark'></span>";
						echo "</label>";
						echo "<label class='radio-container'>Activiter";
						echo "<input type='radio' name='duree' value='activer'>";
						echo "<span class='checkmark'></span>";
						echo "</label>";
						echo "</div>";
						echo "</div>";

						echo "<div class='form-group'>";
						echo "<div class='col-xs-12'>";
						echo "<br>";
						echo "<button class='btn btn-lg btn-success pull-right' type='submit' name='enregistrer_A'><i class='glyphicon glyphicon-ok-sign'></i> Save</button>";
						echo "<button class='btn btn-lg' type='reset'><i class='glyphicon glyphicon-repeat'></i> Reset</button>";
						echo "</div>";
						echo "</div>";
						echo "</form>";
					}
					else{
						//WARNING
						if($member->Recu-$member->Rendu>=10){
							echo $member->Rendu."	".$member->Recu+10;
							echo "<h3> Avertissement: vous ne respectez pas la charte du site: plus de reçu que de rendu </h3>";
						}
						else{
							echo "<h3> Rien à signaler </h3>";
						}
					}

					?>

				</div><!--/tab-pane-->

			</div><!--/tab-content-->

		</div><!--/col-9-->
	</div><!--/row-->
