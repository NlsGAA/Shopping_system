<?php
//Select cart itens of user
$cart_itens = "SELECT * FROM cart WHERE user_id = '{$_SESSION['logado']['id']}'";
$result_cart = mysqli_query($conn, $cart_itens);
?>

<!-- left bar filter -->
<div class="col-md-2" id="cart_left_menu" style="display: none;">
    <div class="cart_element">
        <h3>Meu carrinho:</h3>
        <div class="content_cart_body">
            <?php
            if (mysqli_num_rows($result_cart) > 0) :
                while ($dados_cart = mysqli_fetch_array($result_cart)) :
                    $all_itens_cart = "SELECT * FROM itens WHERE id='{$dados_cart['product_id']}'";
                    $dados = mysqli_query($conn, $all_itens_cart);
                    $itens = mysqli_fetch_array($dados);
                    $total_price += $itens['value'];
            ?>
                    <div class="itens_info_cart">
                        <p>
                            <?= $itens['title'], ' ', 'R$', $itens['value'] ?>

                            <a href="" type="button" data-bs-toggle="modal" data-bs-target="#itemModal<?= $itens['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>
                            </a>
                        </p>
                    </div>
                    <hr>

                    <!-- Modal-Cart-Item -->
                    <div class="modal fade" id="itemModal<?= $itens['id'] ?>" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="itemModalLabel">Detalhes do item:</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4><?= $itens['title'], ' ', 'R$', $itens['value'] ?></h4>
                                    <span><?= $itens['description'] ?></span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <form action="php_action/cartItenDelete.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $itens['id'] ?>">
                                        <button type="submit" name="btn_delete_item" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                echo "<p>Total: R$" . number_format($total_price, 2) . "</p>";
                echo '<a href="">Comprar/Pagar</a>';
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
                    <li>Histórico de compra</li>
                    <li>Cartão</li>
                    <li>Configurações</li>
                    <a href="pages/accountInfo.php">
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