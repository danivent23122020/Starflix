<?php
session_start();

$_SESSION['userID'];

require("bdd.php"); 
include("index.php");
?>

<div class="movies-box text-white">
    <?php
        //Prepare la requête
        $search = "%" .$_POST['search']. "%";
        $req = "SELECT * FROM movies WHERE title LIKE :search";
        $movies = $pdo->prepare($req);
        $movies->bindParam(":search", $search, PDO::PARAM_STR);
        $movies->execute();
            
        while ($movie = $movies->fetch()) {
    ?>

        <!-- // Affiche la recherche -->
        <h3><?php echo $movie['title'] ?></h3>
        <img src="<?php echo $movie['posterImg'] ?>" class="image" width="350px"/>

        <!-- Bouton qui envoie la data à la BDD-->
        <form name="form" action="" method="post">
            <input type="hidden" name="idUser" value="<?php echo $_SESSION['userID'] ?>"/>
            <input type="hidden" name="idMovie" value="<?php echo $movie['id'] ?>"/>
            <button type="submit" id="btn" name="btn_play" class="btn btn-danger col-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Lecture</button>
        </form>
        <hr>

        <?php
            if (isset($_POST['btn_play'])) {
                $id_user = $_POST['idUser'];
                $id_movie = $_POST['idMovie'];

                // Préparation de la requête d'insertion SQL
                $stmt = $pdo->prepare("INSERT INTO users_history (idUser, idMovie) VALUES (:idUser, :idMovie)");
                // On lie chaque marqueur à une valeur
                $stmt->bindParam(':idUser', $id_user, PDO::PARAM_STR);
                $stmt->bindParam(':idMovie', $id_movie, PDO::PARAM_STR);
                // Éxécution de la requête préparée
                $stmt->execute();        
            }
        ?>

    <?php
        }
    ?>
</div>

<?php
include('footer.php')
?>