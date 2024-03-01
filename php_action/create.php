<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once("db_connect.php");

function clearString($input)
{
    global $conn;
    //con db
    $var = mysqli_escape_string($conn, $input);
    //xss - cross site scripting
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_POST['btn_register'])) {
    $passCrypt = md5($_POST['password']);

    $type_user = clearString($_POST['type']);

    $cpf = clearString($_POST['cpf']);
    $cnpj = clearString($_POST['cnpj']);

    $birthdate = clearString($_POST['birthdate']);

    $address = clearString($_POST['address']);
    $companyAddress = clearString($_POST['companyAddress']);

    $companyName = clearString($_POST['companyName']);
    $fantasyName = clearString($_POST['fantasyName']);

    $email = clearString($_POST['email']);
    $password = clearString($passCrypt);

    $verifyPhysicalRegister = $pdo->prepare("SELECT * FROM costumer_register WHERE email = :email");
    $verifyPhysicalRegister->bindValue(':email', $email);
    $verifyPhysicalRegister->execute();

    if ($verifyPhysicalRegister->rowCount() > 0) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Email já cadastrado no sistema',
            'cod' => 00003
        );
        header('Location: ../register.php');
        exit();
    }

    $verifyLegalRegister = $pdo->prepare("SELECT * FROM company_register WHERE cnpj = :cnpj");
    $verifyLegalRegister->bindValue(':cnpj', $cnpj);
    $verifyLegalRegister->execute();

    if ($verifyLegalRegister->rowCount() > 0) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Empresa já cadastrada no sistema',
            'cod' => 00004
        );
        header('Location: ../register.php');
        exit();
    }

    if ($type_user == 'physical') {
        $sql = $pdo->prepare("INSERT INTO costumer_register (type_user, cpf, birthdate, address, email, password) VALUES (:type_user, :cpf, :birthdate, :address, :email, :password)");
        $sql->bindValue(':type_user', $type_user);
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':birthdate', $birthdate);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();

        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'cod' => 00001
        );
        header('location: ../login.php');
        exit;
    } else if ($type_user == 'legal') {
        $sql = $pdo->prepare("INSERT INTO company_register (type_user, cnpj, address, companyName, fantasyName, email, password) VALUES (:type_user, :cnpj, :companyAddress, :companyName, :fantasyName, :email, :password)");
        $sql->bindValue(':type_user', $type_user);
        $sql->bindValue(':cnpj', $cnpj);
        $sql->bindValue(':companyAddress', $companyAddress);
        $sql->bindValue(':companyName', $companyName);
        $sql->bindValue(':fantasyName', $fantasyName);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();

        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'cod' => 00001
        );
        header('location: ../login.php');
        exit;
    } else {
        $_SESSION['message'] = array(
            'status' => false,
            'message' => 'Não foi possível cadastrar o usuário',
            'cod' => 00002
        );
        header('location: ../register.php');
    }
}
