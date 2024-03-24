<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . ('/../includes/login_verification.php');
include_once("db_connect.php");
require __DIR__ . "/../dao/ProductDAO.php";

$productDao = new ProductDAO($pdo);

if (isset($_POST['btn_create_product'])) {

    $image = !empty($_FILES['image']['name']) ?? "";
    if (!empty($image)) {
        $image = $productDao->imageUpload();
    }

    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $value = filter_input(INPUT_POST, 'value');
    $company_id = $_SESSION['logado']['id'];

    if ($productDao->findByTitle($title) ===  false) {

        $newProduct = new Product;
        $newProduct->setCompany_Id($company_id);
        $newProduct->setTitle($title);
        $newProduct->setDescription($description);
        $newProduct->setValue($value);
        $newProduct->setImage($image);

        $productDao->add($newProduct);

        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Produto cadastrado com sucesso',
            'cod' => 00001
        );
        header('location: ../home.php');
        exit;
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Já possui um produto com este nome',
            'cod' => 00002
        );
        header('location: ../product_form.php');
        exit;
    }
}
