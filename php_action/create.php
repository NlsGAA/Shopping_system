<?php
session_start();

include_once("db_connect.php");

function clearString($input)
{
    global $conn;
    //con db
    $var = mysqli_escape_string($conn, $input);
    //xss - cross site scripting
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_POST['btn_register'])) {
    $passCrypt = md5($_POST['password']);

    $user = clearString($_POST['user']);
    $email = clearString($_POST['email']);
    $password = clearString($passCrypt);

    $sql = "INSERT INTO costumer_register (user, email, password, level) VALUES ('$user', '$email', '$password', 1)";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'cod' => 00001
        );
        header('location: ../login.php');
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Não foi possível cadastrar o usuário',
            'cod' => 00002
        );
        header('location: ../register.php');
    }
}
