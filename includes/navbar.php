<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#"><?= $_SESSION['logado']['user'] ?></a>
                <a class="nav-link" href="#">Home</a>
                <a class="nav-link" href="#">Meus pedidos</a>
                <?php
                if ($_SESSION['logado']['level'] == 2) {
                    echo '<a class="nav-link btn btn-success" href="product_form.php">+Adicionar Produtos</a>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>