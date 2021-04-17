<?php
$datas = $_SESSION["datas"];
$datasMovie = $datas["datasMovie"];
$genres = $datas["genres"];
$posterImg = $datas["posterImg"];
$backdropImg = $datas["backdropImg"];
$actors = $datas["actors"];
$directors = $datas["directors"];

?>

<style>
    .container {
        background: center / cover no-repeat url("<?=$backdropImg;?>");
        background-color: rgba(255,255,255,0.5);
        background-position: top;
        background-blend-mode: lighten;
    }


</style>
<body>

<div class="container text-dark">
    <div class="infos-wrapper d-flex flex-column mt-5">
        <div class="main-infos d-flex justify-content-around">
            <div class="main-infos-left">            
                <h1><?= $datasMovie["title"]; ?></h1>
                <p><?= $datasMovie["release_date"]; ?> | <?= floor($datasMovie["runtime"]/60) . "h". $datasMovie["runtime"]%60 . "mins" ?></p>
                <img src="<?=  $posterImg ?>" class="infos-poster">
            </div>
            <div class="main-infos-right">
                <p class="text-justify font-weight-bold"><?= $datasMovie["overview"] ?></p>
            </div>

        </div>

        <div class="d-flex flex-column directors mt-5">
        <h2>Réalisateurs</h2>

            <div class="directors-list d-flex">
                <?php
                foreach ($directors as $director){
                    ?>
                    <div class="d-flex flex-column m-3">
                        <img src="<?= 'http://image.tmdb.org/t/p/w185' . $director["profile_path"]; ?>" class="directors-poster">
                        <p class="text-center"><?= $director["name"]; ?></p>

                    </div>

                    <?php
                }

                ?>
            </div>
           
        </div>

        <div class="d-flex flex-column actors">
            <h2>Acteurs</h2>
            <div class="actors-list d-flex">
                <?php
                foreach ($actors as $actor){
                    ?>
                    <div class="d-flex flex-column m-3">
                        <img src="<?= 'http://image.tmdb.org/t/p/w185' . $actor["profile_path"]; ?>">
                        <p class="text-center"><?= $actor["name"]; ?></p>
                    </div>

                    <?php
                }

                ?>
            </div>

        </div>

        <form action="index.php" method="post" class="align-self-center">
            <input type="hidden" name="sendDB">
            <input type="submit" value="Ajouter" class="btn btn-primary p-3">
        </form>
    </div>



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>