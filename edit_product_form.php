<?php
session_start();

include_once('includes/login_verification.php');
include_once __DIR__ . ("/PDOFunction/db_connect.php");
include_once('php_action/db_connect.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');

    $sql = $pdo->query("SELECT * FROM itens WHERE id = '$id'");
    $data_str = json_encode($sql->fetch(PDO::FETCH_ASSOC));
    $data = json_decode($data_str);
} else {
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
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Título:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Título do anúncio" name="title" value="<?= $data->title ?>">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Valor:</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Valor a ser cobrado" name="value" value="<?= $data->value ?>">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?= $data->description ?></textarea>
    </div>
    <input type="submit" class="form-control" name="btn_edit_product" value="Editar Produto">
</form>

<?php include_once('includes/footer.php'); ?>