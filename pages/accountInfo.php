<?php
session_start();
include_once('../includes/login_verification.php');
include_once __DIR__ . ("/../php_action/db_connect.php");
include_once('../php_action/db_connect.php');
include_once('../includes/header.php');
include_once('../includes/navbar.php');

$sql = $pdo->query("SELECT * FROM costumer_register WHERE email = '{$_SESSION['logado']['email']}'");
$data_str = json_encode($sql->fetch(PDO::FETCH_ASSOC));
$data_user = json_decode($data_str);

?>


<div class="row">

    <div class="col-md-10 container-fluid" id="account_info_modal">
        <div class="row">
            <div class="title">
                <h1>Dados da conta:</h1>
            </div>
        </div>
        <div class="container">
            <hr>
            Pessoa: <?php if ($data_user->type_user == 'legal') {
                        echo 'Pessoa Jurídica';
                    } else {
                        echo 'Pessoa Física';
                    } ?>
            <hr>
            Email: <?= $data_user->email ?>
            <hr>
            CPF/CNPJ: <?= $data_user->cpf ?>
            <hr>
            Endereço: <?= $data_user->address ?>
        </div>
    </div>


</div>



<?php include_once('../includes/footer.php') ?>