<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icone.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets/imagens/icone.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Financeiro Scouts</title>
</head>

<body>
    <div class="container mt-5">

        <div class="text-center mb-4">
            <a href="agenda.php" class="btn btn-primary">Exibir Agenda</a>
            <a href="exibir_atualizar.php" class="btn btn-primary">Exibir Dados Cadastrados</a>
            <a href="cadastrar_fornecedor.html" class="btn btn-success">Cadastrar Fornecedor</a>
        </div>
        <hr>

        <h1 class="text-center">Financeiro</h1>
        <form id="meuFormulario" action="assets/php/processar_formulario.php" method="POST" accept-charset="UTF-8">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <select class="form-select" id="nome" name="nome">
                    <?php include 'assets/php/nomes_dropdown.php'; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="documento" class="form-label">Número do Documento:</label>
                <input type="text" class="form-control" id="documento" name="documento">
            </div>

            <div class="mb-3">
                <label for="vencimento" class="form-label">Data de Vencimento:</label>
                <input type="date" class="form-control" id="vencimento" name="vencimento">
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor:</label>
                <input type="number" class="form-control" id="valor" name="valor" step="0.01">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>