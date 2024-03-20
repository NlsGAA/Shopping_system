<?php

require_once __DIR__ . ("/../php_action/db_connect.php");
require_once __DIR__ . ("/../dao/Cart_itensDAO.php");

$productDao = new cart_itensDAO($pdo);
$cart_itens = $productDao->takeItensByUserId($_SESSION['logado']['id']);
?>

<!-- left bar menu -->
<div class="col-md-2" id="cart_left_menu" style="display: none;">
    <div class="cart_element">
        <h3>Meu carrinho:</h3>
        <div class="content_cart_body">
            <?php if ($cart_itens !== 0 && is_array($cart_itens)) : ?>

                <form action="http://localhost/sistema_de_compra/php_action/cartDeleteAllItens.php" method="POST">
                    <button name="deleteAllItens">Esvaziar carrinho</button>
                </form>

                <?php
                $total_price = 0;
                foreach ($cart_itens as $cart_value => $itens) :
                    $productInfo = $productDao->takeItenInfoByProductId($itens->getProduct_id());
                    foreach ($productInfo as $product_detail) :
                        $total_price += $product_detail->getValue();
                ?>

                        <div class="itens_info_cart">
                            <p>
                                <?= $product_detail->getTitle(), ' ', 'R$', $product_detail->getValue() ?>

                                <a href="" type="button" data-bs-toggle="modal" data-bs-target="#itemModal<?= $product_detail->getId() ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                        <hr>

                        <!-- Modal-Cart-Item -->
                        <div class="modal fade" id="itemModal<?= $product_detail->getId() ?>" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="itemModalLabel">Detalhes do item:</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4><?= $product_detail->getTitle(), ' ', 'R$', $product_detail->getValue() ?></h4>
                                        <span><?= $product_detail->getDescription() ?></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <form action="php_action/cartItenDelete.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $product_detail->getId() ?>">
                                            <button type="submit" name="btn_delete_item" class="btn btn-danger">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

            <?php
                    endforeach;
                endforeach;
                echo "<p>Total: R$" . number_format($total_price, 2) . "</p>";
                echo '<a href="" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Comprar/Pagar</a>';
            else : echo "<hr> <p class='text-muted'>Carrinho vazio</p>";
            endif;
            ?>

        </div>
    </div>
</div>

<div class="col-md-2 container-fluid" id="option_menu_left" style="display:none;" ;>
    <div class="menu_option">
        <div class="list_option">
            <h5>Opções:</h5>
            <div class="select_itens_option">
                <ul>
                    <a href="http://localhost/sistema_de_compra/purchaseHistory.php">
                        <li>Histórico de compra</li>
                    </a>
                    <li>Cartão</li>
                    <li>Configurações</li>
                    <a href="../sistema_de_compra/accountInfo.php">
                        <li id="account_info.php">Dados da conta</li>
                    </a>
                    <a href="php_action/logout.php">
                        <li name="btn_logout">Sair</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal Payment Confirm -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação de pagamento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Deseja confirmar o pagamento?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Sair</button>
                <a href="http://localhost/sistema_de_compra/php_action/cartDeleteAllItens.php?ConfirmPayment=true" class="btn btn-info">Confirmar pagamento</a>
            </div>
        </div>
    </div>
</div>

<script>
    //Cart menu left
    let left_menu_cart = document.querySelector("#cart_left_menu");
    document.querySelector(".cart_button").onclick = function() {
        if (left_menu_cart.style.display == "none") {
            if (option_menu_left.style.display == "block") {
                option_menu_left.style.display = "none";
            }
            left_menu_cart.style.display = "block";
        } else {
            left_menu_cart.style.display = "none";
        }
    };

    //Account Info
    let option_menu_left = document.querySelector("#option_menu_left");
    document.querySelector(".hamburguer_option").onclick = function() {
        if (option_menu_left.style.display == "none") {
            if (left_menu_cart.style.display == "block") {
                left_menu_cart.style.display = "none";
            }
            option_menu_left.style.display = "block";
        } else {
            option_menu_left.style.display = "none";
        }
    };
</script>