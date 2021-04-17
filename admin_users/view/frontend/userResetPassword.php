<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users List</title>
    <link type="text/css" rel="stylesheet" href="/admin_users/public/css/bootstrap.min.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="/css/header.css" />
    <link type="text/css" rel="stylesheet" href="/admin_users/public/css/style.css" />
  </head>
  <body>
  <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
  <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><span class="font-weight-bold">Id base de données : <?php echo $userData['id'] ?></span><img class="rounded-circle mt-5" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQF2psCzfbB611rnUhxgMi-lc2oB78ykqDGYb4v83xQ1pAbhPiB&usqp=CAU"><span class="text-black-50"><?php echo $userData['pseudo'] ?></span><span> </span></div>
      </div>
      <div class="col-md-4">
        <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center experience"><span>Editer le mot de passe :</span><button class="btn btn-primary profile-button" onclick="window.location='/admin_users/index.php'">Retour</button></div><br>
          <form method="post" action="index.php">
            <input type="hidden" name="id" value="<?php echo $userData['id'] ?>" />
            <div class="col-md-12"><label for="password" class="labels">Mot de passe</label><input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe" value="" required></div> <br>
            <div class="col-md-12"><label for="confirmPassword" class="labels">Confirmer le mot de passe</label><input type="password" name="confirmPassword" class="form-control" placeholder="Confirmer le nouveau mot de passe" value="" required></div>
            <div id="submission">
              <input class="btn btn-primary profile-button" type="submit" name="resetPasswordUser" value="Valider les changements" />
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-5 border-right">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-right">Profil utilisateur :</h3>
          </div>
          <div class="row mt-2">
            <div class="col-md-6"><label class="labels">Nom</label><span class="form-control"><?php echo $userData['nom'] ?></span></div>
            <div class="col-md-6"><label class="labels">Prénom</label><span class="form-control"><?php echo $userData['prenom'] ?></span></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Addresse Email</label><span class="form-control"><?php echo $userData['email'] ?></span></div>
            <div class="col-md-12"><label class="labels">Date D'entrée</label><span class="form-control"><?php echo $userData['signupDate'] ?></span></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6"><label class="labels">Compte banni?</label>
            <span class="form-control">
              <?php
              if (htmlspecialchars($userData['isBan']) == 0) {
                echo "non";
              } else {
                echo "oui";
              }
              ?>
            </span></div>
            <div class="col-md-6"><label class="labels">Compte admin?</label>
            <span class="form-control">
              <?php
              if (htmlspecialchars($userData['isAdmin']) == 0) {
                echo "non";
              } else {
                echo "oui";
              }
              ?>
            </span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>

