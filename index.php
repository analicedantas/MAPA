<?php
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] == '2etapas') {
    header('Location: 2etapas.php');
    exit(0);
} else if (isset($_SESSION['logado']) && $_SESSION['logado'] == 'logado') {
    header('Location: perfil.php');
    exit(0);
} else {
    if ($_POST) {
        $usuarioQueSeLogou = $_POST['usuario'];
        $senha = $_POST['senha'];

        require_once 'conexao.php';

        $usuarioEscapado = mysqli_real_escape_string($conexao, $usuarioQueSeLogou);

        $resultado = mysqli_query($conexao, "SELECT * FROM usuarios WHERE usuario='$usuarioEscapado'");

        if ($resultado) {
            $usuario = mysqli_fetch_assoc($resultado);

            if ($usuario && password_verify($senha, $usuario['senha'])) {

                $codigo = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), -4);

                $codigoEscapado = mysqli_real_escape_string($conexao, $codigo);

                $resultado = mysqli_query($conexao, "UPDATE usuarios SET codigo2etapas='$codigoEscapado' WHERE usuario='$usuarioEscapado'");

                if ($resultado) {
                    $_SESSION['logado'] = '2etapas';
                    $_SESSION['usuario'] = $usuario['usuario'];

                    header('Location: 2etapas.php');
                    exit(0);
                }
            }
        }
    }
}

require_once 'header.php';
?>

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
