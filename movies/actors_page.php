<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/ec755d5e9f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="/css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <title><?= "Admin" ?></title>
</head>
<body>


<?php
session_start();
require_once 'includes/autoloader.inc.php';
include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");
?>

<div class="container-fluid">

    <div class="popular">
        <div class="row no-gutters">
        <h5 class="">MOVIE ACTORS</h5>
            <?php require_once('actor_list.php'); ?>
        </div>
        </div>
    </div>
</div>


<?php
require_once ('footer.php');
?>

</body>
</html>