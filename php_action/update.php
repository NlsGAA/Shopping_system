<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . "/../dao/ProductDAO.php";

$productDao = new ProductDAO($pdo);

if (isset($_POST['btn_edit_product'])) {

    $title = filter_input(INPUT_POST, 'title');
    $value = number_format(filter_input(INPUT_POST, 'value'), 2);
    $description = filter_input(INPUT_POST, 'description');
    $id = filter_input(INPUT_POST, 'id');

    $product = $productDao->findById($id);
    $product->setTitle($title);
    $product->setValue($value);
    $product->setDescription($description);

    $image = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $product->getImage();
    if (!empty($_FILES['image']['name'])) {
        $image = $productDao->imageUpload();
    }
    $product->setImage($image);

    $productDao->updateProduct($product);

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
    header('location: ../edit_product_form.php?id=' . $id);
}
