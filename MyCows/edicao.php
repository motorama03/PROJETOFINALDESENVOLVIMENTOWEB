<?php
    include_once 'conf.inc.php';
    $id = isset($_GET['id'])?$_GET['id']:"";
    $acao = isset($_GET['acao'])?$_GET['acao']:"";
    $cNome = isset($_POST['cNome']);
    $cCod = isset($_POST['cCod']);
    // verifica se está editando um registro
    if ($acao == 'editar'){
        // buscar dados do usuário que estamos editando
        try{
            // cria a conexão com o banco de dados 
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
            // montar consulta
            $query = 'SELECT * FROM registro.criacao WHERE id = :id' ;
            // preparar consulta
            $stmt = $conexao->prepare($query);
            // vincular variaveis com a consult
            $stmt->bindValue(':id',$id); 
            // executa a consulta
            $stmt->execute();
            // pega o resultado da consulta - nesse caso a consulta retorna somente um registro pq estamos buscando pelo ID que é único 
            // por isso basta um fetch
            $criacao = $stmt->fetch(); 
             
        }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }  
    }
?>

<!DOCTYPE html>



<style>
    body{
      font-family: Arial, Helvetica, sans-serif;
      background-image: linear-gradient(to right, rgb(255, 255, 255), rgb(122, 118, 118));
    }

    .Centroform{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .body{
            background-image: linear-gradient(rgb(244, 250, 244), rgb(146, 146, 146));
        }
        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            background-color: rgb(255, 255, 255, 0.6);
            transform: translate(-50%, -50%);
            padding: 15px;
            width: 35%;
        }
        .inputbox{
            position: relative;
            text-align: center;
        }
        .errado{
            text-decoration: red;
        }
        .container{
            max-width: 1200px;
            margin: 0 auto;
            border: 1px #fff;
        }
        .span-required{
            font-size: 12px;
            margin: 3px 0 0 1px;
            color: var(--color-red);
            display: none;
        }
        
</style>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <seccion class="container">
    <a href="home.php">Página inicial</a> 
        <form method="POST" id="form" action="acaoedicao.php">
            <div class="inputbox">
                <h5>Cadastro criação</h5><br>
                <input readonly type="text" name="id" id="id" value=<?php if(isset($criacao))echo $criacao['id']; else echo 0 ?>><br>
                <label for="cNome">Informe o nome da vaca!</label><br>
                <input name="cNome" type="text" id="cNome" placeholder="CowName" class="required" oninput="validaNome()" value=<?php if(isset($criacao))echo $criacao['nome'] ?>><br>
                <span class="span-required">Nome Inválido</span>
                <label for="cCod">Informe o código do brinco</label><br>
                <input name="cCod" type="number" id="cCod" placeholder="Código brinco" class="required" oninput="validaCodigo()" value=<?php if(isset($criacao))echo $criacao['codbrinco'] ?>><br><br>
                <span class="span-required">Código do brinco inválido!</span>
                <input type="submit" name="acao" value="salvar"><br>
            </div>
        </form>
    </seccion>
</body>
<script>
    const form = document.getElementById('form');
    const campos = document.querySelectorAll('.required');
    const spans = document.querySelectorAll('.span-required');

    function validaNome(){
        if(campos[0].value.length < 3){
            setError(0);
            return false;
            setError(0);
        }
        else{
            removeError(0);
        }
        removeError(0);
        return true;
    }

    function validaCodigo(){
        if(campos[1].value.length < 8){
            setError(1);
            return false;
            setError(1);
        }
        else{
            removeError(1);
            return true;
        }
    }

    function removeError(index){
        if(!index && index != 0)
        {
            for(var i = 0; i < campos.length-1; i++)
            {
                campos[i].style.border = '';
                spans[i].style.display = 'none';
            }
        }
        else
        {
            campos[index].style.border = '';
            spans[index].style.display = 'none';
        }
        campos[index].style.border = '';
        spans[index].style.display = 'none';
    }
    function setError(index){
        campos[index].style.border = '2px solid #e63636';
        spans[index].style.display = 'block';
    }


</script>
<?php
    $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    $busca = isset($_POST['busca'])?$_POST['busca']:"";
    $query = 'SELECT * FROM registro.criacao order by id';

    $stmt = $conexao->prepare($query);
    $stmt->execute();
    $listacriacao = $stmt->fetchAll();

    echo '<table class="table">';
    echo'   <tr>
                <th>ID</th><th>nomeDaVaca</th><th>códigoDoBrinco</th><th>Edit</th><th>Del</th>
            </tr>';
    foreach($listacriacao as $criacao){
        $editar = '<a href=edicao.php?acao=editar&id='.$criacao['id'].'> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
        </svg> </a>';
        $excluir = '<a href=acaoEdicao.php?acao=excluir&id='.$criacao['id'].'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
        </svg></a>';
        echo "<tr>";
        echo "<td>".$criacao['id']."</td><td>".$criacao['nome']."</td><td>".$criacao['codbrinco']."</td><td>".$editar."</td><td>".$excluir."</td>";
        echo "</tr>";
    }
    echo "</table";
?>