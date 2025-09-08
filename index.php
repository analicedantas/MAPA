<?php
if(isset($_POST['email'])) {
    $email = $_POST['email']; 
    $senha = $_POST['senha'];

    if(!empty($email) && !empty($senha)) {
        $u->conectar("login", "localhost", "root", "");
        if($u->msgErro == "") {
            if($u->logar($email, $senha)) {
                header("Location: areaprivada.php");
                exit();
            } else {
                ?>
                <div class="msg-erro">
                    Email e/ou senha estão incorretos!
                </div>
                <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                <?php echo htmlspecialchars("Erro: " . $u->msgErro); ?>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="msg-erro">
            Preencha todos os campos!
        </div>
        <?php
    }
}
?>
