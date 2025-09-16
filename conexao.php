<?php
$servername = "localhost";
$username = "root";
$password = ""; // ou sua senha, se tiver
$database = "diabetes";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
