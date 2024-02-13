<?php
session_start();

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

    $title = clearString($_POST['title']);
    $value = clearString($_POST['value']);
    $description = clearString($_POST['description']);
    $id = clearString($_POST['id']);

    $sql = "UPDATE itens SET title = '$title', description = '$description', value = '$value' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
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
