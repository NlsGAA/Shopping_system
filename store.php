<?php
session_start();
include_once('includes/header.php');
include_once('php_action/db_connect.php');
require __DIR__ . "/dao/ProductDAO.php";
include_once('includes/navbar.php');
include_once('includes/left_menu.php');

$productDao = new ProductDAO($pdo);

$sql = $pdo->query("SELECT id,address, fantasyName FROM company_register");
$companyFilter = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-md-10 card-container flex">
        <!-- Make dao method to store page -->
        <?php foreach ($companyFilter as $key => $store) : ?>
            <?php
            $productByCompanyId = $productDao->findByCompanyId($store['id']);
            if (!empty($productByCompanyId)) :
            ?>
                <div class="cardStorePage">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/originals/63/1e/f6/631ef682e36234fde02144c1985fed9b.png" class="corner-image">
                    </div>
                    <div class="card" style="width: 16rem;">
                        <div class="store-info">
                            <h5 class="store-name"><?= $store["fantasyName"] ?></h5>
                            <h6 class="store-address"><?= $store["address"] ?></h6>
                            <p class="store-description">Aqui vai ficar a missão ou um breve texto institucional da empresa</p>
                            <a href="#" class="store-link">Sei lá</a>
                            <a href="storeProducts.php?id=<?= $store["id"] ?>" class="store-link">Visitar loja</a>
                        </div>
                    </div>
                </div>
        <?php
            endif;
        endforeach;
        ?>

    </div>
</div>

<?php
include_once __DIR__ . '/includes/footer.php';
?>