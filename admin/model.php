<?php

define('API_KEY', 'baa76949d594ee68b088f6165c3753d4');



define('DB_SERVER', 'sql364.main-hosting.eu');
define('DB_USERNAME', 'u949344532_starflix');
define('DB_PASSWORD', 'x0K??+5K');
define('DB_NAME', 'u949344532_starflix');


function dbConnect(){
    try{
        /* Attempt to connect to MySQL database */
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
}


function getMovie($idMovie){

    $movie_details_request = file_get_contents('https://api.themoviedb.org/3/movie/' . $idMovie . '?api_key=' . API_KEY .'&language=fr-FR');
    $actors_request = file_get_contents('https://api.themoviedb.org/3/movie/'. $idMovie . '/credits?api_key=' . API_KEY . '&language=en-US');
    $datasMovie = json_decode($movie_details_request, true);
    $datasActors = json_decode($actors_request, true);
    $genres = $datasMovie["genres"];
    $posterImg = 'http://image.tmdb.org/t/p/w342' . $datasMovie["poster_path"];
    $backdropImg = 'http://image.tmdb.org/t/p/original' . $datasMovie["backdrop_path"];


    $actors = array_slice($datasActors["cast"], 0, 5);
    $directors = array();
    foreach ($datasActors["crew"] as $crew) {
        if ($crew["job"] === "Director") {
            array_push($directors, $crew);
        }
    }
    return array("datasMovie" => $datasMovie, "genres" => $genres, "posterImg" => $posterImg, "backdropImg" => $backdropImg, "actors" => $actors, "directors" => $directors);
}

function searchMovieAPI($query){
    $search_movie = 'https://api.themoviedb.org/3/search/movie?api_key=' . API_KEY . '&language=fr-FR&query=' . urlencode($query) .'&page=1&include_adult=false';
    $api_request = file_get_contents($search_movie);
    $datas = json_decode($api_request, true);
    return $datas['results'];
}

function addNewMovie($datas) {
    if (checkMovie($datas["datasMovie"])) {
        addMovie($datas["datasMovie"]);

        foreach ($datas["actors"] as $actor) {
            if (!checkActor($actor)) {
                addActor($actor);
            }
            linkActMov($actor["id"], $datas["datasMovie"]["id"]);
        }

        foreach ($datas["directors"] as $director) {
            if (!checkDirector($director)) {
                addDirector($director);
            }
            linkDirMov($director["id"], $datas["datasMovie"]["id"]);
        }
        foreach ($datas["genres"] as $genre) {
            linkGenMov($genre["id"], $datas["datasMovie"]["id"]);
        }

        return true;
    }
    else {
        return false;
    }
}

function checkMovie($datasMovie) {
    $pdo = dbConnect();
    $sql = "SELECT id FROM movies WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $datasMovie["id"]);

        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                return false;
            } else{
                return true;
            }
        } else{
            return "Quelque chose s'est mal passé ! Veuillez réessayer.";
        }
    }
    return "Quelque chose s'est mal passé ! Veuillez réessayer.";
}

function checkActor($actor) {
    $pdo = dbConnect();
    $sql = "SELECT id FROM actors WHERE id = :id";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":id", $actor["id"]);

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    return true;
                } else {
                    return false;
                }
            } else{
                return "Quelque chose s'est mal passé ! Veuillez réessayer.";
            }

        }

    return "Quelque chose s'est mal passé ! Veuillez réessayer.";
}

function checkDirector($director) {
    $pdo = dbConnect();
    $sql = "SELECT id FROM directors WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $director["id"]);

        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                return true;
            } else {
                return false;
            }
        } else{
            return "Quelque chose s'est mal passé ! Veuillez réessayer.";
        }

    }

    return "Quelque chose s'est mal passé ! Veuillez réessayer.";
}

function checkGenre($genre) {
    $pdo = dbConnect();
    $sql = "SELECT id FROM genres WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $genre["id"]);

        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                return true;
            } else {
                return false;
            }
        } else{
            return "Quelque chose s'est mal passé ! Veuillez réessayer.";
        }

    }

    return "Quelque chose s'est mal passé ! Veuillez réessayer.";
}


function addMovie($dataMovie)
{
    $pdo = dbConnect();
    if (!empty($dataMovie["poster_path"])) {
        $posterImg = 'http://image.tmdb.org/t/p/w342' . $dataMovie["poster_path"];
    } else {
        $posterImg = null;
    }
    if (!empty($dataMovie["backdrop_path"])) {
        $backdropImg = 'http://image.tmdb.org/t/p/original' . $dataMovie["backdrop_path"];
    } else {
        $backdropImg = null;
    }

    $sql = "INSERT INTO `movies`(`id`, `title`, `runtime`, `description`,`releaseDate`, `posterImg`, `backdropImg`) VALUES (:id, :title, :runtime,:description, :releaseDate, :posterImg, :backdropImg)";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":id", $dataMovie["id"]);
        $stmt->bindParam(":title", $dataMovie["title"]);
        $stmt->bindParam(":runtime", $dataMovie["runtime"]);
        $stmt->bindParam(":description", $dataMovie["overview"]);
        $stmt->bindParam(":releaseDate", $dataMovie["release_date"]);
        $stmt->bindParam(":posterImg", $posterImg);
        $stmt->bindParam(":backdropImg", $backdropImg);

        if($stmt->execute()){
            return true;
        } else{
            return "Quelque chose s'est mal passé. Veuillez réessayer.";
        }

    } else {
        return "Houston we have a problem";
    }



}

function addActor ($actor) {
    $pdo = dbConnect();
    $sql = "INSERT INTO `actors`(`id`, `name`, `posterImg`) VALUES (:id,:name,:posterImg)";

    if ($actor["profile_path"] != null) {
        $actorPoster = 'http://image.tmdb.org/t/p/w185' . $actor["profile_path"];
    }

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $actor["id"]);
        $stmt->bindParam(":name", $actor["name"]);
        if (isset($actorPoster)){
            $stmt->bindParam(":posterImg",$actorPoster);
        } else {
            $stmt->bindParam(":posterImg",$actor["profile_path"]);
        }

        if($stmt->execute()){
            return true;
        } else{
            return false;
        }
    }
    return false;
}

function linkActMov ($idActor,$idMovie) {
    $pdo = dbConnect();
    $sql = "INSERT INTO `link_movies_actors`(`idMovie`, `idActor`) VALUES (:idMovie, :idActor)";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":idMovie", $idMovie);
        $stmt->bindParam(":idActor", $idActor);
    }
    if ($stmt->execute()){
        return true;
    } else{
        return false;
    }
}

function addDirector ($director) {
    $pdo = dbConnect();
    $sql = "INSERT INTO `directors`(`id`, `name`, `posterImg`) VALUES (:id,:name,:posterImg)";

    if ($director["profile_path"] != null) {
        $directorPoster = 'http://image.tmdb.org/t/p/w185' . $director["profile_path"];
    }

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $director["id"]);
        $stmt->bindParam(":name", $director["name"]);
        if (isset($directorPoster)){
            $stmt->bindParam(":posterImg",$directorPoster);
        } else {
            $stmt->bindParam(":posterImg",$director["profile_path"]);
        }

        if($stmt->execute()){
            return true;
        } else{
            return false;
        }
    }
    return false;
}

function linkDirMov ($idDirector,$idMovie) {
    $pdo = dbConnect();
    $sql = "INSERT INTO `link_movies_directors`(`idMovie`, `idDirector`) VALUES (:idMovie, :idDirector)";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":idMovie", $idMovie);
        $stmt->bindParam(":idDirector", $idDirector);
    }
    if ($stmt->execute()){
        return true;
    } else{
        return false;
    }
}

function linkGenMov ($idGenre, $idMovie) {
    $pdo = dbConnect();
    $sql = "INSERT INTO `link_movies_genres`(`idMovie`, `idGenre`) VALUES (:idMovie, :idGenre)";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":idMovie", $idMovie);
        $stmt->bindParam(":idGenre", $idGenre);
    }
    if ($stmt->execute()){
        return true;
    } else{
        return false;
    }
}

function listMovies ($search = null) {
    $pdo = dbConnect();
    if ($search == null) {
        $sql = "SELECT * FROM movies";
    } else {
        $sql = "SELECT * FROM movies WHERE title LIKE '%" . $search . "%'";
    }


    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()){
         return $stmt->fetchAll();
    } else{
        return false;
    }
}

function deleteMovie($movie) {
    $pdo = dbConnect();
    $sql = "DELETE FROM movies WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $movie);
    if ($stmt->execute()){
        return true;
    } else {
        return false;
    }
}