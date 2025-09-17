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
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>MAPA - Login</title>
    <style>
        html, body {
            height: 100%;
        }
        body {
            min-height: 100vh;
            background-color: rgba(18, 31, 31, 1);
        }
        .design-section {
            background-color: rgba(0, 201, 194, 1);
            color: white;
            min-height: 40vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        @media (min-width: 768px) {
            .design-section {
                min-height: 100vh;
            }
        }
        .login-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 2rem;
            width: 100%;
            height: 40vh;
            max-width: 350px;
            margin: 2rem auto;
            text-align: center;
        }
        .btn.btn-primary.w-100 {
            background-color: rgba(0, 201, 194, 1);
            margin-top: 10vh;
            width: 10px;
            border-radius: 3vh;
            border: none;
}
    </style>
</head>
<body>
    <div class="container-fluid min-vh-100">
        <div class="row g-0 min-vh-100">
            <div class="col-12 col-md-6 design-section">
                <h1 class="text-center">Bem vindo ao MAPA</h1>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                <div class="login-section">
                    <form method="post">
                        <h2 class="mb-4" style="color: rgba(0, 201, 194, 1);">Login</h2>
                        <div class="mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Digite o seu e-mail:" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="senha" class="form-control" placeholder="Digite a sua senha:" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
