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
    <h2>Comptes utilisateur :</h2>
    <div class="d-flex justify-content-between align-items-center experience">
    <form method="GET">
      <input type="search" name="research" placeholder="Recherche..." />
      <input class="btn btn-primary profile-button" type="submit" value="Valider" />
    </form>
      <button class="btn btn-primary profile-button" onclick="window.location='/admin_users/index.php'">Retour</button>
    </div><br>
    <table id="no-more-tables" class="table table-striped table-bordered table-sm col-sm-12 table-condensed cf" cellspacing="0" width="100%">
      <thead class="cf">
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Date d'entrée</th>
          <th>Compte banni?</th>
          <th>Bannir le compte</th>
          <th>Réinitialiser le mot de passe</th>
          <th>Supprimer le compte</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $users->fetch(PDO::FETCH_ASSOC)) : ?>
        <form action="index.php" method="post">
          <tr>
          <td data-title="ID"><?php echo htmlspecialchars($row['id']); ?></td>
          <td data-title="Nom"><?php echo htmlspecialchars($row['nom']); ?></td>
          <td data-title="Prénom"><?php echo htmlspecialchars($row['prenom']); ?></td>
          <td data-title="Email"><?php echo htmlspecialchars($row['email']); ?></td>
          <td data-title="Date d'entrée"><?php echo htmlspecialchars($row['signupDate']); ?></td>
          <td data-title="User banni?">
            <?php
            if (htmlspecialchars($row['isBan']) == 0) {
              echo "non";
            } else {
              echo "oui";
            }
            ?>
          </td>
          <td data-title="Bannir">
            <button type='submit' name='BanUser[]' value='<?php echo htmlspecialchars($row['id']); ?>'><img src="/admin_users/public/images/ban.png" /></button>
          </td>
          <td data-title="Modifier">
            <button type='submit' name='updateUser[]' value='<?php echo htmlspecialchars($row['id']); ?>'><img src="/admin_users/public/images/updateUser.png" /></button>
          </td>
          <td data-title="Supprimer">
            <button type='submit' name='deleteUser[]' value='<?php echo htmlspecialchars($row['id']); ?>'><img src="/admin_users/public/images/deleteUser.png" /></button>
          </td>
        </tr>
        </form>

        <?php endwhile; ?>
      </tbody>
    </table>
    </div>
    
  </body>
</html>
