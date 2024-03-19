<?php
// Configurações de conexão com o banco de dados
$hostname= 'localhost';
$database = 'saggezza';
$username = 'root';
$password = '';

$conn = new mysqli($hostname, $username, $password, $database);
        // Verifica se ocorreu algum erro durante a conexão
        if ($conn->connect_error) {
            die('Erro de conexão: ' . $conn->connect_error);
        }

// Retorna a conexão
return $conn;
?>
