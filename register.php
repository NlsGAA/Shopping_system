<?php

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
</head>

<body>

    <div class="container">

        <form action="php_action/create.php" method="POST">
            <label>Usuário:</label>
            <input type="text" name="user">
            <label>Email:</label>
            <input type="email" name="email">
            <label>Senha:</label>
            <input type="password" name="password">
            <button type="submit" name="btn_register">Registrar</button>
        </form>

    </div>

</body>

</html>