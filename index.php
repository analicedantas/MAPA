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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
         <div class="design-section">
            <h1>Bem vindo ao MAPA</h1>
        </div>
    <div class="container">
        <div class="login-section">
            <form>
                <div class="form-section">
                        <h2 style="color:  rgba(0, 201, 194, 1);;">Login</h2>
                        <input type="text" class="form-control" placeholder="Digite o seu e-mail: " aria-label="Username">
                </div>
                <div class="form-section">
                        <input type="text" class="form-control" placeholder="Digite a sua senha: ">
                </div>
                <div class="form-section">
                        <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
                </form>
        </div>
    </div>
    <style>
        
        body{
            background-color: rgba(18, 31, 31, 1);
            display: flex;

        }

        .container{
            display: flex;
            align-items: center;
            width: 50%;
            justify-content: center;
        }

        .login-section{
            display: flex;
            background-color: white;
            border-radius: 10px;
            height: 50vh;
            width: 40vh;
            padding: auto;
            
        }

        .design-section{
        background-color: rgba(0, 201, 194, 1);
        color: white;
        height: 100vh;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        width: 50%;
 }

        .form-section{
        text-align: center;
        align-items: center;
        }

    </style>
</body>
</html>
