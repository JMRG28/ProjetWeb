<?php
include "Membre.php";
include 'header.php';
session_start();
$member=unserialize($_SESSION['member']);
$member->toString();
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title> <?php echo $member->Prenom." ".$member->Nom; ?></title>
  <meta name="viewport"
  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/style_profile.css">

</head>

<body>
  
 <div class="wrapper">
  <div class="profile-card js-profile-card">
    <div class="profile-card__img">
      <img src="<?php echo $member->Photo;?>" alt="profile card">
    </div>

    <div class="profile-card__cnt js-profile-cnt">

      <div class="profile-card__name"> <?php echo $member->Prenom." ".$member->Nom; ?> </div>
      <div class="profile-card__txt"><?php echo $member->Statut; ?></div>
      <div class="profile-card__txt"><strong>"</strong><?php echo $member->Description; ?><strong>"</strong></div>
      <div class="profile-card-loc">
        <span class="profile-card-loc__icon">
          <svg class="icon"><use xlink:href="#icon-location"></use></svg>
        </span>

        <span class="profile-card-loc__txt">
          <?php echo $member->CodePostal; ?>
        </span>

      </div>
      Inscrit depuis : <?php echo $member->DateIns; ?>
      <div class="profile-card-inf">
        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title"><?php echo $member->Recu; ?></div>
          <div class="profile-card-inf__txt">demandes</div>
        </div>

        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title"><?php echo $member->Recu; ?></div>
          <div class="profile-card-inf__txt">propositions</div>
        </div>
      </div>

      <div class="profile-card-ctr">
        <button class="profile-card__button button--blue js-message-btn">Message</button>
        <button class="profile-card__button button--orange">Follow</button>
      </div>
    </div>

    <div class="profile-card-message js-message">
      <form class="profile-card-form">
        <div class="profile-card-form__container">
          <textarea placeholder="Say something..."></textarea>
        </div>

        <div class="profile-card-form__bottom">
          <button class="profile-card__button button--blue js-message-close">
            Send
          </button>

          <button class="profile-card__button button--gray js-message-close">
            Cancel
          </button>
        </div>
      </form>

      <div class="profile-card__overlay js-message-close"></div>
    </div>
  </div>
</div>

<script  src="js/profile.js"></script>

</body>
</html>
