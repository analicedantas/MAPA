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
    <div class="container">
        <div class="login-section">
            <h2 style="color: rgba(22, 222, 215, 1)">MAPA</h2>
            <form>
                <div class = "form-section">
                    <label>E-mail</label>
                    <input type = "text" name = "e-mail" placeholder = "Digite o seu e-mail: "></input>
                </div>
            </form>
        </div>
    <div class="design-section">
        <img src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREzLjYtiM4VaXuDEUT8qfabKX7JlRnRPwAcQ&s">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis exercitationem itaque dolorum quo excepturi explicabo harum, dolor dolorem quas magni error molestiae animi quasi enim ea ullam deserunt! Pariatur, illum!</p>
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
            height: 100vh;
            width: 100vw;
        }

        .login-section{
            display: flex;
            width: 50%;
            height: 50%;
        }

        .design-section{
        background-color: rgba(22, 222, 215, 1);
        color: white;
        height: 100vh;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

    }

    .form d-flex flex-column{
        background-color: pink;
        display: flex;
     
    }
    </style>
</body>
</html>
