<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require(__DIR__ . '/../../PHP/config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$nome = $_POST["nome"];
$documento = $_POST["documento"];
$vencimento = $_POST["vencimento"];
$valor = $_POST["valor"];

// Formatar o valor para usar ponto como separador decimal
$valor_formatado = str_replace(',', '.', $valor);

$stmt = $conn->prepare("INSERT INTO cadastro_boletos (nome, numero_documento, data_vencimento, valor, status) VALUES (?, ?, ?, ?, 'A PAGAR')"); 
$stmt->bind_param("sssd", $nome, $documento, $vencimento, $valor_formatado);

if ($stmt->execute()) {
    header("Location: ../../sucesso.html");
    exit();
} else {
    header("Location: erro.php?erro=" . urlencode($stmt->error));
    exit();
}

$stmt->close();
$conn->close();
?>