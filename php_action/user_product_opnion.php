<?php
session_start();

include_once('../includes/login_verification.php');
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

if (isset($_POST['btn_user_product_opnion'])) {

    $product_id = clearString($_POST['id']);
    $user_name = clearString($_SESSION['logado']['user']);
    $commentary_id = uniqid('commentary_', true);
    $user_commentary = clearString($_POST['user_commentary']);

    $sql = "INSERT INTO user_product_opnion (user_name, product_id, commentary_id, user_commentary) VALUES ('$user_name', '$product_id', '$commentary_id', '$user_commentary')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Comentário enviado com sucesso!',
            'cod' => 00001
        );
        header('location: ../home.php');
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Não foi possível enviar o comentário',
            'cod' => 00002
        );
        header('location: ../home.php');
    }
}
