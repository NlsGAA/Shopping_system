<?php
session_start();

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

if (isset($_POST['btn_edit_product'])) {

    $title = clearString(filter_input(INPUT_POST, 'title'));
    $value = clearString(filter_input(INPUT_POST, 'value'));
    $description = clearString(filter_input(INPUT_POST, 'description'));
    $id = clearString(filter_input(INPUT_POST, 'id'));

    $sql = $pdo->prepare("UPDATE itens SET title = :title, description = :description, value = :value WHERE id = :id");
    $sql->bindValue(':title', $title);
    $sql->bindValue(':description', $description);
    $sql->bindValue(':value', $value);
    $sql->bindValue(':id', $id);
    $success = $sql->execute();

    if ($success && $sql->rowCount() > 0) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Produto editado com sucesso',
            'cod' => 00001
        );
        header('location: ../home.php');
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Não foi possível editar o produto',
            'cod' => 00002
        );
        header('location: ../edit_product_form.php');
    }
}
