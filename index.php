<?php
session_start();

// Se já estiver logado, vai direto pro painel
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: dashboard.php");
    exit();
}

$erro = '';

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (!empty($email) && !empty($senha)) {
        $email_valido = 'usuario@gmail.com';
        $senha_valida = '123456';

        if ($email === $email_valido && $senha === $senha_valida) {
            $_SESSION['logado'] = true;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            $erro = "E-mail ou senha incorretos.";
        }
    } else {
        $erro = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MAPA</title>
    <style>
        body { font-family: Arial; background: #f4f4f9; text-align: center; padding-top: 80px; }
        .form-box {
            display: inline-block;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 320px;
        }
        .form-box h2 { margin-top: 0; color: #333; }
        .form-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-box button {
            width: 100%;
            padding: 12px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-box button:hover { background: #0056b3; }
        .erro {
            color: red;
            background: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Login Administrativo</h2>

        <?php if (!empty($erro)): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="E-mail" required value="<?= htmlspecialchars($email ?? '') ?>">
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>

