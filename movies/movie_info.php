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

include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");
require_once 'includes/autoloader.inc.php';
date_default_timezone_set('Europe/Paris');
?>

<?php $movies = new Movies(); ?>
<?php $movieGenre = new Movies(); ?>
<?php 

$movieFavorie = new Movies(); 
$idMovieFavorite = $movieFavorie->getMovieFavorite();


?>
<?php $actors = new Actors(); ?>
<?php $comments = new Comments(); ?>
<?php $users = new Users(); ?>


<!--  MOVIE INFO  -->
<?php $id = $_GET['id']; ?>
<?php foreach($movies->getMovies() as $movie) : ?>
    <?php if ($movie['id'] == $id) : ?>
        
        <div class="container mt-5">
            <div class="movie-info">
                <div class="row "> 
                    <div class="col-md-6 mt-5">
                        <div class="bg-image">            
                            <img
                                height="513px" width="342px"
                                src="<?= $movie['posterImg'] != null ? $movie['posterImg'] : 'images/no-image.jpg' ?>"
                                class="img-fluid"
                            />
                            <img src="images/play.png" class="play-btn" width="80" alt="Play Button" data-bs-toggle="modal" data-bs-target="#play-trailer">
                        </div>
                    </div>

                    <div class="movie-info-text col-md-6 mt-5">
                        <h3 class=""><?= $movie['title'] ?></h3>
                        <h5 class="mt-4"><?= $movie['releaseDate'] ?></h5>

                        <?php  
                            $hours = floor($movie['runtime'] / 60);
                            $minutes = $movie['runtime']  % 60; 
                        ?>

                        <h5 class="mt-4"><?= $hours ?>h <?= $minutes ?>m</h5>
                        <p class="mt-5">
                            <?= $movie['description'] ?>
                        </p>
                        <div class="container movie-genre-container mt-5">
                                <div class="movie-genre d-flex flex-row "> 
                                    
                                    <?php foreach($movieGenre->getGenreWithMovie() as $idGenre) : ?>
                                        <?php if($idGenre['idMovie'] === $id) :?>
                                            <?php foreach($movieGenre->getGenre() as $genre) :  ?>
                                                <?php if($idGenre['idGenre'] === $genre['id']) :?>
                                    
                                                <p class="movie-genre-info"><?= $genre['name'] ?></p>

                                    
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    
                            </div>
                        </div>
                        <div class="movie mt-0">
                            <button type="button" class="btn button-action disabled"><i class="fa fa-play"></i>PLAY</button>
                            <form method="POST" id="addMovieFavoriteList">
                                <input type='hidden' name='idMovie' value='<?= $id ?>'>
                                <input type='hidden' name='idUser' value='<?= $idUser ?>'>

                                <?php if($idUser !== null) : ?>
                                    <input type="button" id="addMovieFavorite"  class="btn button-action ms-2" value="AJOUTER" onclick="addMovieFavoriteList()">
                                <?php endif;?>

                            </form>
                        </div>
                    </div>
                </div>    
            </div>
    

            <!-- ACTOR LIST  -->
            <div class="movie-info-actor mt-5 mb-5">
                <div class="row "> 
                    <h3 class="mt-5">ACTEURS</h3>

                    <?php foreach($actors->getActorWithMovie() as $idActor) : ?>
                        <?php if($idActor['idMovie'] === $id) : ?>
                            <?php foreach($actors->getActors() as $actor) : ?>
                                <?php if($idActor['idActor'] === $actor['id']) : ?>

                                    <div class="actor-info col-xl-2 mt-5">
                                        <a href="actor_info.php?id=<?= $actor['id'] ?>">
                                            <img src="<?= $actor['posterImg'] != null ? $actor['posterImg'] : 'images/no-image.jpg' ?>" width="180" id="img1" alt="Poster Movie">
                                        </a>
                                        <p class="mt-3"><?= $actor['name'] ?></p>
                                    </div>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>


        <!-- Modal Video -->
        <div class="modal fade" id="play-trailer">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modal-video ">
                    <div class="modal-body">
                    <iframe 
                        width="560" height="315" 
                        src="https://www.youtube.com/embed/nalLU8i4zgs" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                    >
                    
                    </iframe>
                    </div>
                </div>
            </div>
        </div>

    <?php endif;?>
<?php endforeach; ?>    


<!-- COMMENT POST/SET -->

<div class="container comment mt-5 mb-5">
    <div class="row">
        <h5 class="mt-4 ms-4">COMMENTAIRES</h5>

        <?php if ($idUser ) : ?>
            
            <form class="comment-form" method='POST' action='<?= $comments->setComments() ?>'>
                <input type='hidden' name='idMovie' value='<?= $id ?>'>
                <input type='hidden' name='idUser' value='<?= $idUser ?>'>
                <input type='hidden' name='date' value='<?= date('Y-m-d H:i:s') ?>'>
                <textarea name='message' placeholder="Commentaire" id="text_message" ></textarea>
            
                <button type='submit' name='commentSubmit'>POST</button>

            </form>
            
            <?php else : ?>
                <div class="comment-erreur">
                    <h2>Veuillez vous connecter pour poster un commentaire</h2>
                </div>
        <?php endif; ?>
    </div>


<!-- COMMENT POST/GET -->

    <div class="comment-post">
        <?php if ($comments->getComments() != null) : ?>
            <?php foreach ($comments->getComments() as $comment) : ?>
                <?php if ($comment['idMovie'] === $id) : ?>
                    <?php foreach ($users->getUsers() as $user) :?>
                        <?php if ($comment['idUser'] === $user['id']) : ?>

                            <div class="comment-result" id="delete<?= $comment['id'] ?>">
                                <div class="comment-result-user">
                                    <h5><?= $user['pseudo'] ?></h5>
                                    <p><?= $comment['date'] ?></p>

                                    <?php if($idUser  == $comment['idUser'] ) : ?>
                                        <button type="submit" class="btn button-action"  onclick="deleteComment(<?= $comment['id'] ?>)">DELETE</button>
                                    <?php endif; ?>
                                    
                                </div>
                                <p><?= $comment['message'] ?></p>
                                <span class="comment-line"></span>
                            </div>

                        <?php endif; ?> 
                    <?php endforeach; ?>
                <?php endif; ?>         
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>


<script type="text/javascript">

    function deleteComment(id) {

        $.ajax({
            type:'POST',
            url:'includes/commentDelete.php',
            data:{commentDelete:id},
            success:function(data){
                $('#delete'+id).hide('slow');
            }
        })
        
    }

    function addMovieFavoriteList(){

        const Toast = Swal.mixin({
            toast: true,
            width:'25rem',
            padding: '3rem',
            position: 'center',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Film ajouter'
            
        })

        $.ajax({
            type:'POST',
            url:'includes/addMovieFavorite.php',
            data:$('#addMovieFavoriteList').serialize(),
            success:function(data){
                
            }
        })
    }

    function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }


</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php
require_once ('footer.php');
?>

</body>
</html>