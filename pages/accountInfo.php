<?php
session_start();
include_once('../includes/header.php');
include_once('../includes/navbar.php')
?>

<div class="col-md-10 container-fluid" id="account_info_modal">
    <div class="row">
        <div class="title">
            <h1>Dados da conta:</h1>
        </div>
    </div>
    <div class="container">
        <hr>
        Nome: <?= $_SESSION['logado']['user'] ?>
        <hr>
        Email: <?= $_SESSION['logado']['email'] ?>
    </div>
</div>

<?php include_once('../includes/footer.php') ?>