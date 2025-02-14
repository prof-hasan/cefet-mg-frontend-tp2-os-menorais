<?php
session_start();
include('backend/db.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// Busca os livros
$sql = "SELECT * FROM livros WHERE usuario_id = $usuario_id";
$result = $conn->query($sql);

// Organiza os livros
$livros = [
    'ja_li' => [],
    'em_andamento' => [],
    'quero_ler' => []
];

while ($livro = $result->fetch_assoc()) {
    $livros[$livro['categoria']][] = $livro;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale=1.0">
    <title>Sua Página - Estante de Livros</title>
    <link rel="icon" href="img/6c2589cd04394c6bac9f4bff26e58045.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/paginaLivros.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pinyon+Script&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <header>
            <h1>Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?>!</h1>
        </header>


        <section>


        <div class="categoria" id="em-andamento">
                <h2>Leituras em Andamento</h2>
                <ul>
                    <?php foreach ($livros['em_andamento'] as $livro): ?>
                        <li>
                            <img src="img/<?php echo $livro['foto']; ?>" alt="<?php echo $livro['titulo']; ?>">
                            <p><?php echo $livro['titulo']; ?></p>
                        </li>        
                    <?php endforeach; ?>
                </ul>
                        
        </div>

        <div class="categoria" id="concluidos">
                <h2>Leituras Concluídas</h2>
                <ul>
                    <?php foreach ($livros['ja_li'] as $livro): ?>
                        <li>
                            <img src="img/<?php echo $livro['foto']; ?>" alt="<?php echo $livro['titulo']; ?>">
                            <p><?php echo $livro['titulo']; ?></p>
                        </li>        
                    <?php endforeach; ?>
                </ul>
                        
        </div>

        <div class="categoria" id="futuro">
                <h2>Leituras Futuras</h2>
                <ul>
                    <?php foreach ($livros['quero_ler'] as $livro): ?>
                        <li>
                            <img src="img/<?php echo $livro['foto']; ?>" alt="<?php echo $livro['titulo']; ?>">
                            <p><?php echo $livro['titulo']; ?></p>
                        </li>        
                    <?php endforeach; ?>
                </ul>
                        
        </div>
        </section>
        <button id="adicionar-livro" class="btn btn-success">Adicionar Novo Livro</button>
        <a href="backend/saidaconta.php" class="btn btn-danger" id="link-saida">Sair</a>
    </main>

    <div id="modal" class="sumida container-fluid">
        <h2>Adicionar Novo Livro</h2>
        <form action="backend/salvar_livro.php" method="POST" enctype="multipart/form-data" id="form-modal">
            <input type="text" name="titulo" placeholder="Nome do Livro" required>
            <input type="file" name="foto" accept="image/*" required>
            <select name="categoria" required>
                <option value="em_andamento">Em Andamento</option>
                <option value="ja_li">Leitura Concluída</option>
                <option value="quero_ler">Leitura Futura</option>
            </select>
            <div id="botoes-div">
                <button id="fechar" class="btn btn-danger" >X</button>
                <button type="submit" class="btn btn-success">Adicionar</button>
            </div>
        </form>
    </div>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="js/modal.js"></script>
</body>
</html>
