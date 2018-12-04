<?php
include "Membre.php";
session_start();
ini_set("display_errors",1);error_reporting(E_ALL);
if(isset($_POST['email'])){
  $servername = "86.210.13.52";
  $port="3307";
  $username = "jmr";
  $password = "BaseDonnees1234";
  $dbname = "jmr";

  try {

    $bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $bd->prepare("SELECT * FROM MEMBRE WHERE Email = ? AND MdpHash = ?");
    $stmt->execute([$_POST['email'], md5($_POST['password'])]);
    $response = $stmt->rowCount();
    if($response==1){
    	$tab=[];
      $member=new Membre(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
      echo "SALUT ".$_POST['email']."<br>";
      while ($row = $stmt->fetch()) {
        $index=0;
        foreach ($row as $key=>$value){
          if($index%2==0){
          	array_push($tab,$value);
            //echo $key." ";
          
      		}
          $index++;
        }
      }
      $member->createFromTab($tab);
      $_SESSION['member']=serialize($member);
      header('Location: profile.php');
      $member->toString();
    }else{
      echo "<br>ERREUR WESH<br>";
    }
    unset($_POST['email']);
    //  echo "Successfully logged in " . $_POST['email'];
  } catch (PDOException $e) {
    echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
  } catch (Exception $e) {
    echo "General Error: The user could not be added.<br>".$e->getMessage();
  }finally{
    $bd=null;
  }
}
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login & Register Box</title>

</head>

<body>
  <!-- Preloader -->
 <form method="POST">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form> 
</body>

</html>
