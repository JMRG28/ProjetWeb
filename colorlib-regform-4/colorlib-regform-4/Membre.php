<?php

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

}


?>
