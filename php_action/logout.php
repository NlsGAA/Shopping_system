<?php
session_start();
session_unset();
session_destroy();
header('location: http://localhost/sistema_de_compra/login.php');
