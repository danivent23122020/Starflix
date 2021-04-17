
<header>
    <div class="nav">
        <a class="nav-logo" href="/"><img src="/images/logo.png" alt="" width="150" /></a>
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
                <a class="nav-link" href="/contact/form.php">CONTACT</a>
            </li>
        </ul>

        <div class="nav-user">
            <ul>
                <div class="form-group nav-form mr-auto">
                <form action="/search/search.php" method="post">
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