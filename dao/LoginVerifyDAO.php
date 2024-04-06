<?php
session_start();
include_once __DIR__ . "/../models/LoginVerify.php";

class LoginVerifyDAO implements LoginVerifyDAOModel
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }
    public function dataFill()
    {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Preencha os campos corretamente!',
            'cod' => 00004
        );
        header('location: http://localhost/sistema_de_compra/login.php');
    }
    public function registerUserVerify($email, $password)
    {
        $sql = $this->pdo->prepare(
            "SELECT email, password FROM costumer_register WHERE email = :email 
            UNION 
            SELECT email, password FROM company_register WHERE email = :email"
        );
        $sql->bindValue(':email', $email);
        $sql->execute();
        $passCrypt = $sql->fetch();
        $passCrypt = ($passCrypt['password']);

        if ($sql->rowCount() > 0) {
            $this->userInformationValidate($email, $password, $passCrypt);
        } else {
            $_SESSION['message'] = array(
                'status' => true,
                'message' => 'Usuário não está cadastrado',
                'cod' => 00007
            );
            header('location: http://localhost/sistema_de_compra/login.php');
        }
    }
    public function userInformationValidate($email, $password, $passCrypt)
    {
        if (password_verify($password, $passCrypt)) {
            $sql = $this->pdo->prepare(
                "SELECT id, email, type_user FROM costumer_register WHERE email = :email AND password = :password 
                UNION 
                SELECT id, email, type_user FROM company_register WHERE email = :email AND password = :password"
            );
            $sql->bindValue(':email', $email);
            $sql->bindValue(':password', $passCrypt);
            $sql->execute();
            if ($sql->rowCount() == 1) {
                $data_str = json_encode($sql->fetch(PDO::FETCH_ASSOC));
                $data = json_decode($data_str);
                $_SESSION['logado'] = array(
                    'id' => $data->id,
                    'email' => $data->email,
                    'type_user' => $data->type_user
                );

                header('location: http://localhost/sistema_de_compra/home.php');
            }
        } else {

            $_SESSION['message'] = array(
                'status' => true,
                'message' => 'Login/Senha incorreto, tente novamente!',
                'cod' => 00006
            );
            header('location: http://localhost/sistema_de_compra/login.php');
        }
    }
}
