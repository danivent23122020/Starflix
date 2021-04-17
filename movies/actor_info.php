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
include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");
require_once 'includes/autoloader.inc.php';
?>

<?php $movies = new Movies(); ?>
<?php $actors = new Actors(); ?>


<?php

$id = $_GET['id'];
foreach($actors->getActors() as $actor) : 
    if ($actor['id'] == $id) :

?>
<div class="container mt-5">
    <div class="actor-info">
        <div class="row ">     
            <div class="col-md-6 mt-5">
                <div class="bg-image">            
                    <img
                        height="513px" width="342px"
                        src="<?= $actor['posterImg'] ?>"
                        class="img-fluid"
                    />
                </div>
            </div>
            <div class="actor-info-text col-md-6 mt-5">
                <h3 class=""><?= $actor['name'] ?></h3>
                <h4 class="mt-5">Biographie</h4>
                <p class="mt-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et cursus risus. 
                    Integer ut velit eu justo consequat vulputate. Phasellus eu rutrum neque. Nulla efficitur, lorem ut tempor condimentum,
                    ex orci commodo enim, posuere fermentum felis velit non dolor. Sed neque magna, tempor ut augue at, pellentesque consequat lectus. 
                    Sed luctus eleifend rhoncus. In consectetur auctor condimentum. Curabitur diam felis, ultrices quis nunc at, ullamcorper luctus tortor. 
                </p>
            </div>
        </div>
    </div>


<?php
    endif;
endforeach;
?>


    <div class="actor-info-filmo mt-5 mb-5">
        <div class="row"> 
            <h3 class="mt-5">FILMOGRAPHIE</h3>

            <?php foreach($actors->getActorWithMovie() as $idMovieActor) : ?>
                <?php if($idMovieActor['idActor'] === $id) : ?>
                    <?php foreach($movies->getMovies() as $movie) : ?>
                        <?php if($idMovieActor['idMovie'] === $movie['id']) : ?>

                            <div class="actor-info col-xl-2 mt-5">
                                <a href="movie_info.php?id=<?= $movie['id'] ?>">
                                    <img
                                        height="513px" width="342px"
                                        src="<?= $movie['posterImg'] ?>"
                                        class="img-fluid"
                                    />
                                </a>
                                <p class="mt-3"><?= $movie['title'] ?></p>
                            </div>
                            
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
require_once ('footer.php');
?>

</body>
</html>