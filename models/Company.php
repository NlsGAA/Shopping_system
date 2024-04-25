<?php

class Company
{
    private $type_user;
    private $cnpj;
    private $companyAddress;
    private $companyName;
    private $fantasyName;
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
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }
    public function getCnpj()
    {
        return $this->cnpj;
    }
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;
    }
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }
    public function getCompanyName()
    {
        return $this->companyName;
    }
    public function setFantasyName($fantasyName)
    {
        $this->fantasyName = $fantasyName;
    }
    public function getFantasyName()
    {
        return $this->fantasyName;
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
