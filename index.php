<?php
session_start();

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
    <title>MAPA</title>
    <style>
        html, body {
            height: 100%;
        } 

        body {
            min-height: 100vh;
            background-color: rgb(252, 252, 252);
        }

        .design-section {
            background: linear-gradient(135deg, rgb(0, 255, 229) 20%, rgb(0, 199, 192)  60%);
            color: white;
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
            padding: 2.5rem;
            width: 100%;
            height: 45vh;
            max-width: 350px;
            margin: 2rem auto;
            text-align: center;
            
        }

        .btn.btn-primary {
            background-color: rgba(0, 201, 194, 1);
            margin-top: 5vh;
            width: 100px;
            border-radius: 3vh;
            border: none;
        }
        
        .mb-5 input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            margin-top: 1vh;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

       .col-12.col-md-6.design-section{
        color: white;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
       }

       .mb-4{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
       }
    </style>
</head>
<body>
    <div class="container-fluid min-vh-100">
        <div class="row g-0 min-vh-100">
            <div class="col-12 col-md-6 design-section">
                <h1 class="text-center">Bem vindo(a) ao MAPA!</h1>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                <div class="login-section">
                    <form method="post">
                        <h2 class="mb-4" style="color: rgba(0, 201, 194, 1);">LOGIN</h2>
                        <div class="mb-5">
                            <input type="text" name="email" class="form-control" placeholder="Digite o seu e-mail:" required>
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
