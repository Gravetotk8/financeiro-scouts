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

$nome = $_POST["nome"];
$documento = $_POST["documento"];
$vencimento = $_POST["vencimento"];
$valor = $_POST["valor"];

$stmt = $conn->prepare("INSERT INTO cadastro_boletos (nome, numero_documento, data_vencimento, valor, status) VALUES (?, ?, ?, ?, 'A PAGAR')");
$stmt->bind_param("sssd", $nome, $documento, $vencimento, $valor);

if ($stmt->execute()) {
    header("Location: sucesso.html");
    exit();
} else {
    header("Location: erro.html?erro=" . urlencode($stmt->error));
    exit();
}

$stmt->close();
$conn->close();
?>