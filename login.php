<?php
session_start();

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']['message'];
}
session_unset();

include_once('includes/header.php');
?>

<!-- Conteúdo da tela de login -->
<div class="col-md-6 offset-md-3" id="login-body">
    <div class="container">
        <div class="login-header">
            <h2>Bem-vindo de volta!</h2>
            <p>Por favor, faça login para continuar.</p>
        </div>
        <form action="php_action/verify_login.php" method="POST">
            <div class="login-body">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
                <input type="checkbox" id="checkPassword" name="typePassword"> Mostrar senha

                <button class="btn btn-success" type="submit" name="btn_login">Entrar</button>
            </div>
        </form>
        <div class="signup-link">
            <p>Não tem uma conta? <a href="register.php">Cadastre-se aqui</a></p>
        </div>
    </div>
</div>

</div>

<script>
    let password = document.querySelector('#password')
    let checkbox = document.querySelector('#checkPassword')
    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            password.type = "text";
        } else {
            password.type = "password";
        }
    })
</script>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>