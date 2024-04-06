<?php
session_start();
include_once __DIR__ . "/includes/header.php";
include_once('php_action/db_connect.php');
require __DIR__ . "/dao/ProductDAO.php";
include_once('includes/navbar.php');
include_once('includes/left_menu.php');

$productDao = new ProductDAO($pdo);

$company_id = filter_input(INPUT_GET, 'id');
$storeProducts = $productDao->findByCompanyId($company_id);

?>

<div class="favRowTop">
    <h2>Favoritos ❤️:</h2>
    <div class="companyCommentary">
        <button id="companyCommentaryButton">Deixe um comentário para a loja</button>
        <div class="form-floating" style="display: none">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Feedback pra loja:</label>
            <button onclick="showToast()">Enviar comentário</button>
        </div>
    </div>
</div>
<div class="favRowProducts">
    <?php foreach ($storeProducts as $key => $storeProduct) : ?>

        <div class="card card-margin" type="button" data-bs-toggle="modal" data-bs-target="#infoProductModal<?= $storeProduct->getId() ?>">
            <?php if ($_SESSION['logado']['type_user'] == 'legal' && $_SESSION['logado']['id'] == $storeProduct->getCompany_Id()) : ?>
                <div class="action_icon offset-md-8">
                    <a href="edit_product_form.php?id=<?= $storeProduct->getId() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="b i bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                        </svg>
                    </a>
                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#productModal<?= $storeProduct->getId() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
            <img src="image/<?= $storeProduct->getImage() ?>" class="productImage" alt="Imagem de <?= $storeProduct->getTitle() ?>">
            <div class="card-body">
                <h4 class="card-text"><?= $storeProduct->getTitle(); ?></h4>
                <h4 class="iten_value"><?= 'R$', $storeProduct->getValue(); ?></h4>
                <!-- <p class="card-text"> ?= $storeProduct->getDescription(); ?></p> -->
            </div>
            <div class="add_to_cart">
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $storeProduct->getId() ?>">Adicionar ao carrinho
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                    </svg>
                </a>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<div class="productsTitle">
    <h2>Produtos:</h2>
</div>
<div class="favRowProducts">
    <?php foreach ($storeProducts as $key => $storeProduct) : ?>

        <div class="card card-margin" type="button" data-bs-toggle="modal" data-bs-target="#infoProductModal<?= $storeProduct->getId() ?>">
            <?php if ($_SESSION['logado']['type_user'] == 'legal' && $_SESSION['logado']['id'] == $storeProduct->getCompany_Id()) : ?>
                <div class="action_icon offset-md-8">
                    <a href="edit_product_form.php?id=<?= $storeProduct->getId() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="b i bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                        </svg>
                    </a>
                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#productModal<?= $storeProduct->getId() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
            <img src="image/<?= $storeProduct->getImage() ?>" class="productImage" alt="Imagem de <?= $storeProduct->getTitle() ?>">
            <div class="card-body">
                <h4 class="card-text"><?= $storeProduct->getTitle(); ?></h4>
                <h4 class="iten_value"><?= 'R$', $storeProduct->getValue(); ?></h4>
                <p class="card-text"> <?= $storeProduct->getDescription(); ?></p>
            </div>
            <div class="add_to_cart">
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $storeProduct->getId() ?>">Adicionar ao carrinho
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                    </svg>
                </a>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<div class="toast">
    <p>Comentário enviado</p>
</div>

<footer>
    <h4>Sobre a loja:</h4>
    <div class="companyInfoFooter">
        <div class="cardCompanyInfo">
            <h2>+100 Vendas</h2>
            <span>Produtos vendidos pela loja</span>
        </div>
        <div class="cardCompanyInfo">
            <h2>+20 Produtos</h2>
            <span>Produtos que a loja possui cadastrados</span>
        </div>
        <div class="cardCompanyInfo">
            <h2>+300 Cliente</h2>
            <span>Mais de 300 clientes compram nessa loja</span>
        </div>
    </div>
</footer>

<script>
    let commentaryFloating = document.querySelector('.form-floating');
    let textAreaCommentary = document.querySelector('#floatingTextarea');

    document.querySelector('#companyCommentaryButton').addEventListener('click', function() {
        if (commentaryFloating.style.display === 'none') {
            commentaryFloating.style.display = 'block';
        } else {
            commentaryFloating.style.display = 'none';
        }
    })

    function showToast() {
        var toast = document.querySelector(".toast");
        toast.style.display = "block";
        textAreaCommentary.value = "";
        setTimeout(function() {
            toast.style.display = "none";
        }, 5 * 1000);
    }
</script>

<?php include_once __DIR__ . "/includes/footer.php"; ?>