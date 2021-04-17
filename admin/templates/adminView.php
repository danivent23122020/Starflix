<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="/admin/css/styles.css">
    <link rel="stylesheet" href="/admin/css/dashboardMenu.css">
    <link rel="stylesheet" href="/css/header.css">

    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <title><?= "Admin" ?></title>
</head>
<body>
    
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/templates/adminDashboard.php"); 
?>
<div id="content" class="text-white">


<?php
        switch (true) {
            case ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["movie"])):
                $_SESSION["datas"] = getMovie($_GET["movie"]);
                require ("showMovieDetails.php");
                break;
            case ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["movieAdd"])):
                $results = searchMovieAPI($_POST["movieAdd"]);
                require("searchResultsView.php");
                break;
            case ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sendDB"])):
                    if (addNewMovie($_SESSION["datas"])) {
                        require("addedMovie.php");
                    } else {
                        require("addedMovieError.php");
                    }
                    require("formAddMovie.php");
                break;
            case ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["movieSearch"])):
                $results = listMovies($_POST["movieSearch"]);
                require("showMovieList.php");
                break;
            case ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteMovie"])):
                deleteMovie($_POST["deleteMovie"]);
                require("deletedMovie.php");
                require("formSearchMovie.php");
                break;
            case ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["menuAdd"])):
                require("formAddMovie.php");
                break;
            case ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["menuEdit"])):
                require("formSearchMovie.php");
                break;
        } ?>
</div>
<script src="/admin/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>