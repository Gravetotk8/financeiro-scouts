<?php
require 'PHP/conect_dados.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icone.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets/imagens/icone.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
    <title>Dados Cadastrados</title>
</head>

<body>
    <div class="container mt-5">

        <div class="text-center mb-4">
            <a href="agenda.php" class="btn btn-primary">Exibir Agenda</a>
            <a href="index.php" class="btn btn-primary">Voltar para o formulário</a>
        </div>
        <hr>

        <h1 class="text-center text-primary">Dados Cadastrados</h1>
        <div class="table-container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <table class="table table-bordered table-striped table-auto-width">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Número do Documento</th>
                            <th>Data de Vencimento</th>
                            <th>Valor</th>
                            <th>Mês</th>
                            <th>Situação</th>
                            <th>Status Vencimento</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        require 'assets/php/import_dados.php';
                        ?>

                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>