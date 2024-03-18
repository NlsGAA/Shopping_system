<?php
if (isset($_POST['btn_home'])) {
    header("location: http://localhost/sistema_de_compra/home.php");
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand hamburguer_option" type="button">Sistema de Compras</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <li class="nav-item">
                        <button class="nav-link" href="" name="btn_home">Home</button>
                    </li>
                </form>
                <li class="nav-item">
                    <a class="nav-link cart_button" type="button">Meus Pedidos</a>
                </li>
                <?php if ($_SESSION['logado']['type_user'] == 'legal') : ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-success" href="product_form.php">+ Adicionar Produtos</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>