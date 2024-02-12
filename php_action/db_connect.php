<?php

$server = "localhost";
$user = "root";
$password = "";
$db_name = "cadastro";

$conn = mysqli_connect($server, $user, $password, $db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
}
