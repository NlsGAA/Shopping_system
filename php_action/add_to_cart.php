<?php
session_start();

include_once("db_connect.php");

if (empty($_GET['id'])) {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Não foi possível encontrar o produto desejado!',
        'cod' => 00002
    );
    header('location: ../home.php');
}

function clearString($input)
{
    global $conn;
    //con db
    $var = mysqli_escape_string($conn, $input);
    //xss - cross site scripting
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_GET['id'])) {

    $user_id = clearString($_SESSION['logado']['id']);
    $product_id = clearString($_GET['id']);

    $sql = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Produto adicionado ao carrinho',
            'cod' => 00001
        );
        header('location: ../home.php');
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Não foi possível adicionar o produto ao carrinho',
            'cod' => 00002
        );
        header('location: ../home.php');
    }
}
