<?php
session_start();

include_once('../includes/login_verification.php');
include_once __DIR__ . ("/db_connect.php");
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

    $product_id = clearString(filter_input(INPUT_POST, 'id'));
    $user_name = clearString($_SESSION['logado']['user']);
    $commentary_id = uniqid('commentary_', true);
    $user_commentary = clearString(filter_input(INPUT_POST, 'user_commentary'));

    $sql = $pdo->prepare("INSERT INTO user_product_opnion (user_name, product_id, commentary_id, user_commentary) VALUES (:user_name, :product_id, :commentary_id, :user_commentary)");
    $sql->bindValue(':user_name', $user_name);
    $sql->bindValue(':product_id', $product_id);
    $sql->bindValue(':commentary_id', $commentary_id);
    $sql->bindValue(':user_commentary', $user_commentary);
    $success = $sql->execute();

    if ($success && $sql->rowCount() > 0) {
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
