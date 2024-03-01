<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . ('/../includes/login_verification.php');
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

if (isset($_POST['btn_create_product'])) {

    $title = clearString($_POST['title']);
    $value = clearString(number_format($_POST['value'], 2));
    $description = clearString($_POST['description']);


    $sql = $pdo->prepare("INSERT INTO itens (title, value, description) VALUES (:title, :value, :description)");
    $sql->bindValue(':title', $title);
    $sql->bindValue(':value', $value);
    $sql->bindValue(':description', $description);
    $success = $sql->execute();

    if ($success && $sql->rowCount() > 0) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Produto cadastrado com sucesso',
            'cod' => 00001
        );
        header('location: ../home.php');
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Não foi possível cadastrar o produto',
            'cod' => 00002
        );
        header('location: ../product_form.php');
    }
}
