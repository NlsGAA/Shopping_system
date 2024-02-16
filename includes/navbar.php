<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="navbar-nav navbar_content">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-border-width hamburguer_option" viewBox="0 0 16 16">
                <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5" />
            </svg>
            <a class="nav-link" href="#">Home</a>
            <a class="nav-link cart_button" href="#">Meus pedidos</a>
            <?php
            if ($_SESSION['logado']['level'] == 2) {
                echo '<a class="nav-link btn btn-success" href="product_form.php">+Adicionar Produtos</a>';
            }
            ?>
        </div>
    </div>
</nav>