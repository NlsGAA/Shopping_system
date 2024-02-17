<?php
session_start();
include_once('../php_action/db_connect.php');
include_once('../includes/header.php');
include_once('../includes/navbar.php');

$sql = "SELECT * FROM costumer_register WHERE email = '{$_SESSION['logado']['email']}'";
$result = mysqli_query($conn, $sql);
$data_user = mysqli_fetch_array($result);

?>

<div class="col-md-10 container-fluid" id="account_info_modal">
    <div class="row">
        <div class="title">
            <h1>Dados da conta:</h1>
        </div>
    </div>
    <div class="container">
        <hr>
        Pessoa: <?php if ($data_user['type_user'] == 'legal') {
                    echo 'Pessoa Jurídica';
                } else {
                    echo 'Pessoa Física';
                } ?>
        <hr>
        Email: <?= $data_user['email'] ?>
        <hr>
        CPF/CNPJ: <?= $data_user['cpfCNPJ'] ?>
        <hr>
        Endereço: <?= $data_user['address'] ?>
    </div>
</div>

<?php include_once('../includes/footer.php') ?>