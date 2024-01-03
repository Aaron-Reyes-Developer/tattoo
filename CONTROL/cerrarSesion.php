<?php
session_start();

if (empty($_SESSION['entrar']) || $_SESSION['entrar'] != true) {
    header('Location: ../index.php');
    die();
}

session_destroy();
header('Location: ../index.php');
