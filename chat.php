<?php 
$usuario = 'root';
$senha = '';
$database = 'syschamados';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->error) {
  die ("Falha ao conectar ao banco de dados: ".$mysqli->error);
}

if (isset($_POST['acaochat'])) {
  $mensagem = $_POST['mensagem'];
  $numb = 1;
  $sql = $mysqli->prepare("INSERT INTO `chat` VALUES (null,?,?)");
  $sql->execute(array($mensagem,$numb));
  echo '<h5 style="position:fixed;bottom:0px;padding:10px;width:30%;text-align:center;background-color:black;color:greenyellow;">Sua mensagem foi enviada!</h5>';
}


?>
