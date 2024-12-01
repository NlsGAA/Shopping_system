<?php
session_start();

include_once('includes/login_verification.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

if (isset($_SESSION['message'])) {
    echo "<div class='action_message action_messagejs'>" . $_SESSION['message']['message'] . "</div>";
}
unset($_SESSION['message']);
?>

<div class="d-flex h-100 mt-4">
    <div class="container mt-4">
        <div class="mb-4">
            <h3 class="text-center text-success">+Cadastrar novo produto:</h3>
        </div>
        <form action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Título do anúncio" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Valor:</label>
                <input type="number" step=".01" min=".01" class="form-control" id="exampleFormControlInput1" placeholder="Valor a ser cobrado" name="value">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Imagem:</label>
                <input type="file" class="form-control" name="image[]" multiple>
            </div>
            <input type="submit" class="form-control" name="btn_create_product" value="Cadastrar Produto">
        </form>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>