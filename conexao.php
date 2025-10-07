<?php
  $conexao = mysqli_connect('localhost', 'root', '', 'sa');
  if (!$conexao) {  
    die("Falha na conexao com o banco de dados: " . mysqli_connect_error());  
  }
