<?php
    session_start();
    include 'conexao.php';
    $cowname = isset($_POST['cNome'])?$_POST['cNome']:"";
    $cowcod = isset($_POST['cCod'])?$_POST['cCod']:"";
    $acao = isset($_POST['enviar'])?$_POST['enviar']:"";
    echo"Cadastrado com sucesso!";


    if($cowname != "" && $cowcod != "")
        $query = "INSERT INTO criacao (nome, codbrinco) VALUES (:cnome, :ccodigo)";
    
    $stmt = $conexao->prepare($query);
    $stmt ->bindValue(':cnome', $cowname);
    $stmt->bindValue(':ccodigo', $cowcod);

    if($stmt->execute()){
        $criacao = $stmt->fetch();
        if($criacao){
            $_SESSION['registro'] = $criacao[''];
            $_SESSION['id_registro'] = $criacao['id'];
            echo $_SESSION['criacao'];
            header('location: edicao.php');
        }
        header('location: edicao.php');
    }

?>