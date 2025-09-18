<?php

$usuario = 'root';
$senha = '';
$dbname = 'dbmapa';
$host = 'localhost';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}
?>
