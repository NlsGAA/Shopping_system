<?php

class LoginVerify
{
    private $id;
    private $email;
    private $type_user;
    private $address;
    private $password;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setType_user($type_user)
    {
        $this->type_user = $type_user;
    }
    public function getType_user()
    {
        return $this->type_user;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }
}

interface LoginVerifyDAOModel
{
    public function dataFill();
    public function registerUserVerify($email, $password);
    public function userInformationValidate($email, $password, $passCrypt);
}
