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
    <title>Erro</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Ocorreu um erro ao inserir o registro.</h1>
        <p class="text-center">Erro:
            <?php echo $_GET["erro"]; ?>
        </p>
        <div class="text-center mt-3">
            <a href="index.html" class="btn btn-danger">Voltar para o formulário</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>