<?php
    session_start();
    include 'conexao.php';
    $cowdatacio = isset($_POST['cDataCio'])?$_POST['cDataCio']:0;
    $cowcod = isset($_POST['cCod'])?$_POST['cCod']:"";
    $cowdatacria = isset($_POST['cDataCria'])?$_POST['cDataCria']:0;
    $acao = isset($_POST['enviar'])?$_POST['enviar']:"";
    $id = isset($_POST['id'])?$_POST['id']:"";
    print_r($id."<br>");
    echo"Cadastrado com sucesso!";

    if($acao = 'salvar' && $id == 0){
        if($cowcod != "" && $cowdatacio != "")
            $query = "INSERT INTO dadoscriacao (codbrinco, dataCio, dataCria) VALUES (:ccodigo, :cdatacio, :cdatacria)";
        
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':ccodigo', $cowcod);
        $stmt ->bindValue(':cdatacio', $cowdatacio);
        $stmt ->bindValue(':cdatacria', $cowdatacria);

        if($stmt->execute()){
            $criacao = $stmt->fetch();
            if($criacao){
                $_SESSION['registro'] = $criacao[''];
                $_SESSION['id_registro'] = $criacao['id'];
                echo $_SESSION['criacao'];
                header('location: detalhe.php');
            }
            header('location: detalhe.php');
        }
    }
    if($acao = 'editar' && $id > 0){
        $id = isset($_POST['id'])?$_POST['id']:0;
        $cowdatacio = isset($_POST['cDataCio'])?$_POST['cDataCio']:"";
        $cowcod = isset($_POST['cCod'])?$_POST['cCod']:"";
        $cowdatacria = isset($_POST['cDataCria'])?$_POST['cDataCria']:"";

        try{
            if($id != 0 && $acao == 'editar')
                $query = 'UPDATE dadoscriacao SET dataCio = :datacio, dataCria = :cowdatacria WHERE id = :id';

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':datacio', $cowdatacio);
            $stmt->bindValue(':cowdatacria', $cowdatacria); 

            $stmt->execute();
            header('location: detalhe.php');
        }
        catch(PDOException $e){
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }
    }
    else{
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
        $id =  isset($_GET['id'])?$_GET['id']:0;
        $nome = isset($_POST['cNome'])?$_POST['cNome']:"";
        $brinco = isset($_POST['cCod'])?$_POST['cCod']:"";
        print_r($id);
        try{
            $query = 'DELETE FROM dadoscriacao WHERE id = :id';
            echo "passei por aq";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $stmt->execute();
            header('location: detalhe.php');
        }
        catch(PDOException $e){
            print("Erro ao deletar...<br>".$e->getMessage());
            die();
        }
            
        }
        
    

?>