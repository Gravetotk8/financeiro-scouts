<?php

require 'PHP/config2.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT id, nome FROM nomes ORDER BY nome ASC";
$result = $conn->query($sql);

echo "<option value=''>Selecione um nome</option>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
    }
} else {
    echo "<option value=''>Nenhum resultado encontrado</option>";
}

$conn->close();

?>