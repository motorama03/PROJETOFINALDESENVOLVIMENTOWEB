<?php
session_start();
include 'conexao.php';
$user = isset($_POST['user'])?$_POST['user']:"";
$password = isset($_POST['password'])?$_POST['password']:"";

    if($user != "" && $password != ""){
        $query = "SELECT * FROM usuario
                WHERE email = :user AND senha = :senha";
    }
        $stmt = $conexao->prepare($query);
        $stmt ->bindValue(':user', $user);
        $stmt->bindValue(':senha', $password);

        if($stmt->execute()){
            $usuario = $stmt->fetch();
            if($user){
                $_SESSION['usuario'] = $user['nome'];
                $_SESSION['id_usuario'] = $user['id'];
                $_SESSION['user'] = $user['user'];
                header('location: index.php');
            }
        }
        header('location: login.php');
    
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
    