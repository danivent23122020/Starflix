<?php
session_start();
include 'includes/database.php';


// ===================
// on appelle la connexion à la BDD
$database =getPDO();


// ===================
// changement d'avatar
// ===================
if(isset($_POST['editAvatar'])){
    $id = $_SESSION['userID'];
    // $newAvatar = $_POST['newAvatar'];
    // test si 'choisir un fichier' est vide
    if(empty($newAvatar)){

        $image = addslashes(file_get_contents($_FILES['newAvatar']['tmp_name']));
        $reqAvatar = $database->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $reqAvatar->execute([
            $image,
            $id
        ]);
        // success message
        $succesAvatar = 'Votre avatar a bien été changé !';
        header('refresh:3;url=userInfos.php');
        
        // error message
        }else {
            $errorAvatar = 'Veuillez choisir un fichier';
            header('refresh:3;url=userInfos.php');
        }
}

// ====================
// changement de speudo
// ====================
if(isset($_POST['editPseudo'])){
    $oldPseudo = $_SESSION['userPseudo'];
    $newPseudo = htmlspecialchars($_POST['newPseudo']);
    //  test si changement de pseudo
    if($newPseudo != $oldPseudo ){
        // test si pseudo déjà existant
        $reqPseudo = $database->prepare('SELECT * FROM users WHERE pseudo = ?');
        $reqPseudo->execute(array($newPseudo));
        $pseudoExist = $reqPseudo->rowCount();
        if($pseudoExist == 0){
            $req = $database->prepare("UPDATE users SET pseudo = ? WHERE pseudo = ?");
            $req->execute([
                $newPseudo,
                $oldPseudo
            ]);
            $succesPseudo = 'Votre pseudo a bien été modifié !';
            header('refresh:3;url=userInfos.php');
        }else{
            $errorPseudo = 'Ce pseudo existe déjà';
            header('refresh:3;url=userInfos.php');
        }
    }
}

// ==================
// changement d'email
// ==================
if(isset($_POST['editEmail'])){
    $oldEmail = $_SESSION['userEmail'];
    $newEmail = htmlspecialchars($_POST['newEmail']);
    //  test si changement d'email
    if($newEmail != $oldEmail ){
        // test si email déjà existant
        $reqEmail = $database->prepare('SELECT * FROM users WHERE email = ?');
        $reqEmail->execute(array($newEmail));
        $emailExist = $reqEmail->rowCount();
        if($emailExist == 0){
            $req = $database->prepare("UPDATE users SET email = ? WHERE email = ?");
            $req->execute([
                $newEmail,
                $oldEmail
                ]);
                $succesEmail = 'Votre email a bien été modifié !';
                header('refresh:2;url=userInfos.php');
            }else{
                $errorEmail = 'Cet email existe déjà';
                header('refresh:2;url=userInfos.php');
            }
        }
    }
    
// ==========================
// changement de mot de passe
// ==========================
if(isset($_POST['confsubmit'])){
    $oldpassword = sha1($_POST['oldpassword']);
    $newpassword = sha1($_POST['newpassword']);
    $confnewpassword = sha1($_POST['confnewpassword']);
    // on compare les emails en cours
    if($_SESSION['userPassword'] == $oldpassword){
        // si se sont les 2 mêmes password
        // on teste si différences entre les nouveaux password
        if($newpassword == $confnewpassword){
            $database = getPDO();
            $request = $database->prepare("UPDATE users SET password = ? WHERE email = ? ");
            $request->execute([
                $newpassword,
                $_SESSION['userEmail']
            ]);
            $succesPassword = 'Votre nouveau mot de passe est pris en compte';
            header('refresh:3; url=userInfos.php');
        }else{
            $errorPassword1 = 'Les nouveaux mots de passe sont différents !';
            header('refresh:3; url=userInfos.php');
        }
    }else{
        $errorPassword2 = 'Ancien mot de passe incorrect !';
        header('refresh:3; url=userInfos.php');
    }
}
// ============================= HTML =============================
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ec755d5e9f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" media="screen" type="text/css" href="../login_signup/css/header.css" /> -->
    <link rel="stylesheet" media="screen" type="text/css" href="/css/header.css" />
    <link rel="stylesheet" href="css/userInfos.css">
    <title>Infos Utilisateur</title>
</head>

<body>
    <!--======-->
    <!-- main -->
    <main>
        <!-- ====== -->
        <!-- navbar -->
        <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
        <!-- ======= -->
        <!-- section -->
        <section class="user-infos">
            <!-- ========================= -->
            <!-- informations personnelles -->
            <article id="statusession">
                <!-- ========================= -->
                <!-- vérification de connexion -->
                <?php if(isset($_SESSION['userEmail'])) {  ?>
                <h2>Votre profil</h2>
                <h3 style="color: green;">Bonjour<?= $_SESSION['userPseudo'] ?></h3>
                <img src="./img/imageProfil.jpg">
                <table id="profilUser">
                    <!-- <caption>Vos informations</caption> -->
                    <tr>
                        <th>
                            <p>Votre nom :</p>
                        </th>
                        <td>
                            <p><?= $_SESSION['userNom'] ?></p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            <p>Votre prénom :</p>
                        </th>
                        <td>
                            <p><?= $_SESSION['userPrenom'] ?></p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            <p>Votre pseudo :</p>
                        </th>
                        <td>
                            <p><?= $_SESSION['userPseudo'] ?></p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            <p>Votre email :</p>
                        </th>
                        <td>
                            <p><?= $_SESSION['userEmail'] ?></p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            <p>Votre date d'inscription :</p>
                        </th>
                        <td>
                            <p><?= $_SESSION['signupDate'] ?></p>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </article>
            <!-- ================================ -->
            <!-- Modifier avatar - pseudo - email -->
            <!-- ================================ -->
            <!-- Modifier avatar -->
            <article class="changemdp">
                <form action="" method="POST" enctype="multipart/form-data" class="form">
                    <div class="user-form">
                        <h5>Modifier votre avatar</h5>
                        <label for="newAvatar" class="user-label">Avatar</label>
                        <input type="file" class="user-control" id="newAvatar" name="newAvatar" required tabindex="2">
                    </div>
                    <!-- btn -->
                    <div class="user-btn">
                        <button type="submit" class="btn-user" name="editAvatar">Modifier avatar</button>
                    </div>
                    <!-- =============== -->
                    <!-- Modifier pseudo -->
                    <hr>
                    <div class="user-form">
                        <h5>Modifier votre pseudo</h5>
                        <label for="newPseudo" class="user-label">Votre pseudo actuel :</label>
                        <input type="text" class="user-control" id="newPseudo" name="newPseudo"
                            value="<?= $_SESSION['userPseudo'] ?>" tabindex="2">
                    </div>
                    <!-- btn -->
                    <div class="user-btn">
                        <button type="submit" class="btn-user" name="editPseudo">Modifier pseudo</button>
                    </div>
                    <!-- =============== -->
                    <!-- Modifier email -->
                    <hr>
                    <div class="login-form">
                        <h5>Modifier votre email</h5>
                        <label for="newEmail" class="user-label">Votre adresse email actuelle : </label>
                        <input type="email" class="user-control" id="newEmail" name="newEmail"
                            value="<?= $_SESSION['userEmail'] ?>" tabindex="2">
                    </div>
                    <!-- btn -->
                    <div class="user-btn">
                        <button type="submit" class="btn-user" name="editEmail">Modifier email</button>
                    </div>
                    <hr>
                </form>
                <!-- ===================== -->
                <!-- Modifier mot de passe -->
                <!-- ===================== -->
                <h5>Modifier votre mot de passe</h5>
                <form action="" method="POST" class="form">
                    <!-- =================== -->
                    <!-- ancien mot de passe -->
                    <div class="login-form">
                        <label for="oldpassword" class="user-label">Ancien mot de passe</label>
                        <input type="password" class="user-control" id="oldpassword" name="oldpassword"
                            placeholder="Ancien mot de passe" tabindex="2" required>
                    </div>
                    <!-- ==================== -->
                    <!-- nouveau mot de passe -->
                    <div class="login-form">
                        <label for="newpassword" class="user-label">Nouveau mot de passe</label>
                        <input type="password" class="user-control" id="newpassword" name="newpassword"
                            placeholder="Nouveau mot de passe" tabindex="2" required>
                    </div>
                    <!-- ============================== -->
                    <!-- confirmer nouveau mot de passe -->
                    <div class="login-form">
                        <label for="confnewpassword" class="user-label">Nouveau mot de passe</label>
                        <input type="password" class="user-control" id="confnewpassword" name="confnewpassword"
                            placeholder="Confirmez nouveau mot de passe" tabindex="2" required>
                    </div>
                    <!-- btn -->
                    <div class="user-btn">
                        <button type="submit" class="btn-user" name="confsubmit">Valider</button>
                    </div>
                </form>
            </article>
            <!-- ============================ -->
            <!-- fin de la condition if en php-->
            <!-- ============================ -->
            <?php  } else { ?>
            <h3>Vous n'êtes pas connecté</p>
                <?php } ?>
                <!-- fin de la section html -->
                <!-- =========================== -->
                <!-- gestion des messages OK/NOK -->
                <!-- =========================== -->
                <!-- lien sur script des messages d'erreurs -->
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <!-- ==================== -->
                <!-- changement AVATAR OK -->
                <?php if(isset($succesAvatar)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Votre avatar a bien été changé !",
                    icon: "success",
                })
                </script>
                <?php }?>
                <!-- ===================== -->
                <!-- changement AVATAR NOK -->
                <?php if(isset($errorAvatar)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Veuillez choisir un fichier",
                    icon: "warning",
                })
                </script>
                <?php }?>
                <!-- =================== -->
                <!-- Modification PSEUDO -->
                <!-- =================== -->
                <!-- erreur PSEUDO utilisé -->
                <?php if(isset($errorPseudo)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Ce pseudo est dèjà utilisé !",
                    icon: "warning",
                })
                </script>
                <?php }?>
                <!-- ==================== -->
                <!-- changement PSEUDO OK -->
                <?php if(isset($succesPseudo)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Votre pseudo a bien été modifié !",
                    icon: "success",
                })
                </script>
                <?php }?>
                <!-- ================== -->
                <!-- Modification EMAIL -->
                <!-- ================== -->
                <!-- erreur EMAIL utilisé -->
                <?php if(isset($errorEmail)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Cet email est dèjà utilisé!",
                    icon: "warning",
                })
                </script>
                <?php }?>
                <!-- ===================== -->
                <!-- changement d'EMAIL OK -->
                <?php if(isset($succesEmail)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Votre email a bien été modifié !",
                    icon: "success",
                })
                </script>
                <?php }?>
                <!-- ========================= -->
                <!-- Modification MOT DE PASSE -->
                <!-- ==================================== -->
                <!-- erreur ANCIEN MOT DE PASSE incorrect -->
                <?php if(isset($errorPassword2)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Ancien mot de passe incorrect !",
                    icon: "warning",
                })
                </script>
                <?php }?>
                <!-- =============================== -->
                <!-- erreur MOTS DE PASSE différents -->
                <?php if(isset($errorPassword1)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Les nouveaux mots de passe sont différents !",
                    icon: "warning",
                })
                </script>
                <?php }?>
                <!-- ========================== -->
                <!-- changement MOT DE PASSE OK -->
                <?php if(isset($succesPassword)) { ?>
                <script>
                swal({
                    title: "Attention",
                    text: "Votre nouveau mot de passe est pris en compte !",
                    icon: "success",
                })
                </script>
                <?php }?>
                <!-- fin de la liste des messages OK/NOK -->
                <!-- ========================== -->
        </section>
        <!-- ====== -->
        <!-- footer -->
        <?php
    include 'footer.php';
    ?>
    </main>
</body>

</html>