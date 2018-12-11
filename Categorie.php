<?php
ini_set("display_errors",1);error_reporting(E_ALL);
class Categorie {
  public $ID_Categorie;
  public $Nom;
  public $Photo;
  public $SuperCategorie;


  //privatiser apres
  function __construct($idc,$nom,$photo,$super) {
    $this->ID_Categorie= $idc;
    $this->Nom=$nom;
    $this->Photo=$photo;
    $this->SuperCategorie=$super;

  }

  function createFromTab($tab) {
    $this->ID_Categorie=$tab[0];
    $this->Nom=$tab[1];
    $this->Photo=$tab[2];
    $this->SuperCategorie=$tab[3];

  }

  function  toString(){
    echo $this->ID_Categorie;
    echo $this->Nom;
    echo $this->Photo;
    echo $this->SuperCategorie;

  }


  function insert($bd){
    //  echo "<h1>".$this->Email." coucou <h1>";
    $stmt = $bd->prepare("INSERT INTO Categorie (ID_Categorie,Nom,PhotoDefaut,SuperCategorie)VALUES (:idc,:nom,:photo,:super)");
    $stmt->bindValue(":idc", $this->ID_Categorie);
    $stmt->bindValue(":nom",$this->Nom);
    $stmt->bindValue(":photo", $this->Photo);
    $stmt->bindValue(":super", $this->SuperCategorie);
    $stmt->execute();
  }
  function getFromID($cid){
    $servername = "k1nd0ne.com";
    $port="3307";
    $username = "jmr";
    $password = "BaseDonnees1234";
    $dbname = "jmr";
    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $bd->prepare("SELECT * FROM CATEGORIE WHERE ID_Categorie = ?");
    $u=[];
    array_push($u,$cid);
    $stmt->execute($u);
    $response = $stmt->rowCount();
    if($response==1){
      $tab=[];
      while ($row = $stmt->fetch()) {
        $index=0;
        foreach ($row as $key=>$value){
          if($index%2==0){
            array_push($tab,$value);
          }
          $index++;
        }
      }
      $this->createFromTab($tab);
    }else{
      echo "<h1>Catégorie non trouvé</h1>";
    }
  }

  function update($bd,$key,$value){
    if($value!="" || $value==0){
      echo " <br> UPDATE CATEGORIE SET ".$key."='".$value."' where ID_Categorie='".$this->ID_Categorie."<br>";
      $stmt = $bd->prepare("UPDATE CATEGORIE SET ".$key."='".$value."' where ID_Categorie='".$this->ID_Categorie."'");
      $stmt->execute();
    }
  }

}


?>
