<?php

$movie_id = $_POST['delete_id'];

$bdd = new PDO('mysql:host=sql364.main-hosting.eu;dbname=u949344532_starflix;charset=utf8mb4', 'u949344532_starflix', 'x0K??+5K', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$resultat = $bdd->query("DELETE FROM users_favorites WHERE idMovie='$movie_id'");

?> 
