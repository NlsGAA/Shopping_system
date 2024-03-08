<?php
session_start();

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Faça o cadastro</h2>
        <form action="php_action/create.php" method="POST">
            <div class="form-group">
                <label for="type">Tipo de usuário:</label>
                <select class="form-control" id="type" name="type" onchange="toggleFields()">
                    <option value="physical">Pessoa Física</option>
                    <option value="legal">Pessoa Jurídica</option>
                </select>
            </div>
            <div id="physicalFields">
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                </div>
                <div class="form-group">
                    <label for="birthdate">Data de nascimento:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                </div>
                <div class="form-group">
                    <label for="address">Endereço residencial:</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
            </div>
            <div id="legalFields" style="display: none;">
                <div class="form-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj">
                </div>
                <div class="form-group">
                    <label for="companyAddress">Endereço da empresa:</label>
                    <input type="text" class="form-control" id="companyAddress" name="companyAddress">
                </div>
                <div class="form-group">
                    <label for="companyName">Razão social:</label>
                    <input type="text" class="form-control" id="companyName" name="companyName">
                </div>
                <div class="form-group">
                    <label for="fantasyName">Nome fantasia:</label>
                    <input type="text" class="form-control" id="fantasyName" name="fantasyName">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="btn_register">Cadastrar</button>
            <a href="login.php">Já possui uma conta?</a>
        </form>
    </div>

    <script>
        // Function to change between legal and physical
        function toggleFields() {
            var type = document.getElementById('type').value;
            var physicalFields = document.getElementById('physicalFields');
            var legalFields = document.getElementById('legalFields');

            if (type === 'physical') {
                physicalFields.style.display = 'block';
                legalFields.style.display = 'none';
            } else if (type === 'legal') {
                physicalFields.style.display = 'none';
                legalFields.style.display = 'block';
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>