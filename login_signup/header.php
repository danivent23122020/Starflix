<header>
    <div class="nav">
        <a class="nav-logo" href="http://starflix.alexandre-chiquet.com/login_signup/"><img src="./img/logo.png" alt=""
                width="150" /></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/movies/movies_page.php" class="nav-link">MOVIES</a>
            </li>
            <li class="nav-item">
                <a href="/movies/actors_page.php" class="nav-link">ACTORS</a>
            </li>
            <li class="nav-item">
                <a href="/movies/myList_page.php" class="nav-link">MY LIST</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>

        <div class="nav-user">
            <ul>
                <div class="form-group nav-form mr-auto">
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
                <!-- <li class="nav-item bell">
                    <a href="#" class="nav-link-bell"><i class="fa fa-bell"></i><span>5</span></a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-color" href="aboutUs.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-color" href="register.php">Sign up</a>
                </li>
                <div class="sub-menu-bar">
                    <li class="nav-item user">
                        <?php if(isset($_SESSION['userEmail'])) {  ?>
                        <a href="#" class="nav-color"><?= $_SESSION['userPseudo'] ?><i
                                class="fas fa-angle-down"></i></a>
                        <div class="sub-menu-user">
                            <ul>
                                <li><a href="index.php">Accueil</a></li>
                                <li><a href="userInfos.php">Paramètres</a></li>
                                <li><a href="#">libre</a></li>
                                <li><a href="#">libre</a></li>
                                <li><a href="logout.php">Deconnexion</a></li>
                            </ul>
                        </div>
                        <?php } else { ?>
                    <li class="nav-item user">
                        <a href="login.php" class="nav-color">Sign in</a>
                    </li>
                    <?php } ?>
                    </li>
                </div>
            </ul>

        </div>
    </div>
</header>