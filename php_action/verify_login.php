<?php
session_start();

include_once __DIR__ . ("/db_connect.php");
include_once('db_connect.php');

if (isset($_POST['btn_login'])) {

    $email = filter_input(INPUT_POST, 'email');
    $passCrypt = filter_input(INPUT_POST, 'password');
    $password = md5($passCrypt);

    if (empty($email) or empty($password)) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Preencha os campos corretamente!',
            'cod' => 00004
        );
        header('location: ../login.php');
    } else {
        $sql = $pdo->prepare(
            "SELECT email FROM costumer_register WHERE email = :email 
            UNION 
            SELECT email FROM company_register WHERE email = :email"
        );
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare(
                "SELECT id, email, type_user FROM costumer_register WHERE email = :email AND password = :password 
                UNION 
                SELECT id, email, type_user FROM company_register WHERE email = :email AND password = :password"
            );
            $sql->bindValue(':email', $email);
            $sql->bindValue(':password', $password);
            $success = $sql->execute();

            if ($sql->rowCount() == 1) {
                $data_str = json_encode($sql->fetch(PDO::FETCH_ASSOC));
                $data = json_decode($data_str);
                // $dados = mysqli_fetch_array($result);
                $_SESSION['logado'] = array(
                    'id' => $data->id,
                    'email' => $data->email,
                    'type_user' => $data->type_user
                );

                header('location: ../home.php');
            } else {
                $_SESSION['message'] = array(
                    'status' => true,
                    'message' => 'Login/Senha incorreto, tente novamente!',
                    'cod' => 00006
                );
                header('location: ../login.php');
            }
        } else {
            $_SESSION['message'] = array(
                'status' => true,
                'message' => 'Usuário não está cadastrado',
                'cod' => 00007
            );
            header('location: ../login.php');
        }
    }
}
