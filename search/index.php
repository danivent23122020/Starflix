<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/ec755d5e9f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" media="screen" type="text/css" href="../css/header.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="./css/search.css" />
    <title>STARFLIXVOD</title>
  </head>
  <body>
    
    <header>
    <div class="nav">
        <a class="nav-logo" href="index.html"><img src="../images/logo.png" alt="" width="150" /></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/movies/movies_page.php" class="nav-link">MOVIES</a>
            </li>
            <li class="nav-item">
                <a href="/movies/actors_page.php" class="nav-link">ACTORS</a>
            </li>
            <li class="nav-item">
                <a href="/movies/favorite_movies.php" class="nav-link">MY LIST</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/login_signup/aboutUs.php">ABOUT US</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">CONTACT</a>
            </li>
        </ul>

        <div class="nav-user">
            <ul>
                <div class="form-group nav-form mr-auto">
                    <form action="search.php" method="post">
                        <input type="text" id="search-input" name="search" class="form-control" type="search" placeholder="Search...">
                    </form>
                </div>
                <!-- <li class="nav-item bell">
                    <a href="#" class="nav-link-bell"><i class="fa fa-bell"></i><span>5</span></a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-color" href="/login_signup/register.php">Sign up</a>
                </li>

                <div class="sub-menu-bar">
                    <li class="nav-item user">
                        <?php if(isset($_SESSION['userEmail'])) {  ?>
                        <a href="#" class="nav-color"><?= $_SESSION['userPseudo'] ?><i
                                class="fas fa-angle-down"></i></a>
                        <div class="sub-menu-user">
                            <ul>
                                <li><a href="/login_signup/userInfos.php">Profil</a></li>
                                <?php
                                    if ($_SESSION["userAdmin"]) {
                                        ?>
                                <li><a href="/admin">Admin</a></li>
                                <?php
                                }
                                ?><li><a href="/login_signup/logout.php">Deconnexion</a></li>
                            </ul>
                        </div>
                        <?php } else { ?>
                    <li class="nav-item user">
                        <a href="/login_signup/login.php" class="nav-color">Sign in</a>
                    </li>
                    <?php } ?>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</header>    


