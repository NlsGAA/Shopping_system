<?php
session_start();
include_once('includes/header.php');
include_once('php_action/db_connect.php');
include_once('includes/navbar.php');
include_once('includes/left_menu.php');

$sql = $pdo->query("SELECT id,address, fantasyName FROM company_register");
$company = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-md-10 card-container flex">
        <!-- Make dao method to store page -->
        <?php foreach ($company as $key => $store) : ?>
            <div class="card" style="width: 16rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $store["fantasyName"] ?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?= $store["address"] ?></h6>
                    <p class="card-text">Aqui vai ficar a missão ou um breve texto institucional da empresa</p>
                    <a href="#" class="card-link">Sei lá</a>
                    <a href="storeProducts.php?id=<?= $store["id"] ?>" class="card-link">Visitar loja</a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php
include_once __DIR__ . '/includes/footer.php';
?>