<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once __DIR__ . ("/../dao/RegisterUserDAO.php");

function createUser($userData, $dao) {
    $physical = new User;
    $physical->setTypeUser($userData['type_user']);
    $physical->setCpf($userData['cpf']);
    $physical->setBirthdate($userData['birthdate']);
    $physical->setAddress($userData['address']);
    $physical->setEmail($userData['email']);
    $physical->setPassword($userData['password']);
    $dao->createUser($userData['physical']);
}

function createCompany($userData, $dao) {
    $company = new Company;
    $company->setTypeUser($userData['type_user']);
    $company->setCnpj($userData['cnpj']);
    $company->setCompanyAddress($userData['companyAddress']);
    $company->setCompanyName($userData['companyName']);
    $company->setFantasyName($userData['fantasyName']);
    $company->setEmail($userData['email']);
    $company->setPassword($userData['password']);
    $dao->createCompany($userData['company']);
}


if (isset($_POST['btn_register'])) {
    $userData = [
        'type_user' => filter_input(INPUT_POST, 'type'),
        'cpf' => filter_input(INPUT_POST, 'cpf'),
        'cnpj' => filter_input(INPUT_POST, 'cnpj'),
        'birthdate' => filter_input(INPUT_POST, 'birthdate'),
        'address' => filter_input(INPUT_POST, 'address'),
        'companyAddress' => filter_input(INPUT_POST, 'companyAddress'),
        'companyName' => filter_input(INPUT_POST, 'companyName'),
        'fantasyName' => filter_input(INPUT_POST, 'fantasyName'),
        'email' => filter_input(INPUT_POST, 'email'),
        'password' => filter_input(INPUT_POST, 'password') 
    ];

    $dao = new RegisterUserDAO($pdo);

    $userError = $user->validatePhysicalAvailability($userData['email']);
    $companyError = $user->validateCompanyAvailability($userData['cnpj']);

    if(empty($userError)){
        createUser($userData, $dao);
    }

    if(empty($companyError)){
        createCompany($userData, $dao);
    }


    if (!empty($userError) || !empty($companyError)) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => $physicalError ?? $companyError,
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
