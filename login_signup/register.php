<?php
session_start();
include 'includes/database.php';

// ===================
// on appelle la connexion à la BDD
$database = getPDO();

// ===================
// on bloque la connexion à cette page si déjà connecté
if(isset($_SESSION['userEmail'])){
    header('Location:index.php');
}

if(isset($_POST['register-submit'])){
    $firstname = htmlspecialchars(trim(ucwords($_POST['prenom'])));
    $name = htmlspecialchars(trim(strtoupper($_POST['nom'])));
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim(strtolower($_POST['email'])));
    $password1 = sha1(trim($_POST['password1']));
    $password2 = sha1(trim($_POST['password2']));
    date_default_timezone_set('Europe/Paris');
    $signupDate = date('d/m/Y à H:i:s');
    
    // test si le formulaire est complet
    if( (!empty($firstname)) && (!empty($name)) && (!empty($pseudo)) && (!empty($email)) && (!empty($password1)) && (!empty($password2)) ){
        // test du nb de caractères du pseudo et si le pseudo est libre
        if(strlen($pseudo) <= 25){
            $reqPseudo = $database->prepare('SELECT * FROM users WHERE pseudo = ?');
            $reqPseudo->execute(array($pseudo));
            $pseudoExist = $reqPseudo->rowCount();
            // test si le pseudo est libre
            if($pseudoExist == 0){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    // verification des passwords
                    if($password1 === $password2){
                        $rowEmail = countDatabaseValue($database, 'email', $email);
                        if($rowEmail == 0){
                            $inserMember =$database->prepare("INSERT INTO users (prenom, nom, pseudo, email, password, isAdmin, isBan) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
                            $inserMember->execute([
                                $firstname, 
                                $name, 
                                $pseudo, 
                                $email, 
                                $password1,
                                0, 
                                0
                                ]);
                            $succesRegister = 'Votre compte à bien été crée';
                            header('refresh:3; url=login.php');
                        }else{
                            $errorUsedEmail= 'Cette adresse email est déjà utlisée';
                            header('refresh:2; url=register.php');
                        }
                    }else{
                        $errorPassword = 'Attention, vos mots de passe sont différents';
                        header('refresh:2; url=register.php');
                    }
                }else{
                    $errorInvalidEmail = 'Votre email n\'est pas valide';
                    header('refresh:2; url=register.php');
                }
            }else{
                $errorInvalidPseudo = 'Ce pseudo est deja utilisé';
                header('refresh:2; url=register.php');
            }
            
        }else{
            $errorLargePseudo = 'Votre pseudo dépasse les 25 caractères';
            header('refresh:2; url=register.php');     
        }
        
    }else{
        $errorEmpty = 'Veuillez remplir tous les champs';
        header('refresh:2; url=register.php');
    }
}
// ======================= HTML =========================
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu-nav.css">
    <link rel="stylesheet" href="css/register-form.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/ec755d5e9f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" media="screen" type="text/css" href="../login_signup/css/header.css" /> -->
    <link rel="stylesheet" media="screen" type="text/css" href="/css/header.css" />
    <script src="/js/main.js"></script>
    <title>Inscription</title>
</head>

<body>
    <main class="register">
        <!-- ====== -->
        <!-- navbar -->
        <!-- <?php // include 'header.php'; ?> -->
        <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
        <!-- ======= -->
        <!-- section -->
        <section class="register-section">
            <div class="register-container">
                <h3 id="register-title">Inscription</h3>
                <!-- ************************ -->
                <!-- formulaire d'inscription -->
                <form action="" method="POST" class="form">
                    <!-- ===================== -->
                    <!-- enregistrement du nom -->
                    <div class="register-form">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="register-control" id="nom" name="nom" placeholder="Votre nom"
                            tabindex="2" required>
                    </div>
                    <!-- ======================== -->
                    <!-- enregistrement du prenom -->
                    <div class="register-form">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="register-control" id="prenom" name="prenom" placeholder="Votre prenom"
                            tabindex="2" required>
                    </div>
                    <!-- ======================== -->
                    <!-- enregistrement du pseudo -->
                    <div class="register-form">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="register-control" id="pseudo" name="pseudo" placeholder="Votre pseudo"
                            tabindex="2" required>
                    </div>
                    <!-- ========================= -->
                    <!-- enregistrement de l'email -->
                    <div class="register-form">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="register-control" id="email" name="email" placeholder="Votre email"
                            tabindex="2" required>
                    </div>
                    <!-- ========================= -->
                    <!-- mot de passe -->
                    <div class="register-form">
                        <label for="password1" class="form-label">Mot de passe</label>
                        <input type="password" class="register-control" id="password1" name="password1"
                            placeholder="Votre mot de passe" tabindex="3" required>
                    </div>
                    <!-- ========================= -->
                    <!-- confirmation mot de passe -->
                    <div class="register-form">
                        <label for="password2" class="form-label">Confirmer mot de passe</label>
                        <input type="password" class="register-control" id="password2" name="password2"
                            placeholder="Confirmer votre mot de passe" tabindex="3" required>
                    </div>
                    <!-- ========================= -->
                    <!-- btn -->
                    <div class="btn-register">
                        <button type="submit" class="register-btn" name="register-submit">Inscription</button>
                    </div>
                </form>
                <!-- ***************************** -->
            </div>
        </section>
    </main>
    <!-- ============================= -->
    <!-- script des messages d'erreurs -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- ===================== -->
    <!-- CREATION D'UN COMPTE OK -->
    <?php if(isset($succesRegister)) { ?>
    <script>
    swal({
        title: "SUPER",
        text: "Votre compte a bien été créé !",
        icon: "succes",
    })
    </script>
    <?php }?>
    <!-- ================== -->
    <!-- ERREUR EMAIL déjà utilisé -->
    <?php if(isset($errorUsedEmail)) { ?>
    <script>
    swal({
        title: "ATTENTION",
        text: "Cette adresse email est déjà utlisée",
        icon: "warning",
    })
    </script>
    <?php }?>
    <!-- =========================== -->
    <!-- ERREUR PASSWORDS différents -->
    <?php if(isset($errorPassword)) { ?>
    <script>
    swal({
        title: "ATTENTION",
        text: "vos mots de passe sont différents",
        icon: "warning",
    })
    </script>
    <?php }?>
    <!-- ========================== -->
    <!-- ERROR EMAIL mauvais format -->
    <?php if(isset($errorInvalidEmail)) { ?>
    <script>
    swal({
        title: "ATTENTION",
        text: "Votre email ne respecte pas le bon format",
        icon: "warning",
    })
    </script>
    <?php }?>
    <!-- ========================== -->
    <!-- ERROR Pseudo déjà utilisé -->
    <?php if(isset($errorInvalidPseudo)) { ?>
    <script>
    swal({
        title: "ATTENTION",
        text: "Ce pseudo est déjà utilisé",
        icon: "warning",
    })
    </script>
    <?php }?>
    <!-- ====================== -->
    <!-- ERROR Pseudo dépasse les 25 caractères -->
    <?php if(isset($errorLargePseudo)) { ?>
    <script>
    swal({
        title: "ATTENTION",
        text: "Votre pseudo dépasse les 25 caractères",
        icon: "warning",
    })
    </script>
    <?php }?>
    <!-- ========================== -->
    <!-- ERROR un ou plusieurs emplacements vides -->
    <?php if(isset($errorEmpty)) { ?>
    <script>
    swal({
        title: "ATTENTION",
        text: "Veuillez remplir tous les champs",
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