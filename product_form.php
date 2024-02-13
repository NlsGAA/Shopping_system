<?php
session_start();

include_once('includes/login_verification.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']['message'];
}
?>

<form action="php_action/createProduct.php" method="POST">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Título:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Título do anúncio" name="title">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Valor:</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Valor a ser cobrado" name="value">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
    </div>
    <input type="submit" class="form-control" name="btn_create_product" value="Cadastrar Produto">
</form>

<?php include_once('includes/footer.php'); ?>