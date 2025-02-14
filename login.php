<?php
session_start();
include('backend/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: paginaLivros.php");
            exit();
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paginaRegistro.css">
    <title>Login - Estante de Livros</title>
    <link rel="icon" href="img/6c2589cd04394c6bac9f4bff26e58045.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/paginaPrincipal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pinyon+Script&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <header>
            <h1>FLOPESTANTE</h1>
            <img src="img/6c2589cd04394c6bac9f4bff26e58045.png">
            <p>Bem vindo a flopestante, a sua web estante favorita de livros!</p>
        </header>
        <section>
            <div id="quadro-login" class="container-fluid">
                <h2>Entrar</h2>
                <form method="post">
                    <input type="text" class="form-control" name="nome" placeholder="Seu nome" required>
                    <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    <button type="submit" class="btn btn-warning">Entrar</button>
                </form>
            </div>
        </section>
        <footer>
            <a href="creditos.html" id="creditos">Créditos</a>
        </footer>
    </main>
</body>
</html>
