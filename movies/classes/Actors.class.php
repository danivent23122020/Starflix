

<?php

class Actors extends DbConn {

    public function getActors() {
        $sql = "SELECT id, name, posterImg FROM actors";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
        
    }

    public function getActorWithMovie() {
        $sql = "SELECT idMovie, idActor FROM link_movies_actors";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();

    }
}

?>
