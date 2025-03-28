<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$servername = $_ENV['SERVERNAME'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$dbname = $_ENV['DBNAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$nome_fornecedor = $_POST["nome_fornecedor"];

$stmt = $conn->prepare("INSERT INTO nomes (nome) VALUES (?)");

if (!$stmt) {
    error_log("Erro na preparação da consulta: " . $conn->error);
    header("Location: erro.html?erro=" . urlencode("Erro na preparação da consulta"));
    exit();
}

$stmt->bind_param("s", $nome_fornecedor);

if ($stmt->execute()) {
    header("Location: cadastrar_fornecedor.html");
    exit();
} else {
    error_log("Erro na execução da consulta: " . $stmt->error);
    header("Location: erro.html?erro=" . urlencode($stmt->error));
    exit();
}

$stmt->close();
$conn->close();
?>