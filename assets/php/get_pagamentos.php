<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require(__DIR__ . '/../../PHP/config.php');

header('Content-Type: application/json');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    echo json_encode([]);
    exit;
}

$status = isset($_GET['status']) ? trim($_GET['status']) : '';

if (empty($status)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT data_vencimento, valor FROM cadastro_boletos WHERE status = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    error_log("Erro ao preparar SQL: " . $conn->error);
    echo json_encode([]);
    exit;
}

$stmt->bind_param("s", $status);
$stmt->execute();
$result = $stmt->get_result();

$pagamentos = [];
while ($row = $result->fetch_assoc()) {
    $pagamentos[] = [
        'data_vencimento' => $row['data_vencimento'],
        'valor' => number_format((float)$row['valor'], 2, '.', '')
    ];
}

$stmt->close();
$conn->close();

echo json_encode($pagamentos);
