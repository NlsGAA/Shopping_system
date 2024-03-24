<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once("db_connect.php");

if (isset($_POST['btn_register'])) {

    $type_user = filter_input(INPUT_POST, 'type');

    $cpf = filter_input(INPUT_POST, 'cpf');
    $cnpj = filter_input(INPUT_POST, 'cnpj');

    $birthdate = filter_input(INPUT_POST, 'birthdate');

    $address = filter_input(INPUT_POST, 'address');
    $companyAddress = filter_input(INPUT_POST, 'companyAddress');

    $companyName = filter_input(INPUT_POST, 'companyName');
    $fantasyName = filter_input(INPUT_POST, 'fantasyName');

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $password = md5($password);


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

    if ($type_user === 'physical') {
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
    } else if ($type_user === 'legal') {
        $sql = $pdo->prepare("INSERT INTO company_register (type_user, cnpj, address, companyName, fantasyName, email, password) VALUES (:type_user, :cnpj, :companyAddress, :companyName, :fantasyName, :email, :password)");
        $sql->bindValue(':type_user', $type_user);
        $sql->bindValue(':cnpj', $cnpj);
        $sql->bindValue(':companyName', $companyName);
        $sql->bindValue(':companyAddress', $companyAddress);
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
