<?php
session_start();
if ($_SESSION['logado']['type_user'] === 'visitante') {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Para realizar esta ação, você precisa estar logado!',
        'cod' => "00019"
    );
    header("location: http://localhost/sistema_de_compra/home.php");
    exit();
}

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
    $quantity = filter_input(INPUT_POST, 'quantity');
    $i = 1;
    $observation = filter_input(INPUT_POST, 'observation');

    while ($i <= $quantity) {
        $sql = $pdo->prepare("INSERT INTO cart (user_id, product_id, observation) VALUES (:user_id, :product_id, :observation)");
        $sql->bindValue(':user_id', $user_id);
        $sql->bindValue(':product_id', $product_id);
        $sql->bindValue(':observation', $observation);
        $success = $sql->execute();
        $i++;
    }


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
