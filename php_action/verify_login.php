<?php
session_start();

include_once('includes/login_verification.php');
include_once('db_connect.php');

function clearString($input)
{
    global $conn;
    //con db
    $var = mysqli_escape_string($conn, $input);
    //xss - cross site scripting
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_POST['btn_login'])) {
    $passCrypt = md5($_POST['password']);

    $email = clearString($_POST['email']);
    $password = clearString($passCrypt);

    if (empty($email) or empty($password)) {
        $_SESSION['message'] = array(
            'status' => true,
            'message' => 'Preencha os campos corretamente!',
            'cod' => 00004
        );
        header('location: ../login.php');
    } else {
        $sql = "SELECT email FROM costumer_register WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "SELECT * FROM costumer_register WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $dados = mysqli_fetch_array($result);
                $_SESSION['logado'] = array(
                    'id' => $dados['id'],
                    'email' => $dados['email'],
                    'type_user' => $dados['type_user']
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
