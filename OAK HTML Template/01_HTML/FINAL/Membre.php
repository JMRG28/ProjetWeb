<?php
ini_set("display_errors",1);error_reporting(E_ALL);
class Membre {
  public $Email;
  public $MdpHash;
  public $Nom;
  public $Prenom;
  public $CodePostal;
  public $NumeroTel;
  public $Photo;
  public $Description;
  public $Rendu;
  public $Recu;
  public $Sexe;
  public $Statut;
  public $DateNaiss;
  public $DateIns;
  public $Actif;
  public $Suspendu;

//privatiser apres
  function __construct($email,$mdp,$nom,$prenom,$codep,$num,$photo,$desc,$rendu,$recu,$sexe,$statut,$dateN,$dateI,$actif,$suspendu) {
    $this->Email= $email;
    $this->MdpHash=$mdp;
    $this->Nom=$nom;
    $this->Prenom=$prenom;
    $this->CodePostal=$codep;
    $this->NumeroTel=$num;
    $this->Photo=$photo;
    $this->Description=$desc;
    $this->Rendu=$rendu;
    $this->Recu=$recu;
    $this->Sexe=$sexe;
    $this->Statut=$statut;
    $this->DateNaiss=$dateN;
    $this->DateIns=$dateI;
    $this->Actif=$actif;
    $this->Suspendu=$suspendu;
  }

  function createFromTab($tab) {

    $this->Email= $tab[0];
    $this->MdpHash=$tab[1];
    $this->Nom=$tab[2];
    $this->Prenom=$tab[3];
    $this->CodePostal=$tab[4];
    $this->NumeroTel=$tab[5];
    $this->Photo=$tab[6];
    $this->Description=$tab[7];
    $this->Rendu=$tab[8];
    $this->Recu=$tab[9];
    $this->Sexe=$tab[10];
    $this->Statut=$tab[11];
    $this->DateNaiss=$tab[12];
    $this->DateIns=$tab[13];
    $this->Actif=$tab[14];
    $this->Suspendu=$tab[15];


  }

 function  toString(){
     echo $this->Email;
    echo $this->MdpHash;
    echo $this->Nom;
    echo $this->Prenom;
    echo $this->CodePostal;
    echo $this->NumeroTel;
    echo $this->Photo;
    echo $this->Description;
    echo $this->Rendu;
    echo $this->Recu;
    echo $this->Sexe;
    echo $this->Statut;
    echo $this->DateNaiss;
    echo $this->DateIns;
    echo $this->Actif;
    echo $this->Suspendu;
  }


  function insert($bd){
  //  echo "<h1>".$this->Email." coucou <h1>";
    $stmt = $bd->prepare("INSERT INTO MEMBRE (Email, MdpHash, Nom, Prenom, CodePostal,NumeroTel,Sexe,Statut,DateNaiss)VALUES (:email, :mdp_hash, :nom, :prenom, :code_postal, :numero_telephone, :sexe, :statut, :date_naissance)");
    $stmt->bindValue(":email", $this->Email);
    $stmt->bindValue(":mdp_hash", $this->MdpHash);
    $stmt->bindValue(":nom",$this->Nom);
    $stmt->bindValue(":prenom", $this->Prenom);
    $stmt->bindValue(":numero_telephone", $this->NumeroTel);
    $stmt->bindValue(":code_postal", $this->CodePostal);
    $stmt->bindValue(":sexe", $this->Sexe);
    $stmt->bindValue(":statut", $this->Statut);
    $stmt->bindValue(":date_naissance", $this->DateNaiss);
    $stmt->execute();
  }

  function update($bd,$key,$value){
  //  echo "<h1>".$this->Email." coucou <h1>";
  echo " <br> UPDATE MEMBRE SET ".$key."='".$value."' where Email=".$this->Email ."<br>";
    $stmt = $bd->prepare("UPDATE MEMBRE SET ".$key."='".$value."' where Email='".$this->Email."'");
    $stmt->execute();
  }

}


?>
