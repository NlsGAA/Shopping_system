<?php
session_start();
require_once __DIR__ . ('/includes/header.php');
include_once __DIR__ . ('/includes/login_verification.php');
include_once __DIR__ . ('/php_action/db_connect.php');
include_once __DIR__ . ('/php_action/db_connect.php');
include_once __DIR__ . ('/includes/navbar.php');

if ($_SESSION['logado']['type_user'] === 'physical') {
    $sql = $pdo->query("SELECT * FROM costumer_register WHERE id = '{$_SESSION['logado']['id']}'");
    $data_str = json_encode($sql->fetch(PDO::FETCH_ASSOC));
    $data_user = json_decode($data_str);
}

if ($_SESSION['logado']['type_user'] === 'legal') {
    $sql = $pdo->query("SELECT * FROM company_register WHERE id = '{$_SESSION['logado']['id']}'");
    $data_str = json_encode($sql->fetch(PDO::FETCH_ASSOC));
    $data_user = json_decode($data_str);
}

if ($_SESSION['logado']['type_user'] !== 'visitante') {
    $user = explode("@", $_SESSION['logado']['email']);
    $user = $user[0];
}


?>


<div class="row">

    <?php include_once __DIR__ . ("/includes/left_menu.php") ?>

    <div class="col-md-10 container-fluid" id="account_info_modal">

        <div class="row">
            <div class="title">
                <h1>Dados da conta:</h1>
            </div>
        </div>


        <div class="container">

            <?php if ($_SESSION['logado']['type_user'] === 'physical') : ?>
                Pessoa Física
                <hr>
                Usuário: <?= $user ?>
                <hr>
                Email: <?= $data_user->email ?>
                <hr>
                CNPJ: <?= $data_user->cpf ?>
                <hr>
                Endereço: <?= $data_user->address ?>
            <?php endif; ?>


            <?php if ($_SESSION['logado']['type_user'] === 'legal') : ?>
                Pessoa Jurídica
                <hr>
                Usuário: <?= $user ?>
                <hr>
                Email: <?= $data_user->email ?>
                <hr>
                CNPJ: <?= $data_user->cnpj ?>
                <hr>
                Empresa: <?= $data_user->companyName ?>
                <hr>
                Nome Fantasia: <?= $data_user->fantasyName ?>
                <hr>
                Endereço: <?= $data_user->address ?>
            <?php endif; ?>


            <?php if ($_SESSION['logado']['type_user'] === 'visitante') : ?>
                Visitante
                <hr>
            <?php endif; ?>

        </div>
    </div>


</div>



<?php include_once __DIR__ . ('/includes/footer.php') ?>