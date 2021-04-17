<?php
session_start();
include 'includes/database.php';

if(isset($_SESSION['userEmail'])){
    header('Location:index.php');
}
// connexion 
if(isset($_POST['login-submit'])){
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    if((!empty($email)) && (!empty($password))){
        $database = getPDO();
        $requestUser = $database->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $requestUser->execute(array($email, $password));
        $userCount = $requestUser->rowCount();
        if($userCount == 1){
            $userInfo = $requestUser->fetch();
            $_SESSION['userID'] = $userInfo['id'];
            $_SESSION['userPrenom'] = $userInfo['prenom'];
            $_SESSION['userNom'] = $userInfo['nom'];
            $_SESSION['userPseudo'] = $userInfo['pseudo'];
            $_SESSION['userEmail'] = $userInfo['email'];
            $_SESSION['userAvatar'] = $userInfo['avatar'];
            // $_SESSION['userPassword'] = $userInfo['password'];
            // $_SESSION['userBan'] = $userInfo['isBan'];
            $_SESSION['userAdmin'] = $userInfo['isAdmin'];
            $_SESSION['signupDate'] = $userInfo['signupDate'];
            // ==================================================================
            // test si client banni, si oui-> renvoyé sur logout pour deconnexion
            if($userInfo['isBan'] == 1){
                $errorBan = 'Attention : vous avez été banni !';
                header('refresh:5; url=logout.php');
            }else{
                $succesConnect = 'Vous êtes connecté';
                header('refresh:1; url=index.php');
            }
            // test 
            if($_SESSION['userAdmin'] == 1){
                $succesAdmin = 'Vous êtes connecté en tant qu\'Admin';
                header('refresh:3; url=index.php');
            }
        }else{
            $errorMessage = 'Email ou mot de passe incorrect';
            header('refresh:3; url=login.php');
        }
    }else{
        $errorMessage = 'Vueillez renseigner tous les champs';
        header('refresh:3; url=login.php');
    }
}
// ====================== HTML =========================
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login-form.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/ec755d5e9f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" media="screen" type="text/css" href="../login_signup/css/header.css" /> -->
    <link rel="stylesheet" media="screen" type="text/css" href="/css/header.css" />
    <script src="/js/main.js"></script>
    <title>Connexion</title>
</head>

<body>
    <!-- ==== -->
    <!-- main -->
    <main>
        <!-- ====== -->
        <!-- navbar -->
        <!-- <?php // include 'header.php'; ?> -->
        <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
        <!-- ======= -->
        <!-- section -->
        <section class="login-section">
            <div class="login-container">
                <h3 id="login-title">Se connecter</h3>
                <!-- *********************** -->
                <!-- Formulaire de connexion -->
                <form action="" method="POST" class="form">
                    <!-- ===== -->
                    <!-- email -->
                    <div class="login-form">
                        <label for="email" class="form-label">Votre Email</label>
                        <input type="email" class="login-control" id="email" name="email" placeholder="Votre email"
                            tabindex="2" required>
                    </div>
                    <!-- ============ -->
                    <!-- mot de passe -->
                    <div class="login-form">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="login-control" id="password" name="password"
                            placeholder="Votre mot de passe" tabindex="3" required>
                    </div>
                    <div class="login-btn">
                        <button type="submit" class="btn-login" name="login-submit">Commencer</button>
                    </div>
                </form>
                <p>Pas encore inscrit ? <a href="register.php">C'est ici !</a></p>
            </div>
        </section>
    </main>
    <!-- ============================= -->
    <!-- script des messages d'erreurs -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- ============ -->
    <!-- CONNEXION NOK BANNI -->
    <?php if(isset($errorBan)) { ?>
    <script>
    swal({
        title: "ATTENTION",
        text: "Votre compte a été suspendu, prenez rapidement contact avec l'administrateur du site pour en connaître les raisons !",
        icon: "warning",
    })
    </script>
    <?php }?>
    <!-- ============ -->
    <!-- CONNEXION OK ADMIN -->
    <?php if(isset($succesAdmin)) { ?>
    <script>
    swal({
        title: "SUPER",
        text: "Vous êtes connecté en tant qu'ADMIN.",
        icon: "succes",
    })
    </script>
    <?php }?>
    <!-- ============= -->
    <!-- CONNEXION NOK -->
    <?php if(isset($errorMessage)) { ?>
    <script>
    swal({
        title: "Attention",
        text: "Erreur d'identiant ou de mot de passe.",
        icon: "warning",
    })
    </script>
    <?php }?>
    <!-- ====== -->
    <!-- footer -->
    <?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/footer.php");
    ?>
</body>

</html>