<?php 
  session_start();
  if(!isset($_SESSION['usuario'])){
    header('location: login.php');
  }
?>
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
    
</style>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="login.php">Logout</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <label for="">
        <a class="nav-link" href="pesquisa.php"><span >Tabela de dados</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="edicao.php">Cadastrar Vacas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="detalhe.php">Especificações bovinas</a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>-->
    </ul>
    <span class="navbar-text">
        MyCows o seu sistema de controle bovino!
    </span>
  </div>
</nav>

