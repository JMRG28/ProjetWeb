<?php
include_once('Membre.php');
include_once('Categorie.php');
class Bien {
	public $ID_Bien;
	public $Descriptif;
	public $Photo;
	public $PrixNeuf;
	public $Actif;
	public $DateDebut;
	public $DateFin;
	public $EmailProp;
	public $Titre;
	public $URL;
	public $Prop;
	public $ID_Catego;
	public $Categorie;

//privatiser apres
	function __construct($id_bien, $descriptif, $photo, $prixNeuf, $actif, $dateDeb,  $emailProp, $titre,$url,$id_catego,$dateFin) {
		$this->ID_Bien=$id_bien;
		$this->Descriptif=$descriptif;
		$this->Photo=$photo;
		$this->PrixNeuf=$prixNeuf;
		$this->Actif=$actif;
		$this->DateDebut=$dateDeb;
		$this->DateFin=$dateFin;
		$this->EmailProp=$emailProp;
		$this->Titre=$titre;
		$this->URL=$url;
		$this->Prop=new Membre(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
		$this->ID_Catego=$id_catego;
		$this->Categorie=new Categorie(null,null,null,null);
	}

	function createFromTab($tab) {
		$this->ID_Bien=$tab[0];
		$this->Descriptif=$tab[1];
		$this->Photo=$tab[2];
		$this->PrixNeuf=$tab[3];
		$this->Actif=$tab[4];
		$this->DateDebut=$tab[5];
		$this->EmailProp=$tab[6];
		$this->Titre=$tab[7];
		$this->URL=$tab[8];
		$this->ID_Catego=$tab[9];
	//	$this->Categorie->getFromID($this->ID_Catego);
		$this->Prop->getFromEmail($this->EmailProp);
		$this->DateFin=$tab[10];
	}

	function  toString(){
		echo $this->ID_Bien;
		echo $this->Descriptif;
		echo $this->Photo;
		echo $this->PrixNeuf;
		echo $this->Actif;
		echo $this->DateDebut;
		echo $this->EmailProp;
		echo $this->Titre;
		echo $this->ID_Catego;
	}

	function affiche(){
		if($this->Photo!=null){
			echo '<div class="tile scale-anm biens all">'
			.$this->Titre.'<br>'
			.$this->Descriptif.'<br>
			<a href=profile2.php?uid='.md5($this->EmailProp).'>'.$this->Prop->Prenom.' '.$this->Prop->Nom.'</a><br>
			<a href=aff_bien.php?bid='.$this->URL.'>
			<img src='.$this->Photo.' alt="" />
			</a>
			</div>';
		}
		else{
			echo '<div class="tile scale-anm biens all">'
			.$this->Titre.'<br>'
			.$this->Descriptif.'<br>
			<a href=profile2.php?uid='.md5($this->EmailProp).'>'.$this->Prop->Prenom.' '.$this->Prop->Nom.'</a><br>
			<a href="aff_bien.php">
			<img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/the-ninetys-brand_02-300x300.jpg" alt="" />
			</a>
			</div>';

		}
	}

	function insert($bd){
		$stmt = $bd->prepare("INSERT INTO BIEN (ID_Bien, Descriptif, Photo, PrixNeuf, Actif,DateDebut,EmailProp,Titre,URL,Categorie,DateFin)VALUES (:id_bien, :descriptif, :photo, :prixNeuf, :actif, :dateDeb, :emailProp, :titre, :url, :id_catego,:dateFin)");
		$stmt->bindValue(":id_bien", $this->ID_Bien);
		$stmt->bindValue(":descriptif", $this->Descriptif);
		$stmt->bindValue(":photo",$this->Photo);
		$stmt->bindValue(":prixNeuf", $this->PrixNeuf);
		$stmt->bindValue(":actif", $this->Actif);
    	$stmt->bindValue(":dateDeb", $this->DateDebut);
		$stmt->bindValue(":emailProp", $this->EmailProp);
		$stmt->bindValue(":titre", $this->Titre);
		$stmt->bindValue(":url", $this->URL);
		$stmt->bindValue(":id_catego", $this->ID_Catego);
		$stmt->bindValue(":dateFin", $this->DateFin);
		$stmt->execute();
	}

	function getFromURL($bid){
		$servername = "k1nd0ne.com";
		$port="3307";
		$username = "jmr";
		$password = "BaseDonnees1234";
		$dbname = "jmr";
		$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$response=0;
		foreach($bd->query("SELECT * FROM BIEN where URL='".$bid."'") as $row){
			$this->createFromTab($row);
			$response=1;
		}
		if($response==0){
			echo "<h1>Bien non trouvé</h1>";
		}

	}
	function update($bd,$key,$value){
		echo " <br> UPDATE BIEN SET ".$key."='".$value."' where ID_Bien=".$this->ID_Bien ."<br>";
		$stmt = $bd->prepare("UPDATE BIEN SET ".$key."='".$value."' where ID_Bien='".$this->ID_Bien."'");
		$stmt->execute();
	}
	/*

	function delete($bd){
		echo " <br> DELETE FROM BIEN WHERE  ID_Bien=".$this->ID_Bien ."<br>";
		$stmt = $bd->prepare("DELETE FROM BIEN WHERE ID_Bien='".$this->ID_Bien."'");
		$stmt->execute();
	}
*/
	function upload(){
		$servername = "k1nd0ne.com";
		$port="3307";
		$username = "jmr";
		$password = "BaseDonnees1234";
		$dbname = "jmr";
		$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		echo $target_file."<br>";
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = true;
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }
    // Check file size
		if ($_FILES["fileToUpload"]["size"] > 5000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
    // Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  && $imageFileType != "gif" && $imageFileType != "tif" ) {
			echo "Sorry, only .jpg files are allowed.";
			$uploadOk = 0;
		}
    // Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$this->toString();
				$this->update($bd,"Photo",$target_file);
				$this->Photo=$target_file;
          //header('Location: bien.php');
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
}

?>
