<?php
session_start();
include_once __DIR__ . ("/../models/User.php");
include_once __DIR__ . ("/../models/Company.php");

class RegisterUserDAO implements CreateUserDAOModel
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }
    public function validatePhysicalAvailability($email)
    {
        $verifyPhysicalRegister = $this->pdo->prepare("SELECT * FROM costumer_register WHERE email = :email");
        $verifyPhysicalRegister->bindValue(':email', $email);
        $verifyPhysicalRegister->execute();

        if ($verifyPhysicalRegister->rowCount() > 0) {
            return 'Email já cadastrado no sistema';
        }
    }

    public function validateCompanyAvailability($cnpj)
    {
        $verifyLegalRegister = $this->pdo->prepare("SELECT * FROM company_register WHERE cnpj = :cnpj");
        $verifyLegalRegister->bindValue(':cnpj', $cnpj);
        $verifyLegalRegister->execute();

        if ($verifyLegalRegister->rowCount() > 0) {
            return 'Empresa já cadastrada no sistema';
        }
    }
    public function createUser(User $user)
    {
        $sql = $this->pdo->prepare("INSERT INTO costumer_register (type_user, cpf, birthdate, address, email, password) VALUES (:type_user, :cpf, :birthdate, :address, :email, :password)");
        $sql->bindValue(':type_user', $user->getTypeUser());
        $sql->bindValue(':cpf', $user->getCpf());
        $sql->bindValue(':birthdate', $user->getBirthdate());
        $sql->bindValue(':address', $user->getAddress());
        $sql->bindValue(':email', $user->getEmail());
        $sql->bindValue(':password', $user->getPassword());
        $sql->execute();

        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'cod' => 00001
        );
        header('location: ../login.php');
        exit;
    }
    public function createCompany(Company $company)
    {
        $sql = $this->pdo->prepare("INSERT INTO company_register (type_user, cnpj, address, companyName, fantasyName, email, password) VALUES (:type_user, :cnpj, :companyAddress, :companyName, :fantasyName, :email, :password)");
        $sql->bindValue(':type_user', $company->getTypeUser());
        $sql->bindValue(':cnpj', $company->getCnpj());
        $sql->bindValue(':companyName', $company->getCompanyName());
        $sql->bindValue(':companyAddress', $company->getCompanyAddress());
        $sql->bindValue(':fantasyName', $company->getFantasyName());
        $sql->bindValue(':email', $company->getEmail());
        $sql->bindValue(':password', $company->getPassword());
        $sql->execute();

        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'cod' => 00001
        );
        header('location: ../login.php');
        exit;
    }
}
