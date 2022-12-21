<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .span-required{
            font-size: 12px;
            margin: 3px 0 0 1px;
            color: var(--color-red);
            display: none;
        }
    </style>
</head>
<body>
    <form action="acaoCliente.php" method="post" id="post">
    <a href="login.php">Voltar</a> 
        <div class="inputbox">
            <h1>Login</h1>
            <label for="user">Usuário<br>
            <input type="text" name="user" id="user" class="required" oninput="validaUsuario()"><br>
            <span class="span-required">Usuário inválido!</span>
            <label for="password">Senha<br>
            <input type="password" name="password" id="password" class="required" oninput="validaSenha()"><br>
            <span class="span-required">Senha inválida!</span>
            <button name="enviar" type="submit" value="enviar">Enviar</button>
        </div>
    </form>
        <div class="inputbox">
            <?php
                $cadastrar = "<a href='cliente.php?acao=cadastrar'>Cadastrar</a>";
                echo "$cadastrar";
            ?>
        </div>
</body>
<script>
    const form = document.getElementById('form');
    const campos = document.querySelectorAll('.required');
    const spans = document.querySelectorAll('.span-required');

    function validaUsuario(){
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

    function validaSenha(){
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