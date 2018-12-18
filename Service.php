<?php
include_once('Membre.php');
include_once('Categorie.php');
class Service {
	public $ID_Service;
	public $Descriptif;
	public $PrixH;
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
	function __construct($id_service, $descriptif, $prixH, $actif, $dateDeb,  $emailProp, $titre,$url,$id_catego,$dateFin) {
		$this->ID_Service=$id_service;
		$this->Descriptif=$descriptif;
		$this->PrixH=$prixH;
		$this->Actif=$actif;
		$this->DateDebut=$dateDeb;
		$this->DateFin=$dateFin;
		$this->EmailProp=$emailProp;
		$this->Titre=$titre;
		$this->URL=$url;
		$this->Prop=new Membre(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
		$this->ID_Catego=$id_catego;
		$this->Categorie=new Categorie(null,null,null,null);
		if($this->ID_Catego != null)
		 $this->Categorie->getFromID($this->ID_Catego);

	}

	function createFromTab($tab) {
		$this->ID_Service=$tab[0];
		$this->Descriptif=$tab[1];
		$this->PrixH=$tab[2];
		$this->Actif=$tab[3];
		$this->DateDebut=$tab[4];
		$this->EmailProp=$tab[5];
		$this->Titre=$tab[7];
		$this->URL=$tab[8];
		$this->ID_Catego=$tab[6];
		$this->Categorie->getFromID($this->ID_Catego);
		$this->Prop->getFromEmail($this->EmailProp);
		$this->DateFin=$tab[9];
	
		//echo $this->ID_Catego;
	}

	function  toString(){
		echo $this->ID_Service;
		echo $this->Descriptif;
		echo $this->PrixH;
		echo $this->Actif;
		echo $this->DateDebut;
		echo $this->DateFin;
		echo $this->EmailProp;
		echo $this->Titre;
		echo $this->ID_Catego;
	}

	function affiche(){
		if(($this->Categorie)->Photo!=null){
			echo '<div class="tile scale-anm services all">'
			.$this->Titre.'<br>'
			.'<br>
			<a href=profile2.php?uid='.md5($this->EmailProp).'>'.$this->Prop->Prenom.' '.$this->Prop->Nom.'</a><br>
			<a href=aff_service.php?sid='.$this->URL.'>
			<img src='.($this->Categorie)->Photo.' alt="" />
			</a>
			</div>';
		}
		else{
			echo '<div class="tile scale-anm services all">'
			.$this->Titre.'<br>'
			.'<br>
			<a href=profile2.php?uid='.md5($this->EmailProp).'>'.$this->Prop->Prenom.' '.$this->Prop->Nom.'</a><br>
			<a href="aff_service.php?sid='.$this->URL.'>
			<img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/the-ninetys-brand_02-300x300.jpg" alt="" />
			</a>
			</div>';

		}
	}

	

	function insert($bd){
		$stmt = $bd->prepare("INSERT INTO SERVICE (ID_Service, Descriptif, PrixH, Actif,DateDebut,EmailProp,Categorie, Titre,URL,DateFin)VALUES (:id_service, :descriptif, :prixH, :actif, :dateDeb, :emailProp,:id_catego, :titre, :url, :dateFin)");
		$stmt->bindValue(":id_service", $this->ID_Service);
		$stmt->bindValue(":descriptif", $this->Descriptif);
		$stmt->bindValue(":prixH", $this->PrixH);
		$stmt->bindValue(":actif", $this->Actif);
    	$stmt->bindValue(":dateDeb", $this->DateDebut);
		$stmt->bindValue(":emailProp", $this->EmailProp);
		$stmt->bindValue(":id_catego", $this->ID_Catego);
		$stmt->bindValue(":titre", $this->Titre);
		$stmt->bindValue(":url", $this->URL);
		$stmt->bindValue(":dateFin", $this->DateFin);
		$stmt->execute();
	}

	function getFromURL($sid){
		$servername = "k1nd0ne.com";
		$port="3307";
		$username = "jmr";
		$password = "BaseDonnees1234";
		$dbname = "jmr";
		$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$response=0;
		foreach($bd->query("SELECT * FROM SERVICE where URL='".$sid."'") as $row){
			$this->createFromTab($row);
			$response=1;
		}
		if($response==0){
			echo "<h1>Service non trouvé</h1>";
		}

	}
	function update($bd,$key,$value){
		$stmt = $bd->prepare("UPDATE SERVICE SET ".$key."='".$value."' where ID_Service='".$this->ID_Service."'");
		$stmt->execute();
	}
	/*

	function delete($bd){
		echo " <br> DELETE FROM BIEN WHERE  ID_Bien=".$this->ID_Bien ."<br>";
		$stmt = $bd->prepare("DELETE FROM BIEN WHERE ID_Bien='".$this->ID_Bien."'");
		$stmt->execute();
	}
*/
	
}

?>
