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

$idUser = $_SESSION['userID'];

require_once 'includes/autoloader.inc.php';
include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");
?>

<?php $movies = new Movies(); ?>

<div class="container-fluid movie-favorite-contain">
    <div class="favorite-movie">
        <div class="row no-gutters movie-favorite">               
            <h5 class="">VOS FILMS FAVORIS</h5>

            <?php foreach ($movies->getMovieFavorite() as $movieFavourite) : ?>
                    <?php if ($movieFavourite['idUser'] == $idUser) : ?>
                        <?php foreach ($movies->getMovies() as $movie) : ?>
                            <?php if ($movie['id'] === $movieFavourite['idMovie']) : ?>
                                <div class=" ui-card col-xl-2 mt-5 me-4" id="delete<?= $movie['id'] ?>">
                                    <a href="movie_info.php?id=<?= $movie['id'] ?>">
                                        <img src="<?= $movie['posterImg'] != null ? $movie['posterImg'] : 'images/no-image.jpg' ?>" width="220" id="img1" alt="Poster Movie">
                                    </a>
                                
                                    <div class="description-movie">
                                        <h3><?= $movie['title'] ?></h3>
                                        <button type="submit" class="btn btn-success"  onclick="deleteMovieFav(<?= $movie['id'] ?>)" id="btn_delete_record">DELETE</button>  
                                    </div>
                                </div>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>  
</div>


<script type="text/javascript">

    function deleteMovieFav(id) {
        
        console.log(id)

            $.ajax({
                type:'POST',
                url:'includes/deleteMovieFavorite.php',
                data:{delete_id:id},
                success:function(data){
                    $('#delete'+id).hide('slow');
                }
            })
        
    }

</script>

<?php
require_once ('footer.php');
?>

</body>
</html>