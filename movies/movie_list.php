
<?php $movies = new Movies(); ?>
<?php if ($movies->getMovies()  ) : ?>
    <?php foreach ($movies->getMovies() as $movie) : ?>
        
        <div class="col-xl-2 mt-5">
            <a href="movie_info.php?id=<?= $movie['id'] ?>">
                <img src="<?= $movie['posterImg'] != null ? $movie['posterImg'] : 'images/no-image.jpg' ?>" width="220" id="img1" alt="Poster Movie">
            </a>
        </div>

    <?php endforeach; ?>
<?php else : ?>
    <h1>Sorry ! No Database at the moment...</h1>
<?php endif; ?>

