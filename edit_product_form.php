<?php
session_start();

include_once('includes/login_verification.php');
include_once('php_action/db_connect.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

if (isset($_GET['id'])) {
    $id = mysqli_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM itens WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_array($result);
}

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']['message'];
}
?>

<form action="php_action/update.php" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Título:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Título do anúncio" name="title" value="<?= $dados['title'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Valor:</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Valor a ser cobrado" name="value" value="<?= $dados['value'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?= $dados['description'] ?></textarea>
    </div>
    <input type="submit" class="form-control" name="btn_edit_product" value="Editar Produto">
</form>

<?php include_once('includes/footer.php'); ?>