<?php
session_start();
include('db.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $usuario_id = $_SESSION['usuario']['id'];
    $foto_nome = uniqid() . '_' . basename($_FILES['foto']['name']);
    $caminho = "../img/" . $foto_nome;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho)) {
        // Salva no banco de dados
        $sql = "INSERT INTO livros (titulo, foto, categoria, usuario_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $titulo, $foto_nome, $categoria, $usuario_id);

        if ($stmt->execute()) {
            header("Location: ../paginaLivros.php?sucesso=1");
        } else {
            echo "Erro ao salvar o livro: " . $stmt->error;
        }
    } else {
        echo "Erro ao fazer upload da foto";
    }
}
?>