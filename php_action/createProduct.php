<?php

use App\Controller\ProductController;

session_start();

include_once __DIR__ . ("/../app/Controller/ProductController.php");
include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . ('/../includes/login_verification.php');
include_once("db_connect.php");
require __DIR__ . "/../dao/ProductDAO.php";

$productDao = new ProductDAO($pdo);

if (isset($_POST['btn_create_product'])) {

    $productController = new ProductController($pdo);
    var_dump($productController->create());die;

    // if (!empty($_FILES['image']['name'])) {
    //     $fileName = $_FILES['image']['name'];
    //     $fileType = $_FILES['image']['type'];
    //     $tmpName = $_FILES['image']['tmp_name'];
    //     $fileSize = $_FILES['image']['size'];
    //     $errors = $productDao->validateImage($fileName, $fileType, $fileSize);

    //     if (!empty($errors)) {
    //         foreach ($errors as $error) {
    //             $_SESSION['message'] = array(
    //                 'status' => false,
    //                 'message' => $error,
    //                 'cod' => 00033
    //             );
    //             header("location: http://localhost/sistema_de_compra/product_form.php");
    //         }
    //         exit;
    //     }

    //     $image = $productDao->uploadImage($fileName, $tmpName);
    // }

    // $title = filter_input(INPUT_POST, 'title');
    // $description = filter_input(INPUT_POST, 'description');
    // $value = filter_input(INPUT_POST, 'value');
    // $company_id = $_SESSION['logado']['id'];

    // if ($productDao->findByTitle($title) ===  false) {

    //     $newProduct = new Product;
    //     $newProduct->setCompany_Id($company_id);
    //     $newProduct->setTitle($title);
    //     $newProduct->setDescription($description);
    //     $newProduct->setValue($value);
    //     $newProduct->setImage($image);

    //     $productDao->add($newProduct);

    //     $_SESSION['message'] = array(
    //         'status' => true,
    //         'message' => 'Produto cadastrado com sucesso',
    //         'cod' => 00001
    //     );
    //     header('location: ../home.php');
    //     exit;
    // } else {
    //     $_SESSION['message'] = array(
    //         'status' => false,
    //         'message' => 'Já possui um produto com este nome',
    //         'cod' => 00002
    //     );
    //     header('location: ../product_form.php');
    //     exit;
    // }
}
