<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once('db_connect.php');
include_once __DIR__ . "/../dao/ProductDAO.php";

$productDao = new ProductDAO($pdo);

if (isset($_POST['btn_delete_product'])) {
    $id = filter_input(INPUT_POST, 'id');

    $productDao->deleteProduct($id);

    $_SESSION['message'] = array(
        'status' => true,
        'message' => 'Produto deletado com sucesso',
        'cod' => 39964
    );
    header("location: ../home.php");
    exit;
} else {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Erro ao deletar produto',
        'cod' => 92486
    );
    header("location: ../home.php");
    exit;
}
