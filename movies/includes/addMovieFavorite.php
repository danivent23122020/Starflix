<?php


$bdd = new PDO('mysql:host=sql364.main-hosting.eu;dbname=u949344532_starflix;charset=utf8mb4', 'u949344532_starflix', 'x0K??+5K', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$id_user = $_POST['idUser'];
$id_movie = $_POST['idMovie'];

$resultat = $bdd->query("INSERT INTO users_favorites (idUser, idMovie) VALUES ('$id_user', '$id_movie')");


?> 