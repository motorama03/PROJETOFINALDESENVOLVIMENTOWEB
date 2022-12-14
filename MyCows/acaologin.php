<?php
session_start();
include 'conexao.php';
$user = isset($_POST['user'])?$_POST['user']:"";
$password = isset($_POST['password'])?$_POST['password']:"";
$acao = isset($_POST['enviar'])?$_POST['enviar']:"";
print_r($acao); 

if($acao == 'enviar'){
    if($user != "" && $password != ""){
        $query = "SELECT * FROM usuario
                WHERE email = :user AND senha = :senha";
    }
        $stmt = $conexao->prepare($query);
        $stmt ->bindValue(':user', $user);
        $stmt->bindValue(':senha', $password);

        if($stmt->execute()){
            $usuario = $stmt->fetch();
            if($usuario){
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['id_usuario'] = $usuario['id'];
                echo $_SESSION['usuario'];
                header('location: index.php');
            }
        }
}


/*
    if($user == 'Admin' && $password == 'Admin'){
        header('location: home.php');
        $eAdmin = true;
        
    }
    else{
        header('location: login.php');
        $admin = false;
        echo('Login incorreto');
        return $eAdmin;
    }
    */
?>
    