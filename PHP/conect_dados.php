<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php'; // Inclui o autoload do Composer

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__); // Cria uma instância do Dotenv
$dotenv->load(); // Carrega as variáveis do .env

$servername = $_ENV['SERVERNAME'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$dbname = $_ENV['DBNAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
if (isset($_POST["ids"]) && isset($_POST["status"])) {
    $ids = $_POST["ids"];
    $status = $_POST["status"];

    $atualizacoes_sucesso = true;

    foreach ($ids as $id) {
        $novo_status = $status[$id];

        $stmt = $conn->prepare("UPDATE cadastro_boletos SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $novo_status, $id);

        if (!$stmt->execute()) {
            $atualizacoes_sucesso = false;
            error_log("Erro ao atualizar o boleto com ID " . $id . ": " . $stmt->error);
            $_SESSION['erro'] = "Erro ao atualizar o boleto com ID " . $id . ": " . $stmt->error;
            break;
        }

        $stmt->close();
    }
}

if (isset($_SESSION['sucesso'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['sucesso'] . "</div>";
    unset($_SESSION['sucesso']);
}

if (isset($_SESSION['erro'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['erro'] . "</div>";
    unset($_SESSION['erro']);
}
?>