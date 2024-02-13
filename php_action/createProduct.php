<?php
session_start();

include_once('includes/login_verification.php');
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
    $value = clearString($_POST['value']);
    $description = clearString($_POST['description']);


    $sql = "INSERT INTO itens (title, value, description) VALUES ('$title', '$value', '$description')";

    if (mysqli_query($conn, $sql)) {
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
