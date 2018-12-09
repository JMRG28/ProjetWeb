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
  public $url;

  //privatiser apres
  function __construct($email,$mdp,$nom,$prenom,$codep,$num,$photo,$desc,$rendu,$recu,$sexe,$statut,$dateN,$dateI,$actif,$suspendu,$url) {
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
    $this->url=$url;
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
    $stmt = $bd->prepare("INSERT INTO MEMBRE (Email, MdpHash, Nom, Prenom, CodePostal,NumeroTel,Sexe,Statut,DateNaiss,url)VALUES (:email, :mdp_hash, :nom, :prenom, :code_postal, :numero_telephone, :sexe, :statut, :date_naissance,:url)");
    $stmt->bindValue(":email", $this->Email);
    $stmt->bindValue(":mdp_hash", $this->MdpHash);
    $stmt->bindValue(":nom",$this->Nom);
    $stmt->bindValue(":prenom", $this->Prenom);
    $stmt->bindValue(":numero_telephone", $this->NumeroTel);
    $stmt->bindValue(":code_postal", $this->CodePostal);
    $stmt->bindValue(":sexe", $this->Sexe);
    $stmt->bindValue(":statut", $this->Statut);
    $stmt->bindValue(":date_naissance", $this->DateNaiss);
    $stmt->bindValue(":url", $this->url);
    $stmt->execute();
  }
  function getFromURL($uid){
    $servername = "86.210.13.52";
    $port="3307";
    $username = "jmr";
    $password = "BaseDonnees1234";
    $dbname = "jmr";
    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $bd->prepare("SELECT * FROM MEMBRE WHERE url = ?");
    $u=[];
    array_push($u,$uid);
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
      echo "<h1>Utilisateur non trouvé</h1>";
    }
  }
  function getFromEmail($email){
    echo " Email: ".$email;
    $servername = "86.210.13.52";
    $port="3307";
    $username = "jmr";
    $password = "BaseDonnees1234";
    $dbname = "jmr";
    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $bd->prepare("SELECT * FROM MEMBRE WHERE Email = ?");
    $u=[];
    array_push($u,$email);
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
      echo "<h1>Utilisateur non trouvé</h1>";
    }
  }


  function update($bd,$key,$value){
    //  echo "<h1>".$this->Email." coucou <h1>";
    if($value!=""){
      echo " <br> UPDATE MEMBRE SET ".$key."='".$value."' where Email=".$this->Email ."<br>";
      $stmt = $bd->prepare("UPDATE MEMBRE SET ".$key."='".$value."' where Email='".$this->Email."'");
      $stmt->execute();
    }
  }

}


?>
