<?php
session_start();
// include 'includes/database.php';


// ===================
// on appelle la connexion à la BDD
// $database =getPDO();

// ============================= HTML =============================
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ec755d5e9f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" media="screen" type="text/css" href="../login_signup/css/header.css" /> -->
    <link rel="stylesheet" media="screen" type="text/css" href="/css/header.css" />
    <link rel="stylesheet" href="css/aboutUs.css">
    <title>About us</title>
</head>

<body>


<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
       
        <!-- section -->

<div class="container">
    <div class="row">
        <div class="presentation">
            <h3 class="mt-5  mb-5">PRESENTATION</h3>
        </div>
    </div>
</div>

<section class="aboutUs-infos">

    <!-- informations Daniel -->
    <article class="statusession">
        <div class="about-nom">
            <h3>Daniel</h3>
            <h2>Ventura</h2>
        </div>
        <span class="line"></span>
        <section class="profilUser">
            <p>Parties traitées :
            <ul>
                <li>inscription</li>
                <li>connexion</li>
                <li>déconnexion</li>
                <li>infos utilisateur</li>
                <li>about us</li>
            </ul>
            </p>
            <p>Parties traitées :
            <ul>
                <li>HTML5</li>
                <li>CSS3</li>
                <li>PHP/MySQL</li>
            </ul>
            </p>
        </section>
    </article>

    <!-- informations Alexandre -->
    <article class="statusession">
        <div class="about-nom">
            <h3>Alexandre</h3>
            <h2>Chiquet</h2>
        </div>
        <span class="line"></span>
        <section class="profilUser">
            <p>Parties traitées :
            <ul>
                <li>Accueil Espace Admin</li>
                <li>Ajout/Suppression de films</li>
                <li>Création/Gestion de la BDD</li>
            </ul>
            </p>
            <p>Parties traitées :
            <ul>
                <li>HTML5</li>
                <li>CSS3</li>
                <li>Javascript</li>
                <li>PHP/MySQL</li>
            </ul>
            </p>
        </section>
    </article>

    <!-- informations Daho -->
    <article class="statusession">
        <div class="about-nom">
            <h3>Daho</h3>
            <h2>NAHLA</h2>
        </div>
        <span class="line"></span>
        <section class="profilUser">
            <p>Parties traitées :
            <ul>
                <li>Liste des films</li>
                <li>Info d'un film</li>
                <li>CSS général du site</li>
                <li>Systéme de commentaire</li>
                <li>Ajout d'un film dans favoris</li>
            </ul>
            </p>
            <p>Langages utilisés :
            <ul>
                <li>HTML5</li>
                <li>CSS3</li>
                <li>PHP/MySQL</li>
                <li>AJAX</li>
            </ul>
            </p>
        </section>
    </article>

    <!-- informations Hicham -->
    <article class="statusession">
        <div class="about-nom">
            <h3>Hicham</h3>
            <h2>ZAROURI</h2>
        </div>
        <span class="line"></span>
        <section class="profilUser">
            <p>Parties traitées :
            <ul>
                <li>Recherche de film</li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            </p>
            <p>Langages utilisés :
            <ul>
                <li>HTML5</li>
                <li>CSS3</li>
                <li>PHP/MySQL</li>
            </ul>
            </p>
        </section>
    </article>

    <!-- informations Mikhaïl -->
    <article class="statusession">
        <div class="about-nom">
            <h3>Mikhaïl</h3>
            <h2>NAIDJI</h2>
        </div>
        <span class="line"></span>
        <section class="profilUser">
            <p>Parties traitées :
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            </p>
            <p>Langages utilisés :
            <ul>
                <li>HTML5</li>
                <li>CSS3</li>
                <li>PHP/MySQL</li>
            </ul>
            </p>
        </section>
    </article>
</section>
        <!-- ====== -->
        <!-- footer -->
<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/footer.php");
?>

</body>

</html>