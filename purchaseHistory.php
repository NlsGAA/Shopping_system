<?php
session_start();

require_once __DIR__ . ("/includes/header.php");
require_once __DIR__ . ("/php_action/db_connect.php");
require_once __DIR__ . ("/dao/ProductDAO.php");
require_once __DIR__ . ("/includes/navbar.php");

$purchased_items = new ProductDAO($pdo);
$bought_items = $purchased_items->findPurchaseHistory($_SESSION['logado']['id']);

function sortByPurchaseDate($date1, $date2)
{
    return strtotime($date2->getPurchase_date()) - strtotime($date1->getPurchase_date());
}

usort($bought_items, 'sortByPurchaseDate');

require_once __DIR__ . "/includes/left_menu.php";
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Título</th>
            <th scope="col">Descrição</th>
            <th scope="col">Valor</th>
            <th scope="col">Data de compra</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bought_items as $item) : ?>
            <tr>
                <th scope="row"><?= $item->getTitle() ?>:</th>
                <td><?= $item->getDescription() ?></td>
                <td>R$<?= $item->getValue() ?></td>
                <td><?= $item->getPurchase_date() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . ("/includes/footer.php") ?>