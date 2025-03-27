<?php
$data_hoje = date('Y-m-d');

$sql = "SELECT * FROM cadastro_boletos WHERE status = 'A PAGAR' ORDER BY data_vencimento ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data_vencimento = new DateTime($row["data_vencimento"]);
        $data_formatada = $data_vencimento->format('d/m/Y');
        $valor_formatado = 'R$ ' . number_format($row["valor"], 2, ',', '.');
        $mes = $data_vencimento->format('m');

        $mes_extenso = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ][$mes];

        $hoje = new DateTime($data_hoje);
        $diferenca = $hoje->diff($data_vencimento);
        $dias_diferenca = (int)$diferenca->format("%R%a");

        if ($dias_diferenca < 0) {
            $status_vencimento = "<span class='text-danger'>Venceu</span>";
        } elseif ($dias_diferenca == 0) {
            $status_vencimento = "<span class='text-warning'>Hoje</span>";
        } elseif ($dias_diferenca > 0 && $dias_diferenca <= 30) {
            $status_vencimento = "<span class='text-info'>Prazo - Menos de " . abs($dias_diferenca) . " dias</span>";
        } else {
            $status_vencimento = "<span class='text-success'>Dentro do prazo</span>";
        }

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["numero_documento"]) . "</td>";
        echo "<td>" . $data_formatada . "</td>";
        echo "<td>" . $valor_formatado . "</td>";
        echo "<td>" . $mes_extenso . "</td>";
        echo "<td>
                                        <input type='hidden' name='ids[]' value='" . $row["id"] . "'>
                                        <select class='form-select' name='status[" . $row["id"] . "]'>
                                            <option value='A PAGAR'" . ($row["status"] == 'A PAGAR' ? ' selected' : '') . ">A PAGAR</option>
                                            <option value='PAGO'" . ($row["status"] == 'PAGO' ? ' selected' : '') . ">PAGO</option>
                                        </select>
                                    </td>";
        echo "<td>" . $status_vencimento . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>Nenhum registro encontrado.</td></tr>";
}
$conn->close();
