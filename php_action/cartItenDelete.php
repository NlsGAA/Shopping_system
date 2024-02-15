<?php
session_start();

include_once('db_connect.php');

if (isset($_POST['btn_delete_item'])) {
    $id = mysqli_escape_string($conn, $_POST['id']);

    $sql = "DELETE FROM cart WHERE product_id='$id' LIMIT 1";

    if (mysqli_query($conn, $sql)) {
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
}
