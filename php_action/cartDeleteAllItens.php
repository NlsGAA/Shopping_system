<?php
session_start();

require_once __DIR__ . ("/db_connect.php");
require_once __DIR__ . ("/../dao/Cart_itensDAO.php");

$cart_item = new Cart_itensDAO($pdo);

if (isset($_POST['deleteAllItens'])) {
    $cart_item->deleteAllItens($_SESSION['logado']['id']);

    $_SESSION['message'] = array(
        'status' => true,
        'message' => 'Carrinho esvaziado!',
        'cod' => 000011
    );
    header('location: http://localhost/sistema_de_compra/home.php');
} else {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Não foi possível esvaziar o carrinho',
        'cod' => 000012
    );
    header('location: http://localhost/sistema_de_compra/home.php');
}
