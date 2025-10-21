<?php
session_start();
require_once 'conexaobd.php';

$erro = '';

if (isset($_SESSION['logado']) && $_SESSION['logado'] == '2etapas') {
    header('Location: 2etapas.php');
    exit;
} elseif (isset($_SESSION['logado']) && $_SESSION['logado'] == 'logado') {
    header('Location: perfil.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioQueSeLogou = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $usuarioEscapado = mysqli_real_escape_string($conexao, $usuarioQueSeLogou);

    $stmt = mysqli_prepare($conexao, "SELECT * FROM usuario WHERE nome_usuario = ?");
    mysqli_stmt_bind_param($stmt, "s", $usuarioEscapado);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if ($usuario) {
        if (password_verify($senha, $usuario['senha_usuario'])) {
            $codigo = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), -4);

            $stmt2 = mysqli_prepare($conexao, "UPDATE usuario SET codigo2etapas = ? WHERE nome_usuario = ?");
            mysqli_stmt_bind_param($stmt2, "ss", $codigo, $usuarioEscapado);
            $ok = mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);

            if ($ok) {
                $_SESSION['logado'] = '2etapas';
                $_SESSION['usuario'] = $usuario['nome_usuario'];
                header('Location: 2etapas.php');
                exit;
            } else {
                $erro = "Falha ao atualizar código 2 etapas.";
            }
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - MAPA</title>
    <link rel="stylesheet" href="seu_estilo.css">
</head>
<body>
<div class="container-fluid min-vh-100">
    <div class="row g-0 min-vh-100">
        <div class="col-12 col-md-6 design-section">
            <h1 class="text-center">Bem-vindo(a) ao MAPA!</h1>
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
            <div class="login-section">
                <form method="post">
                    <h2 class="mb-4" style="color: rgba(0, 201, 194, 1);">LOGIN</h2>

                    <?php if ($erro): ?>
                        <p style="color:red;"><?php echo htmlspecialchars($erro); ?></p>
                    <?php endif; ?>

                    <div class="mb-5">
                        <input type="text" name="usuario" class="form-control" placeholder="Digite o seu usuário:" required>
                    </div>
                    <div class="mb-5">
                        <input type="password" name="senha" class="form-control" placeholder="Digite a sua senha:" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
