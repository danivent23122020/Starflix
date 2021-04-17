<?php

require('model/frontend.php');

function postResearchUser($research)
{
    $users = researchUser($research);
    require('view/frontend/usersListView.php');
    $users->closeCursor();
}

function usersList()
{
    $users = getUsersList();
    require('view/frontend/usersListView.php');
    $users->closeCursor();
}

function updateUser($userId)
{
    $userData = getUserUpdate($userId);
    require('view/frontend/userResetPassword.php');
    $userData->closeCursor();
}

function upgradeUser($userId, $userPassword)
{
    $upgrade = setUserUpdate($userId, $userPassword);
    $upgrade->closeCursor();
    header('Location: index.php');
}

function banUser($userId)
{
    $ban = setBanUser($userId);
    $ban->closeCursor();
    header('Location: index.php');
}

function removeUser($userId)
{
    $deleteLine = deleteUser($userId);
    if ($deleteLine === false) {
        die('Impossible de supprimer l\'utilisateur !');
    }
    else {
        $deleteLine->closeCursor();
        header('Location: index.php');
    }
}

