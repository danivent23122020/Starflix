<?php
session_start();

require('controller/frontend.php');

if (isset($_SESSION["userID"])) {
    if (isset($_GET['research']) AND !empty($_GET['research'])) {
        $research = htmlspecialchars($_GET['research']);
        postResearchUser($research);
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['BanUser']) AND $_POST['BanUser']) {
            foreach ($_POST['BanUser'] as $userId)
            {
                banUser($userId);
            }
        }
        elseif (isset($_POST['deleteUser']) AND $_POST['deleteUser']) {
            foreach ($_POST['deleteUser'] as $userId)
            {
                removeUser($userId);
            }
        }
        elseif (isset($_POST['updateUser']) AND $_POST['updateUser']) {
            foreach ($_POST['updateUser'] as $userId)
            {
                updateUser($userId);
            }
        }
        elseif (isset($_POST['resetPasswordUser']) AND $_POST['resetPasswordUser']) {
            if ($_POST['password'] != $_POST['confirmPassword']) {
                echo '<h2>Les mots de passes ne sont pas identiques. Recommencer?</h2>';
                updateUser($_POST['id']);
            } else {
                upgradeUser($_POST['id'], $_POST['password']);
            }
        }
        elseif (isset($_POST['usersList'])) {
            usersList();
        }
    }
    else {
        usersList();
    }
} else {
    header("Location: /login_signup/login.php");
}


