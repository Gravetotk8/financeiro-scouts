<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icone.ico" type="image/x-icon">
    <link rel="shortcut icon" href="icone.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Agenda de Pagamentos</title>
</head>

<body>

    <div class="header">
        <h1>Agenda de Pagamentos</h1>
        <select id="mes">
            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <option value="3">Março</option>
            <option value="4">Abril</option>
            <option value="5">Maio</option>
            <option value="6">Junho</option>
            <option value="7">Julho</option>
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
        <select id="ano">
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
        </select>
        <select id="status">
            <option value="A PAGAR">A PAGAR</option>
            <option value="PAGO">PAGO</option>
        </select>
    </div>

    <div class="total-mes-container">
        <div class="total-mes" id="totalMes">
            Total do Mês: 0
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>SEGUNDA</th>
                <th>TERÇA</th>
                <th>QUARTA</th>
                <th>QUINTA</th>
                <th>SEXTA</th>
                <th>SÁBADO</th>
                <th>DOMINGO</th>
                <th>TOTAL DA SEMANA</th>
            </tr>
        </thead>
        <tbody id="calendario">
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-primary">Voltar para o formulário</a>
    </div>

    <!-- <script src="script.js"></script> -->

    <script>
        function gerarCalendario() {
            const mesSelecionado = parseInt(document.getElementById("mes").value);
            const anoSelecionado = parseInt(document.getElementById("ano").value);
            const statusSelecionado = document.getElementById("status").value;

            const primeiroDia = new Date(anoSelecionado, mesSelecionado - 1, 1);
            let primeiroDiaSemana = primeiroDia.getDay();
            primeiroDiaSemana = primeiroDiaSemana === 0 ? 6 : primeiroDiaSemana - 1;

            const ultimoDiaMes = new Date(anoSelecionado, mesSelecionado, 0).getDate();
            const tabelaCalendario = document.getElementById("calendario");
            tabelaCalendario.innerHTML = "";

            fetch(`get_pagamentos.php?status=${encodeURIComponent(statusSelecionado)}`)
                .then(response => response.json())
                .then(pagamentos => {
                    let diaAtual = 1;
                    let totalMes = 0;
                    let totalSemanal = 0;
                    for (let i = 0; i < 6; i++) {
                        const linha = tabelaCalendario.insertRow();
                        let totalSemana = 0;
                        let valorSemanal = 0;
                        for (let j = 0; j < 7; j++) {
                            const celula = linha.insertCell();
                            if (i === 0 && j < primeiroDiaSemana) {
                                celula.innerHTML = "";
                            } else if (diaAtual > ultimoDiaMes) {
                                celula.innerHTML = "";
                            } else {
                                const dataFormatada = `${anoSelecionado}-${mesSelecionado.toString().padStart(2, '0')}-${diaAtual.toString().padStart(2, '0')}`;
                                const pagamentosDoDia = pagamentos.filter(p => p.data_vencimento.substring(0, 10) === dataFormatada);
                                let valorTotalDoDia = 0;
                                if (pagamentosDoDia.length > 0) {
                                    valorTotalDoDia = pagamentosDoDia.reduce((total, p) => total + parseFloat(p.valor), 0);
                                }
                                celula.innerHTML = `${diaAtual}<br>R$ ${valorTotalDoDia.toFixed(2)}`;
                                valorSemanal += valorTotalDoDia;
                                totalSemana++;
                                diaAtual++;
                            }
                        }
                        const celulaTotal = linha.insertCell();
                        celulaTotal.innerHTML = `R$ ${valorSemanal.toFixed(2)}`;
                        totalMes += valorSemanal;
                    }

                    document.getElementById("totalMes").innerHTML = `Total do Mês: R$ ${totalMes.toFixed(2)}`;
                })
                .catch(error => console.error('Erro ao buscar pagamentos:', error));
        }

        const hoje = new Date();
        document.getElementById("mes").value = hoje.getMonth() + 1;
        document.getElementById("ano").value = hoje.getFullYear();

        gerarCalendario();
        document.getElementById("mes").addEventListener("change", gerarCalendario);
        document.getElementById("ano").addEventListener("change", gerarCalendario);
        document.getElementById("status").addEventListener("change", gerarCalendario);
    </script>

</body>

</html>