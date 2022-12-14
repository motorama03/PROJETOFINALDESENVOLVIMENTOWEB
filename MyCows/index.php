<?php
    session_start();
    if (!isset($_SESSION['id_usuario'])){
        header('location login.php');
    }else{
        header('location: home.php');
        echo 'Bem Vindo'.$_SESSION['usuario'];
    }
?>