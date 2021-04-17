<?php

class Movies extends DbConn {

    public function getMovies() {
        $sql = "SELECT id, title, runtime, description, releaseDate, posterImg FROM movies";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        

        $req = $stmt->fetchAll();
       return $req;
        $stmt->closeCursor();
    }

    // public function getMoviesId($id) {

    //     $data = null;
    //     $sql = "SELECT * FROM movies WHERE id = '$id'";
    //     if($stmt = $this->connect()->prepare($sql)) {
    //         while($row = $stmt->fetch()) {
    //             $data = $row;
    //         }
    //     }
        
    //     return $data;
        
    // }
    
    public function setMovieFavorite() {
        if (isset($_POST['addMovieSubmit'])) {
                
            $id_user = $_POST['idUser'];
            $id_movie = $_POST['idMovie'];
 
            $sql = "INSERT INTO users_favorites (idUser, idMovie) VALUES ('$id_user', '$id_movie')";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

        }
    }


    public function getMovieFavorite() {
     
        $sql = "SELECT idUser, idMovie FROM users_favorites";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    
    }

    public function getGenreWithMovie() {
        $sql = "SELECT idMovie, idGenre FROM link_movies_genres";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function getGenre() {
        $sql = "SELECT id, name FROM genres";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function countMoviesFavorites() {
        $sql = "SELECT COUNT(*) FROM users_favorites";
        $stmt = $this->connect()->query($sql);
        $count = $stmt->fetchColumn();
        $stmt->execute();
        
        return $count;
        
    }
}

?>

