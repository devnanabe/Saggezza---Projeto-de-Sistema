<?php
    
    define('HOST','localhost');
    define('USER', 'root');
    define('PASS', '');
    define('BASE', 'saggezza');

    $conn = new MySQLi(HOST, USER, PASS, BASE);

    if($conn->connect_errno)
    {
        exit("Erro ao se conectar com o banco de dados: " . $conn->connect_error);
    }
    
?>

