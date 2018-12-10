<?php
include 'Bien.php' ;
include 'header.php';
include 'bd.php';

function conversion($d){
  $nd=explode("/",$d);
  $r=[];
  array_push($r, $nd[2], $nd[1],$nd[0]);
  $res=implode("-",$r);
  return $res;
}

ini_set("display_errors",1);error_reporting(E_ALL);

try {
  $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
  $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $biens=[];
  foreach($bd->query('SELECT * FROM BIEN where EstDispo=1') as $row ){
    $bien=new Bien(null,null,null,null,null,null,null,null,null,null);
    $bien->createFromTab($row);
    array_push($biens, $bien);
  }

}finally{
  $bd=null;
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Toutes les propositions</title>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>

  <link rel='stylesheet' href='https://npmcdn.com/basscss@8.0.0/css/basscss.min.css'>
  <link rel="stylesheet" href="css/style_gallery.css">
  <link rel="stylesheet" href="css/menu.css">
</head>

<body>
  <div class="toolbar mb2 mt2">
  <button class="btn fil-cat" href="" data-rel="all">All</button>
  <button class="btn fil-cat" data-rel="biens">Biens</button>
  <button class="btn fil-cat" data-rel="services">Services</button>
</div>
<div id="portfolio" class="wrap">
  <?php
  foreach($biens as $i){
    $i->affiche();
  }
  ?>
</div>

<div style="clear:both;"></div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script  src="js/js_gallery.js"></script>

</body>

</html>
