<?php 
session_start();
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Chamados</title>
</head>



  
<?php

if (!isset($_SESSION['login'])){

    if(isset($_POST['acao'])){
        
        include("users.php");

        $loginForm= $_POST['login'];
        $senhaForm= $_POST['senha'];


         if($login_master == $loginForm && $senha_master == $senhaForm){
            // LOGIN MASTER
            $_SESSION['login'] = $login_master;
            header('Location: admin.php');
            

        } 
        if($login_recepção == $loginForm && $senha_recepção == $senhaForm){
            // LOGIN RECEPÇÃO
            $_SESSION['login'] = $login_recepção;
            header('Location: index.php');

        } 
        if($login_adm == $loginForm && $senha_adm == $senhaForm){
            // LOGIN ADM
            $_SESSION['login'] = $login_adm;
            header('Location: index.php');

        }if($login_const1 == $loginForm && $senha_const1 == $senhaForm){
            // LOGIN CONSULTÓRIO 1
            $_SESSION['login'] = $login_const1;
            header('Location: index.php');

        }if($login_const2 == $loginForm && $senha_const2 == $senhaForm){
            // LOGIN CONSULTÓRIO 2
            $_SESSION['login'] = $login_const2;
            header('Location: index.php');

        }if($login_const3 == $loginForm && $senha_const3 == $senhaForm){
            // LOGIN CONSULTÓRIO 3
            $_SESSION['login'] = $login_const3;
            header('Location: index.php');

        }if($login_ger == $loginForm && $senha_ger== $senhaForm){
            // LOGIN GERÊNCIA
            $_SESSION['login'] = $login_ger;
            header('Location: index.php');

        }if($login_rx == $loginForm && $senha_rx== $senhaForm){
            // LOGIN RAIO-X
            $_SESSION['login'] = $login_rx;
            header('Location: index.php');

        }if($login_precons == $loginForm && $senha_precons== $senhaForm){
            // LOGIN PRÉ-CONSULTA
            $_SESSION['login'] = $login_precons;
            header('Location: index.php');

        }if($login_coord == $loginForm && $senha_coord== $senhaForm){
            // LOGIN COORDENAÇÃO
            $_SESSION['login'] = $login_coord;
            header('Location: index.php');

        }if($login_farmcent == $loginForm && $senha_farmcent== $senhaForm){
            // LOGIN FARMÁCIA CENTRAL
            $_SESSION['login'] = $login_farmcent;
            header('Location: index.php');

        }if($login_farmsat == $loginForm && $senha_farmsat== $senhaForm){
            // LOGIN FARMÁCIA SATÉLITE
            $_SESSION['login'] = $login_farmsat;
            header('Location: index.php');

        }else{
            echo "<h3 style='padding:10px;margin:0;text-align:center;background-color:red;color:rgb(94, 0, 0);'>Usuário ou Senha inválidos!</h3>";
        }

       
    }

    include('login.php');

}else{

    if(isset($_GET['logout'])){
        unset($_SESSION['login']);
        session_destroy();
        header('Location: index.php');
    }

    include('home.php');
}

?>

</html>
