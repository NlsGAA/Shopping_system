<?php
session_start();
include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . "/../dao/CommentaryDAO.php";

$productDao = new CommentaryDAO($pdo);

$id = filter_input(INPUT_GET, 'id');

if (isset($id)) {
    $productDao->deleteCommentary($id);

    $_SESSION['message'] = array(
        'status' => true,
        'message' => 'Comentário deletado com suceso!',
        'cod' => 00004
    );
    header("location: ../home.php");
    exit;
} else {
    $_SESSION['message'] = array(
        'status' => true,
        'message' => 'Não foi possível deletar o comentário!',
        'cod' => 00005
    );
    header("location: ../home.php");
    exit;
}
