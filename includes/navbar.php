<?php
if (isset($_POST['btn_home'])) {
    header("location: http://localhost/sistema_de_compra/home.php");
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-toggler-icon hamburguer_option" type="button"></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart4 cart_button" type="button" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
            </svg>
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