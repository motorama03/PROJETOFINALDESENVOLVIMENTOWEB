<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="">
    <a href="home.php">Página inicial</a> 
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
            background-color: gray;
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
        @media screen and (max-width: 768px){
        section ,  aside{
        width: 100%;
        padding: 0%;
        background-color: rgb(80, 41, 41);
        margin: auto;
        }
        }
        @media screen and (max-width: 600px){
            div li{
            text-align: center;
            background-color: rgb(83, 34, 34);
            width: 100%;
            margin: auto;
            }

        }
        @media screen and (max-width:300px){
            table{
                background-color: darkslategray;
            }
            img{
                width: 100%;
            }
        }
</style>
    <form method="post">
        <div class="inputbox">
            <label for="busca"  ></label>Pesquisar por nome<br>
            <input type="text" id="busca" name="busca" value="" ><br>
            <input type="submit" name="pesquisa" value="Pesquisa" class='btn btn-success'><br>
        </div> 
    </form>       
</body>
<?php
    include_once 'conf.inc.php';
    
    $busca = isset($_POST['busca'])?$_POST['busca']:"";

    $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    $busca = isset($_POST['busca'])?$_POST['busca']:"";
    $query = ' SELECT * FROM registro.criacao LEFT JOIN registro.dadoscriacao on criacao.codbrinco = dadoscriacao.codbrinco';

    if ($busca != ""){ 
        $busca = $busca.'%'; 
        $query .= ' WHERE nome like :busca' ; 
    }
    $stmt = $conexao->prepare($query);
    if($busca != "") 
        $stmt->bindValue(':busca',$busca);

    $stmt->execute();
    $listacriacao = $stmt->fetchAll();

    echo '<table class="table table-striped">';
    echo'   <tr class="table table-striped">
                <th>ID</th><th>nomeDaVaca</th><th>códigoDoBrinco</th><th>códigoDoBrinco</th><th>DataPróximoCio</th><th>DataPróximaCria</th>

            </tr>';
    foreach($listacriacao as $criacao){
        echo "<tr>";
        echo "<td>".$criacao['id']."</td><td>".$criacao['nome']."</td><td>".$criacao['codbrinco']."</td><td>".$criacao['codbrinco']."</td><td>".$criacao['dataCio']."</td><td>".$criacao['dataCria']."</td>";
        echo "</tr>";
    }
    echo "</table";
?>