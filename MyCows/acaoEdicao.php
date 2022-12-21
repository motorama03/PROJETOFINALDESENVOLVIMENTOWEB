<?php
    session_start();
    include 'conexao.php';
    $cowname = isset($_POST['cNome'])?$_POST['cNome']:"";
    $cowcod = isset($_POST['cCod'])?$_POST['cCod']:"";
    $acao = isset($_POST['enviar'])?$_POST['enviar']:"";
    $id = isset($_POST['id'])?$_POST['id']:"";
    print_r($id."<br>");
    echo"Cadastrado com sucesso!";

    if($acao = 'salvar' && $id == 0){
        if($cowcod != "" && $cowname != "")
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
    }
    print_r($acao);
    if($acao = 'editar' && $id > 0){
        $id = isset($_POST['id'])?$_POST['id']:0;
        $nome = isset($_POST['cNome'])?$_POST['cNome']:"";
        $brinco = isset($_POST['cCod'])?$_POST['cCod']:"";

        try{
            if($id != 0)
                $query = 'UPDATE criacao SET nome = :nome, codbrinco = :codbrinco WHERE id = :id';

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nome', $cowname);
            $stmt->bindValue(':codbrinco', $cowcod); 

            $stmt->execute();
            header('location: edicao.php');
        }
        catch(PDOException $e){
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }
    }
    else{
        echo "passei por aq";
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
        $id =  isset($_GET['id'])?$_GET['id']:0;
        $nome = isset($_POST['cNome'])?$_POST['cNome']:"";
        $brinco = isset($_POST['cCod'])?$_POST['cCod']:"";
        print_r($id);
        try{
            $query = 'DELETE FROM registro.criacao WHERE id = :id';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $stmt->execute();
            header('location: edicao.php');
        }
        catch(PDOException $e){
            print("Erro ao deletar...<br>".$e->getMessage());
            die();
        }
            
        }
        
    

?>