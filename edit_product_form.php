<?php
session_start();

include_once('includes/login_verification.php');
include_once __DIR__ . ("/php_action/db_connect.php");
include_once('dao/productDAO.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

$productDao = new ProductDAO($pdo);
$id = filter_input(INPUT_GET, 'id');
$product = false;

if (isset($id)) {
    $product = $productDao->findById($id);
}
if ($product === false) {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Produto não encontrado',
        'cod' => 65182
    );
    header('location: http://localhost/sistema_de_compra/home.php');
    exit;
}

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']['message'];
}
?>

<form action="php_action/update.php" method="POST">
    <input type="hidden" name="id" value="<?= $product->getId() ?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Título:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Título do anúncio" name="title" value="<?= $product->getTitle() ?>">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Valor:</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Valor a ser cobrado" name="value" value="<?= $product->getValue() ?>">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?= $product->getDescription() ?></textarea>
    </div>
    <input type="submit" class="form-control" name="btn_edit_product" value="Editar Produto">
</form>

<?php include_once('includes/footer.php'); ?>