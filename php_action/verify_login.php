<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . ("/../dao/LoginVerifyDAO.php");
$verify = new LoginVerifyDAO($pdo);

if (isset($_POST['btn_login'])) {

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (empty($email) or empty($password)) {
        $verify->dataFill();
    }

    if (!empty($email)) {
        $verify->registerUserVerify($email, $password);
    }
}
