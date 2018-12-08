<?php

class Bien {
  public $ID_Bien;
  public $Descriptif;
  public $Photo;
  public $PrixNeuf;
  public $Actif;
  public $EstDispo;
  public $DateMES;
  public $EmailProp;
  public $Titre;


//privatiser apres
  function __construct($id_bien, $descriptif, $photo, $prixNeuf, $actif, $estDispo, $dateMES, $emailProp, $titre) {
  $this->ID_Bien=$id_bien;
  $this->Descriptif=$descriptif;
  $this->Photo=$photo;
  $this->PrixNeuf=$prixNeuf;
  $this->Actif=$actif;
  $this->EstDispo=$estDispo;
  $this->DateMES=$dateMES;
  $this->EmailProp=$emailProp;
  $this->Titre=$titre;
  }

  function createFromTab($tab) {
  $this->ID_Bien=$tab[0];
  $this->Descriptif=$tab[1];
  $this->Photo=$tab[2];
  $this->PrixNeuf=$tab[3];
  $this->Actif=$tab[4];
  $this->EstDispo=$tab[5];
  $this->DateMES=$tab[6];
  $this->EmailProp=$tab[7];
  $this->Titre=$tab[8];


  }

 function  toString(){
    echo $this->ID_Bien;
    echo $this->Descriptif;
    echo $this->Photo;
    echo $this->PrixNeuf;
    echo $this->Actif;
    echo $this->DateMES;
    echo $this->EmailProp;
    echo $this->Titre;

  }

function affiche(){
  echo '<div class="tile scale-anm biens all">'
  .$this->Titre.'<br>'
  .$this->Descriptif.'<br>
  <a href=profile2.php?uid='.md5($this->EmailProp).'>Vendeur</a><br>
        <a href="aff_bien.php">
        <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/the-ninetys-brand_02-300x300.jpg" alt="" />
        </a>
  </div>';

}

// A VERIFIEEEER
  function insert($bd){
  //  echo "<h1>".$this->Email." coucou <h1>";
    $stmt = $bd->prepare("INSERT INTO BIEN (ID_Bien, Descriptif, Photo, PrixNeuf, Actif,DateMES,EmailProp,Titre)VALUES (:id_bien, :descriptif, :photo, :prixNeuf, :actif, NOW(), :emailProp, :titre)");
    $stmt->bindValue(":id_bien", $this->ID_Bien);
    $stmt->bindValue(":descriptif", $this->Descriptif);
    $stmt->bindValue(":photo",$this->Photo);
    $stmt->bindValue(":prixNeuf", $this->PrixNeuf);
    $stmt->bindValue(":actif", $this->Actif);
    //$stmt->bindValue(":dateMES", $this->DateMES);
    $stmt->bindValue(":emailProp", $this->EmailProp);
    $stmt->bindValue(":titre", $this->Titre);
    $stmt->execute();
  }

}


?>
