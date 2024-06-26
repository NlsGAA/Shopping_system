<?php
session_start();

include_once('../includes/login_verification.php');
require_once __DIR__ . ("/../dao/CommentaryDAO.php");
include_once __DIR__ . ("/db_connect.php");
include_once("db_connect.php");

$commentaryDao = new CommentaryDAO($pdo);

if (isset($_POST['btn_user_product_opnion'])) {

    $product_id = filter_input(INPUT_POST, 'id');
    $user_name = $_SESSION['logado']['email'];
    if ($_SESSION['logado']['type_user'] === 'visitante') {
        $user_name = 'Visitante';
    }
    $author_id = $_SESSION['logado']['id'];
    $commentary_id = uniqid('commentary_', true);
    $commentary = filter_input(INPUT_POST, 'user_commentary');

    $newCommentary = new Commentary;
    $newCommentary->setProductId($product_id);
    $newCommentary->setAuthorId($author_id);
    $newCommentary->setAuthor($user_name);
    $newCommentary->setCommentary($commentary);

    $commentaryDao->addCommentary($newCommentary);


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
