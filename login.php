<?php
session_start();

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']['message'];
}
session_unset();

include_once('includes/header.php');
?>


<div class="col-md-6 offset-md-3">
    <div class="container">
        <form action="php_action/verify_login.php" method="POST">
            <div class="login-body">
                <label>Email:</label>
                <input type="email" name="email">
                <label>Senha:</label>
                <input type="password" name="password">
                <button class="btn btn-success" type="submit" name="btn_login">Entrar</button>
            </div>
        </form>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>