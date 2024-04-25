<?php

class User
{
    private $type_user;
    private $cpf;
    private $birthdate;
    private $address;
    private $email;
    private $password;

    public function setTypeUser($typeUser)
    {
        $this->type_user = $typeUser;
    }
    public function getTypeUser()
    {
        return $this->type_user;
    }
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function getPassword()
    {
        return $this->password;
    }
}

interface CreateUserDAOModel
{
    public function validatePhysicalAvailability($email);
    public function validateCompanyAvailability($cnpj);
    public function createUser(User $user);
    public function createCompany(Company $company);
}
