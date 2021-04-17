<?php
session_start();

require("model.php");

include_once('myView.php');
$view = new MyView();

if (isset($_SESSION['userAdmin']) && $_SESSION['userAdmin'])   {
    $view->render('adminView.php');
} else {
    header("Location: /login_signup/login.php");
}


