<?php
session_start();
require_once 'conexaobd.php';

if (isset($_SESSION['logado']) && $_SESSION['logado'] == '2etapas') {

    $usuario2etapas = $_SESSION['usuario'];
    $resultado = mysqli_query($conexao, "SELECT * FROM usuario WHERE nome_usuario='$usuario2etapas'");

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if ($_POST) {
            $codigo_digitado = $_POST['codigo'];
            $codigo_gerado = $usuario['codigo2etapas'];

            if ($codigo_gerado === $codigo_digitado) {
                $_SESSION['logado'] = 'logado';
                header('Location: perfil.php');
                exit;
            } else {
                $erro = "Código incorreto!";
            }
        }
    } else {
        die("Usuário não encontrado.");
    }

} elseif (isset($_SESSION['logado']) && $_SESSION['logado'] == 'logado') {
    header('Location: perfil.php');
    exit;
} else {
    header('Location: entrar.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Segunda Etapa</title>
</head>
<body>
<h2>Digite o código enviado:</h2>
<?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
<form method="post">
    <input type="text" name="codigo" required>
    <button type="submit">Verificar</button>
</form>
</body>
</html>
