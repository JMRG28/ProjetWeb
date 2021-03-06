<?php
include 'Service.php' ;
include 'bd.php';
include 'header.php';


function conversion($d){
  $nd=explode("/",$d);
  $r=[];
  array_push($r, $nd[2], $nd[1],$nd[0]);
  $res=implode("-",$r);
  return $res;
}

ini_set("display_errors",1);error_reporting(E_ALL);
if(isset($_POST['titre'])){
  try {
    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query=$bd->prepare('SELECT MAX(ID_SERVICE)  FROM SERVICE');
    $query->execute();
    $result=$query->fetch();
    $id=$result[0]+1;

    $service=new Service($id, $_POST['descriptif'], $_POST['prixH'], 1,$member->Email,  $_POST['titre'],md5($id),$_POST['categorie']);
    $service->insert($bd);

    echo "Successfully added the new service " . $id;
} catch (PDOException $e) {
    echo "DataBase Error: The service could not be added.<br>".$e->getMessage();
} catch (Exception $e) {
    echo "General Error: The service could not be added.<br>".$e->getMessage();
}finally{
    $bd=null;
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Le Bon Voisin</title>

    <!-- Icons font CSS-->
    <link href="js/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="js/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="js/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="js/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link rel="stylesheet" href="css/menu.css">
    <link href="css/style_register.css" rel="stylesheet" media="all">

</head>

<body>
  <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title"> Proposition d'un Service</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Titre</label>
                                <input class="input--style-4" type="text" name="titre">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Descriptif</label>
                                <input class="input--style-4" type="text" name="descriptif">
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Prix à l'heure</label>
                                <input class="input--style-4" type="numeric" name="prixH">
                            </div>
                        </div>

                        <div class="input-group">

                              <label for="pays">Choisissez la catégorie</label><br/>
                                <div class="rs-select2">
                              <select name="categorie">

                                <?php
                                try {
                                  $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
                                  $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                  foreach($bd->query("SELECT * FROM CATEGORIE WHERE SuperCategorie IS NOT NULL") as $row){
                                    echo "<br>".$row[0];
                                    echo  "<option value=".$row[0].">".$row[1]."</option>";
                                  }

                                }finally{
                                  $bd=null;
                                }

                                ?>

                              </select>
                              <div class="select-dropdown"></div>
                                </div>
                            </div>
                          </div>
                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="js/vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="js/vendor/select2/select2.min.js"></script>
<script src="js/vendor/datepicker/moment.min.js"></script>
<script src="js/vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
