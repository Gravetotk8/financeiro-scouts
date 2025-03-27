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