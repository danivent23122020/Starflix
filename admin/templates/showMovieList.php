<?php require("formSearchMovie.php");?>
<h1>LISTE FILMS</h1>


<table class="table text-white">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Date de sortie</th>
        <th>Synopsis</th>
        <th>Image</th>
        <th>Actions</th>


    </tr>
    </thead>
    <tbody>


    <?php
    if (isset($results)){
        foreach ($results as $result) {
            ?>
            <tr>
                <td><?php echo $result['title']; ?></td>


                <td><?php if (array_key_exists('releaseDate', $result)) {
                        echo $result['releaseDate'];
                    }?> </td>

                <td><?php echo $result["description"]; ?></td>
                <td><?php if ($result['posterImg'] === null) {
                        echo "<p>Pas d'image associée.</p>";
                    } else { ?>
                        <img src="<?php echo $result['posterImg']; ?>" class="posterImg">

                        <?php
                    }

                    ?>
                </td>
                <td>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="deleteMovie" value="<?= $result["id"] ?>">
                        <input  type="submit" class="btn btn-danger" value="Supprimer">
                    </form>
                </td>

            </tr>

            <?php
        }



    }
    ?>

    </tbody>
</table>
