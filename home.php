<?php
session_start();
if (!isset($_SESSION['logado'])) {
    $_SESSION['logado']['id'] = 999;
    $_SESSION['logado']['type_user'] = 'visitante';
}

include_once('includes/header.php');
include_once('php_action/db_connect.php');
require __DIR__ . "/dao/ProductDAO.php";
require __DIR__ . "/dao/CommentaryDAO.php";
include_once('includes/navbar.php');

if (isset($_SESSION['message'])) {
    echo "<div class='action_message action_messagejs'>" . $_SESSION['message']['message'] . "</div>";
}
unset($_SESSION['message']);

$productDao = new ProductDAO($pdo);
$products = $productDao->findAll();

$commentaryDao = new CommentaryDAO($pdo);

?>

<div class="row">
    <?php
    include_once('includes/left_menu.php');
    if (isset($_SESSION['payment'])) :
    ?>

        <div class='overlay action_messagejs'>";
            <div class='payment_modal action_messagejs'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                </svg>
                <p id="payment_message">
                    <?= $_SESSION['payment']['message'] ?>
                </p>
            </div>
        </div>

    <?php
        unset($_SESSION['payment']);
    endif; ?>

    <div class="col-md-10 card-container flex" style="height: auto;">
        <?php
        if (!empty($products)) {

            foreach ($products as $key_product => $dados) :
                $commentary = $commentaryDao->commentaryInProduct($dados->getId());
                if (is_array($commentary)) {
                    $num_comments = count($commentary);
                } else {
                    $num_comments = 0;
                }
        ?>
                <div class="card card-margin" type="button" data-bs-toggle="modal" data-bs-target="#infoProductModal<?= $dados->getId() ?>">

                    <?php if ($_SESSION['logado']['type_user'] == 'legal' && $_SESSION['logado']['id'] == $dados->getCompany_Id()) : ?>
                        <div class="action_icon offset-md-8">
                            <a href="edit_product_form.php?id=<?= $dados->getId() ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="b i bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                </svg>
                            </a>
                            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#productModal<?= $dados->getId() ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                    <img src="image/<?= $dados->getImage() ?>" class="card-img-top" alt="Imagem de <?= $dados->getTitle() ?>">

                    <div class="card-body">
                        <h4 class="card-text"><?= $dados->getTitle(); ?></h4>
                        <h4 class="iten_value"><?= 'R$', $dados->getValue(); ?></h4>
                        <p class="card-text"><?= $dados->getDescription(); ?></p>
                    </div>
                    <div class="add_to_cart">
                        <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $dados->getId() ?>">Adicionar ao carrinho
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                            </svg>
                        </a>
                    </div>

                </div>



                <!-- Modal Add Item to Cart -->
                <div class="modal fade" id="exampleModal<?= $dados->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Observações do produto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="php_action/add_to_cart.php?id=<?= $dados->getId() ?>">
                                    <label>Quantidade:</label>
                                    <input type="number" value="1" name="quantity"> x
                                    <label>Observações a serem consideradas:</label>
                                    <input type="text" placeholder="Ex: sem cebola" name="observation">
                                    <button type="submit" class="btn btn-success">Adicionar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Company Product-->
                <div class="modal fade" id="productModal<?= $dados->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir item?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4><?= $dados->getTitle(), ' ', 'R$', $dados->getValue() ?></h4>
                                <span><?= $dados->getDescription() ?></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <form action="php_action/delete.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $dados->getId() ?>">
                                    <button type="submit" name="btn_delete_product" class="btn btn-danger">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Product Modal -->
                <div class="col-md-12 modal fade" id="infoProductModal<?= $dados->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h4 class="modal-title"><?= $dados->getTitle() ?> - R$ <?= $dados->getValue() ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="lead"><?= $dados->getDescription() ?></p>
                                <hr>
                                <h5 class="mb-3">Comentários (<?= $num_comments ?>) :</h5>
                                <div class="comments">
                                    <?php
                                    if ($num_comments > 0) :
                                        foreach ($commentary as $key_commentary => $commentary_data) :
                                    ?>
                                            <div class="comment mb-3 d-flex justify-content-between align-items-center">
                                                <span class="fw-bold"><?= $commentary_data->getAuthor() . ' ' . date("H:i:s", strtotime($commentary_data->getCommentaryDate())) ?></span>
                                                <?php if ($_SESSION['logado']['id'] === $commentary_data->getAuthorId()) : ?>
                                                    <span class="dropdown">
                                                        <a class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                            </svg>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="php_action/deleteCommentary.php?id= <?= $commentary_data->getId() ?>">Excluir</a></li>
                                                        </ul>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <p class='text-muted'><?= $commentary_data->getCommentary() ?></p>
                                    <?php
                                        endforeach;
                                    else :
                                        echo "<p class='text-muted'>Não há comentário.</p>";
                                    endif;
                                    ?>
                                </div>
                            </div>

                            <div class="modal-footer d-flex">
                                <form action="php_action/user_product_opnion.php" method="POST" class="flex-grow-1">
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Deixe seu comentário:</label>
                                        <textarea class="form-control" id="comment" name="user_commentary" rows="3" required></textarea>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $dados->getId() ?>">
                                    <button type="submit" name="btn_user_product_opnion" class="btn btn-primary">Publicar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



        <?php
            endforeach;
        } else {
            echo 'Ainda não há nenhum item registrado!';
        }
        ?>
    </div>
</div>
<?php include_once('includes/footer.php'); ?>