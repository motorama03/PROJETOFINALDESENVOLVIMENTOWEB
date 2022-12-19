<?php
    session_start();
    include 'conexao.php';
    $user = isset($_POST['user'])?$_POST['user']:"";
    $password = isset($_POST['password'])?$_POST['password']:"";
    $passwordcry = md5($password);
    $acao = isset($_POST['enviar'])?$_POST['enviar']:"";
    echo"Cadastrado com sucesso!";


    if($user != "" && $password != "")
        $query = "INSERT INTO usuario (email, senha) VALUES (:user, :senha)";
    
    $stmt = $conexao->prepare($query);
    $stmt ->bindValue(':user', $user);
    $stmt->bindValue(':senha', $passwordcry);

    if($stmt->execute()){
        $usuario = $stmt->fetch();
        if($usuario){
            $_SESSION['usuario'] = $usuario['email'];
            $_SESSION['id_usuario'] = $usuario['id'];
            echo $_SESSION['usuario'];
            header('location: login.php');
        }
        header('location: login.php');
    }

?>