<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . ("/../dao/RegisterUserDAO.php");
$user = new RegisterUserDAO($pdo);

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

if (isset($_POST['btn_register'])) {

    $erro = $user->validatePhysicalAvailability($email);
    if (empty($erro)) {
        $physical = new User;
        $physical->setTypeUser($type_user);
        $physical->setCpf($cpf);
        $physical->setBirthdate($birthdate);
        $physical->setAddress($address);
        $physical->setEmail($email);
        $physical->setPassword($password);
        $user->createUser($physical);
    }


    $erro = $user->validateCompanyAvailability($cnpj);
    if (empty($erro)) {
        $company = new Company;
        $company->setTypeUser($type_user);
        $company->setCnpj($cnpj);
        $company->setCompanyAddress($companyAddress);
        $company->setCompanyName($companyName);
        $company->setFantasyName($fantasyName);
        $company->setEmail($email);
        $company->setPassword($password);
        $user->createCompany($company);
    }

    if (!empty($erro)) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => $erro,
            'cod' => 00004
        );
        header('Location: ../register.php');
        exit();
    }
} else {
    $_SESSION['message'] = array(
        'status' => false,
        'message' => 'Não foi possível cadastrar o usuário',
        'cod' => 00002
    );
    header('location: ../register.php');
    exit;
}
