<?php
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
      echo "SALUT ".$_POST['email']."<br>";
      while ($row = $stmt->fetch()) {
        $index=0;
        foreach ($row as $key=>$value){
          if($index%2==0)
          echo $value."<br>";
          $index++;
        }
      }
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



  <link rel="stylesheet" href="css/style.css">

  <meta name="description" content="">
  <meta name="msapplication-tap-highlight" content="yes" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />

  <!-- Google Web Font -->
  <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lekton:400,700,400italic' rel='stylesheet' type='text/css'>

  <!--  Bootstrap 3-->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- OWL Carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.css">

  <!--  Slider -->
  <link rel="stylesheet" href="css/jquery.kenburnsy.css">

  <!-- Animate -->
  <link rel="stylesheet" href="css/animate.css">

  <!-- Web Icons Font -->
  <link rel="stylesheet" href="css/pe-icon-7-stroke.css">
  <link rel="stylesheet" href="css/iconmoon.css">
  <link rel="stylesheet" href="css/et-line.css">
  <link rel="stylesheet" href="css/ionicons.css">

  <!-- Magnific PopUp -->
  <link rel="stylesheet" href="css/magnific-popup.css">

  <!-- Tabs -->
  <link rel="stylesheet" type="text/css" href="css/tabs.css" />
  <link rel="stylesheet" type="text/css" href="css/tabstyles.css" />

  <!-- Loader Style -->
  <link rel="stylesheet" href="css/loader-1.css">

  <!-- Costum Styles -->
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/responsive.css">

  <!-- Favicon -->
  <link rel="icon" type="image/ico" href="favicon.ico">

  <!-- Modernizer & Respond js -->
  <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

  <!-- Google Map API -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcj7IUmQauOqpqeL5xj-UZbLb03vhBV3s&amp;sensor=false"></script>

</head>

<body>
  <!-- Preloader -->

  <div class="header">
    <div class="container">
      <div class="logo">
        <a href="index.html">
          <img src="img/logo3.jpg" alt="Logo">
        </a>
      </div>


      <div class="menu">
        <a a href="index.html" class="link">
          <div class="title">Accueil</div>
          <div class="bar"></div>
        </a>
        <a href="#" class="link">
          <div class="title">Inscription</div>
          <div class="bar"></div>
        </a>
        <a a href="login.html"class="link">
          <div class="title">Connexion</div>
          <div class="bar"></div>
        </a>
      </div>
    </div>
  </div>

  <div class="login-reg-panel">
    <div class="login-info-box">
      <h2>Have an account?</h2>
      <p>Lorem ipsum dolor sit amet</p>
      <label id="label-register" for="log-reg-show">Login</label>
      <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
    </div>

    <div class="register-info-box">
      <h2>Don't have an account?</h2>
      <p>Lorem ipsum dolor sit amet</p>
      <label id="label-login" for="log-login-show">Register</label>
      <input type="radio" name="active-log-panel" id="log-login-show">
    </div>

    <div class="white-panel">
      <div class="login-show">
        <h2>LOGIN</h2>
        <form method="POST">
          <input name="email" type="text" placeholder="Email">
          <input name="password" type="password" placeholder="Password">
          <input type="submit" value="Login">
        </form>
        <a href="">Forgot password?</a>
      </div>
      <div class="register-show">
        <h2>REGISTER</h2>
        <input type="text" placeholder="Email">
        <input type="password" placeholder="Password">
        <input type="password" placeholder="Confirm Password">
        <!-- <input type="button" value="Register"> -->
        <a href="register.html"> Register</a>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>



  <script  src="js/index.js"></script>




</body>

</html>
