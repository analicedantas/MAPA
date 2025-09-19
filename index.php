<?php
require_once "config.php";
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Este nome de usuário já está em uso.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            unset($stmt);
        }
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira uma senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A senha não confere.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            if($stmt->execute()){
                header("location: login.php");
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            unset($stmt);
        }
    }
    
    unset($pdo);
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
            background-color: rgb(245, 245, 245);
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
            margin-top: 3vh;
            width: 100px;
            height: 5vh;
            border-radius: 3vh;
            border: none;
            font-size: 1rem;
            font-weight: bold;
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
