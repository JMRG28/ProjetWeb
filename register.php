<?php
ini_set("display_errors",1);error_reporting(E_ALL);
if(isset($_POST['email'])){
  $servername = "**.**.**.**";
  $port="****";
  $username = "***";
  $password = "*******";
  $dbname = "***";

  try {

    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $bd->prepare("INSERT INTO MEMBRE (email, mdp_hash, nom, prenom, code_postal,numero_telephone,sexe,statut,date_naissance)VALUES (:email, :mdp_hash, :nom, :prenom,code_postal, :numero_telephone, :sexe, :statut, :date_naissance)");
    $stmt->bindValue(":email", $_POST['email']);
    $stmt->bindValue(":mdp_hash", md5($_POST['mdp']));
    $stmt->bindValue(":nom", $_POST['nom']);
    $stmt->bindValue(":prenom", $_POST['prenom']);
    $stmt->bindValue(":code_postal", $_POST['code_p']);
    $stmt->bindValue(":numero_telephone", $_POST['num_tel']);
    $stmt->bindValue(":sexe", $_POST['sexe']);
    $stmt->bindValue(":statut", $_POST['statut']);
    $stmt->bindValue(":date_naissance", $_POST['date_n']);
    $stmt->execute();
    echo "Successfully added the new user " . $_POST['nom'];
  } catch (PDOException $e) {
    echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
  } catch (Exception $e) {
    echo "General Error: The user could not be added.<br>".$e->getMessage();
  }finally{
    $bd=null;
  }
}
?>

<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="register">

  <form method="post" action="">
    Nom:<input name="nom" type="text" required></br>
    Prenom:<input name="prenom" type="text" required></br>
    Email:<input name="email" type="email" required></br>
    Mot de passe:<input name="mdp" type="password" required></br>
    Ville:<input name="ville" type="text" required></br>
    Code Tel:<input name="c_tel" type="text" required></br>
    Numero Tel:<input name="num_tel" type="text" required></br>
    Description:<input name="desc" type="text" required></br>
    Sexe:<input name="sexe" type="text" required></br>
    Statut:<input name="statut" type="text" required></br>
    Date de Naissance:<input name="date_n" type="date" required></br>
    <input name="submit" type="submit"></br>
  </form>
  <div>
</body>
</html>
