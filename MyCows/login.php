<!DOCTYPE html>
<head>
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
</head>
<body>
    <form action="acaologin.php" method="post">
        <div class="inputbox">
            <h1>Login</h1>
            <label for="user">Usuário<br>
            <input type="text" name="user" id="user"><br>
            <label for="password">Senha<br>
            <input type="password" name="password" id="password"><br>
            <button name="enviar" type="submit" value="enviar">Enviar</button>
        </div>
    </form>
        <div class="inputbox">
            <?php
                $cadastrar = "<a href='cliente.php?acao=cadastrar'>Cadastrar</a>";
                echo "$cadastrar";
            ?>
        </div>