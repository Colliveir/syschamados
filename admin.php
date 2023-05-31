<?php
include ('conexao.php');
include('chat.php');
$consulta = "SELECT * FROM chamados";
$consulta_r = "SELECT * FROM resolvidos ORDER BY id DESC";
$con = $mysqli->query($consulta) or die ($mysqli->error);
$con_r = $mysqli->query($consulta_r) or die ($mysqli->error);
$consultachat = "SELECT * FROM chat";
$conchat = $mysqli->query($consultachat) or die ($mysqli->error);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Chamados</title>
</head>

<header class="bg-secondary" style="border:2px solid black;text-align: center;background-image: none">
<h1 class="text-warning">Sistema de chamados</h1>
<p class>Developed by &copy;Bruno Collange - V13102022</p>
</header>

<br>
<body class="p-3 mb-2 bg-dark text-white" style="background-image:none;">
<div class="row">  <!-- all -->
<div class="col-sm-8">
<div class="container text-center">
    <h2 class="text-bg-success p-3">Painel Chamados</h2>
</div> <br>

    <div class="container text-center">
        <h4 style="background-color:orange;border-radius:10px;">Em aberto:</h4>
    </div>
    <table class="table table-bordered border-primary" style="margin:0 auto;">
        <tr style="text-align: center;">
            <td class="border border, p-3 mb-2 bg-primary text-white">Problema</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Setor</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Nome</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Comentário</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Data e Hora do Registro</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Status</td>
        </tr>
    <?php while($dado = $con->fetch_array()) 
    {?>
        <tr>
            <td class="p-3 mb-2 bg-danger text-white"><?php echo $dado["problema"];?></td>
            <td class="p-3 mb-2 bg-danger text-white"><?php echo $dado["setor"];?></td>
            <td class="p-3 mb-2 bg-danger text-white"><?php echo $dado["nome"];?></td>
            <td class="p-3 mb-2 bg-danger text-white"><?php echo $dado["comentario"];?></td>            
            <td class="p-3 mb-2 bg-danger text-white"><?php echo  date('d/m/Y H:i:s', strtotime($dado["momento_registro"]));?></td>
           
            <td style="padding:0;">
            <form method="POST">
                <input style="width:100%;border:none;position:relative;top:12px;" class="text-warning bg-dark p-3" type="submit" name="change" value="Marcar como Resolvido"></input>
            </form>
            </td>
        </tr>
          
    <?php 
    
    if (isset($_POST['change'])) {
        $sql = $mysqli->prepare("INSERT INTO `resolvidos` VALUES (null,?,?,?,?,?)");
        $sql->execute(array($dado["problema"],$dado["setor"],$dado["nome"],$dado["comentario"],$dado["momento_registro"]));  
    }if(isset($_POST['change'])){
        $sql = $mysqli->prepare("DELETE FROM chamados WHERE numb = 1");
        $sql->execute();
    }
}     
    ?>
    </table>

    <div class="container text-center"><br>
        <h4 style="background-color:green;border-radius:10px;">Resolvidos:</h4>
    </div>
    <table class="table table-bordered border-primary" style="margin:0 auto;">
        <tr style="text-align: center;">
            <td class="border border, p-3 mb-2 bg-primary text-white">Problema</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Setor</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Nome</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Comentário</td>
            <td class="border border, p-3 mb-2 bg-primary text-white">Data e Hora do Registro</td>
        </tr>
    <?php while($dado = $con_r->fetch_array()) { ?>
        <tr>
            <td class="text-bg-secondary p-3"><?php echo $dado["problema_r"];?></td>
            <td class="text-bg-secondary p-3"><?php echo $dado["setor_r"];?></td>
            <td class="text-bg-secondary p-3"><?php echo $dado["nome_r"];?></td>
            <td class="text-bg-secondary p-3"><?php echo $dado["comentario_r"];?></td> 
            <td class="text-bg-secondary p-3"><?php echo  date('d/m/Y H:i:s', strtotime($dado["momento_registro_r"]));?></td>
        </tr>
        
    <?php
} ?>
    </table><br>

    </div>

<!-- CHAT -->

<div class="p-3 mb-2 bg-primary text-white col-sm-4 border border-light" style="max-height:700px;border-radius:30px;">
        <h3 class="p-3 mb-2 bg-light text-success border border-light rounded" style="text-align:center;"><b>Chat</b></h3>
        <h5 style="text-align:center;"><span class="text-danger"><b>AVISO:</b></span>Para usar o sistema de chat, utilize a seguinte formatação: <p class="text-warning">Destinatário: mensagem</p></h5>
        <form class="container text-center" method="post">
            <input  class="form-control"type="text" name="mensagem" placeholder="Digite sua mensagem"required>
            <input class="d-grid gap-2 col-6 mx-auto btn btn-success border border-dark"  name="acaochat" type="submit" placeholder="Enviar"  style="margin-top:6px;width:30%;">           
        <br>
        </form>
            <?php while($dadochat = $conchat->fetch_array()) { ?>
        <h1><?php echo '<h5 class="msg text-dark">T.I para '.$dadochat["mensagem"];'</h5>'?></h1>
        <?php } ?>
        
        <a style="width: 100%;" class="border border-dark  mx-auto btn btn-primary btn btn-warning" href="admin.php">Atualizar</a>
            <form method="POST"><br>
                <input style="width: 100%;" class="border border-dark btn btn-primary btn btn-danger" type="submit" name="remove" value="Remover todas as mensagens"></input>
            </form>
    </div>
<!-- END CHAT -->
</div> <!-- end all -->

    <?php

$sql = "SELECT * from chamados";

if ($result = mysqli_query($mysqli, $sql)) {
    $rowcount = mysqli_num_rows( $result );
    // Display result
    if($rowcount !== 0){
        echo 
        '<audio id="audio" autoplay controls>
        <source src="som.mp3" type="audio/mp3">
        </audio>';
    }
 }
 
 if(isset($_POST['remove'])){
    $sql = $mysqli->prepare("DELETE FROM chat WHERE numb = 1");
    $sql->execute();
}
    ?>

</body>
</html>
