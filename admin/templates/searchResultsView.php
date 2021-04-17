<?php require("formAddMovie.php");?>

<table class="table text-white">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Date de sortie</th>
        <th>Synopsis</th>
        <th>Image</th>
        <th>Détails</th>

    </tr>
    </thead>
    <tbody>


    <?php
    if (isset($results)){
        foreach ($results as $result) {
            ?>
            <tr>
                <td><?php echo $result['title']; ?></td>

                <td><?php if (array_key_exists('release_date', $result)) {
                        echo $result['release_date'];
                    }?> </td>

                <td><?php echo $result["overview"]; ?></td>

                <td><?php if ($result['poster_path'] === null) {
                        echo "<p>Pas d'image associée.</p>";
                    } else { ?>
                        <img src="http://image.tmdb.org/t/p/w185<?php echo $result['poster_path']; ?>">

                        <?php
                    }

                    ?>
                </td>

                <td><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . "?movie=" . $result['id'];  ?>"><input type="button" value="Détails" class="btn btn-primary"></a></td>
            </tr>

            <?php
        }



    }
    ?>

    </tbody>
</table>


