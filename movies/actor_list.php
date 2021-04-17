

<div class="container">
    <div class="row ">  
        <?php $actors = new Actors(); ?>
        <?php if ($actors->getActors()) : ?>
            <?php foreach ($actors->getActors() as $actor) : ?>
                <div class="actor-info col-xl-2 mt-5">
                    <a href="actor_info.php?id=<?= $actor['id'] ?>">
                        <img src="<?= $actor['posterImg'] != null ? $actor['posterImg'] : 'images/no-image.jpg' ?>" width="220" id="img1" alt="Poster Movie">
                    </a>
                    <h4 class="mt-3"><?= $actor['name'] ?></h4>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
        <?php endif; ?>
    </div>
</div>

