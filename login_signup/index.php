<?php
session_start();
include 'includes/database.php';

// on appelle la connexion à la BDD
// $database = getPDO();
// appel de tous les éléments de la base
// $members = $database->query('SELECT * FROM users'); 


// ======================= HTML ==========================
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/menu-nav.css"> -->
    <script src="https://kit.fontawesome.com/ec755d5e9f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" media="screen" type="text/css" href="../login_signup/css/header.css" /> -->
    <link rel="stylesheet" media="screen" type="text/css" href="/css/header.css" />

    <link rel="stylesheet" href="css/index.css">
    <title>STARFLIX VOD</title>
</head>

<body>
    <!--======-->
    <!-- main -->
    <main>
        <!--========-->
        <!-- navbar -->
        <!-- <?php // include 'header.php'; ?> -->
        <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
        <!-- ======= -->
        <!-- section -->
        <section class="index">
            <!-- ========================= -->
            <!-- inforamtions personnelles -->
            <article id="statusession">
                <!-- vérification de connexion -->
                <?php if(isset($_SESSION['userEmail'])) {  ?>
                <h3>Bienvenue sur votre page d'accueil.</h3>
                <h3 style="color: green;">Bonjour,
                    <?= $_SESSION['userPrenom'] ?>
                    <?= $_SESSION['userNom'] ?> !
                </h3>
                <h2>Vos films préférés sont ici !</h2>
                <?php  } else { ?>
                <h3>Vous n'êtes pas connecté</h3>
            </article>
            <?php } ?>
        </section>
        <!-- ====== -->
        <!-- footer -->
        <?php
    // include 'footer.php';
    include_once($_SERVER["DOCUMENT_ROOT"] . "/footer.php");
        ?>
    </main>
</body>

</html>