<?php
function researchUser($research)
{
    $db = dbConnect();
    $req = $db->query('SELECT * FROM users WHERE email LIKE "%'.$research.'%" ORDER BY id DESC');
    if($req->rowCount() == 0) {
      $req = $db->query('SELECT * FROM users WHERE CONCAT(id, nom, prenom, email, signupDate) LIKE "%'.$research.'%" ORDER BY id DESC');
    }
    return $req;
}

function getUsersList()
{
    $db = dbConnect();
    $req = $db->query('SELECT * FROM users');
    return $req;
}

function getUserUpdate($userId)
{
    $req = getUsersList();
    while ($userData = $req->fetch())
        {
            if ($userId == $userData['id']) {
              return $userData;
            }
        }
}

function setUserUpdate($userId, $userPassword)
{
    $passwordHash = sha1($userPassword);
    $db = dbConnect();
    $req = $db->prepare('UPDATE users SET password = :newPassword WHERE id = :id');
    $req->execute(array(
      'id' => $userId,
      'newPassword' => $passwordHash));
    return $req;
}

function setBanUser($userId)
{
  $userData = getUserUpdate($userId);

    if ($userData['isBan'] === '0') {
      $req = dbConnect()->prepare('UPDATE users SET isBan = :isBan WHERE id = :id');
      $req->execute(array(
        'id' => $userId,
        'isBan' => '1'));
      return $req;
    }
    else {
      $req = dbConnect()->prepare('UPDATE users SET isBan = :isBan WHERE id = :id');
      $req->execute(array(
        'id' => $userId,
        'isBan' => '0'));
      return $req;
    }
}

function deleteUser($userId)
{
    $db = dbConnect();
    $sql = $db->prepare('DELETE FROM users WHERE id = :id');
    $sql->execute(array(
      'id' => $userId));
    $db->exec($sql);
    return $sql;
}

function dbConnect()
{
  define('DB_SERVER', 'sql364.main-hosting.eu');
  define('DB_USERNAME', 'u949344532_starflix');
  define('DB_PASSWORD', 'x0K??+5K');
  define('DB_NAME', 'u949344532_starflix');

  try
  {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }
  catch(PDOException $e)
  {
  die("ERROR: Could not connect. " . $e->getMessage());
  }
}


