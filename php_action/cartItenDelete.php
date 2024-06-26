<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . ("/../dao/Cart_itensDAO.php");

$cart_item = new Cart_itensDAO($pdo);

if (isset($_POST['btn_delete_item'])) {
    $id = filter_input(INPUT_POST, 'id');

    $cart_item->deleteItenById($id);

    $_SESSION['message'] = array(
        'status' => true,
        'message' => 'Produto deletado com sucesso',
        'cod' => 39964
    );
    header("location: ../home.php");
} else {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Erro ao deletar produto',
        'cod' => 92486
    );
    header("location: ../home.php");
}
