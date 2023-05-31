<?php

// CONEXÃO COM PDO
// $pdo = new PDO('mysql:host=localhost;dbname=syschamados', 'root', '260218#Bi');

// if (isset($_POST['acao'])) {
//   $problema = $_POST['problema'];
//   $setor = $_POST['setor'];
//   $nome = $_POST['nome'];
//   $comentario = $_POST['comentario'];
//   $sql = $pdo->prepare("INSERT INTO `chamados` VALUES (null,?,?,?,?)");
//   $sql->execute(array($problema,$setor,$nome,$comentario));
//   echo '<h2 style="padding:10px;margin:0;text-align:center;background-color:green;color:greenyellow;">Seu chamado foi enviado!</h2>';
// }
// END CONEXÃO COM PDO


// CONEXÃO COM MYSQLI


$usuario = 'root';
$senha = '';
$database = 'syschamados';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->error) {
  die ("Falha ao conectar ao banco de dados: ".$mysqli->error);
}

if (isset($_POST['acao'])) {
  $problema = $_POST['problema'];
  $setor = $_SESSION['login'];
  $nome = $_POST['nome'];
  $comentario = $_POST['comentario'];
  $momento_registro = date('Y-m-d H:i:s');
  $numb = 1;
  $sql = $mysqli->prepare("INSERT INTO `chamados` VALUES (null,?,?,?,?,?,?)");
  $sql->execute(array($problema,$setor,$nome,$comentario,$momento_registro,$numb));
  echo '<h2 style="padding:10px;margin:0;text-align:center;background-color:green;color:greenyellow;">Seu chamado foi enviado!</h2>';
}


// END CONEXÃO COM MYSQLI
?>