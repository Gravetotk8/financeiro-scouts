<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'PHP/config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Falha na conexão com o banco de dados: " . $conn->connect_error);
    die(json_encode(['error' => "Falha na conexão com o banco de dados."]));
}

$status = $_GET['status'];

$sql = "SELECT data_vencimento, valor FROM cadastro_boletos WHERE status = '$status'";
$result = $conn->query($sql);

if (!$result) {
    error_log("Erro na consulta SQL: " . $conn->error);
    die(json_encode(['error' => "Erro na consulta SQL."]));
}

$pagamentos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pagamentos[] = [
            'data_vencimento' => $row['data_vencimento'],
            'valor' => $row['valor']
        ];
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($pagamentos);
?>