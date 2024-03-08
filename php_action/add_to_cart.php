<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once("db_connect.php");

$product_id = filter_input(INPUT_GET, 'id');

if (empty($product_id)) {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Não foi possível encontrar o produto desejado!',
        'cod' => 00002
    );
    header('location: ../home.php');
}

if (isset($product_id)) {
    $user_id = $_SESSION['logado']['id'];

    $sql = $pdo->prepare("INSERT INTO cart (user_id, product_id) VALUES (:user_id, :product_id)");
    $sql->bindValue(':user_id', $user_id);
    $sql->bindValue(':product_id', $product_id);
    $success = $sql->execute();


    if ($success && $sql->rowCount() > 0) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Produto adicionado ao carrinho',
            'cod' => 00001
        );
        header('location: ../home.php');
        exit;
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Não foi possível adicionar o produto ao carrinho',
            'cod' => 00002
        );
        header('location: ../home.php');
        exit;
    }
}
