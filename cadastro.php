<?php
session_start();

if ($_POST) {
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        header("Location: cadastro.php?erro=csrf_invalido");
        exit;
    }

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($nome) || empty($email) || empty($senha)) {
        header("Location: cadastro.php?erro=campos_vazios");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: cadastro.php?erro=email_invalido");
        exit;
    }

    if (strlen($senha) < 8) {
        header("Location: cadastro.php?erro=senha_fraca");
        exit;
    }

    require_once 'conexao.php';

    $stmt_check = $conexao->prepare("SELECT id FROM usuario WHERE nome = ? OR email = ?");
    $stmt_check->bind_param("ss", $nome, $email);
    $stmt_check->execute();
    $resultado = $stmt_check->get_result();

    if ($resultado->num_rows > 0) {
        header("Location: cadastro.php?erro=usuario_ou_email_existente");
        exit;
    }

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    $stmt_insert = $conexao->prepare("INSERT INTO usuario (nome, senha, email) VALUES (?, ?, ?)");
    $stmt_insert->bind_param("sss", $nome, $senhaCriptografada, $email);

    if ($stmt_insert->execute()) {
        $mensagem = "1"; 
    } else {
        $mensagem = "0"; 
    }

    header("Location: index.php?mensagem=$mensagem");
    exit;
} else {
    header("Location: cadastro.php");
    exit;
}
?>
