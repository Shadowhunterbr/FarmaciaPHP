<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view\logins\estiloLoginFunc.css">
    <title>Login Funcionario</title>
</head>
<body>

<form action="index.php?acao=autenticar" method="post" id="login_form"> 
    <div class="login-box">
        <div class="login-header">
            <header>Bem Vindo!</header>
        </div>
        <div class="input-box">
            <input type="text" class="input-field" placeholder="Email" autocomplete="off" name="txtloginfuncionario" required>
        </div>
        <div class="input-box">
            <input type="password" class="input-field" placeholder="Password" name="txtsenhafuncionario" autocomplete="off" required>
        </div>
        <div>
        <section>
            <input type="checkbox" id="check">
            <label for="check">Lembre-me</label>
        </section>
        <section>
            <a href="#">Esqueceu a Senha?</a>
        </section>
        </div>
        <div class="input-submit">
            <button class="submit-btn"></button>
            <label type="submit" >Entrar</label>
        </div>
        <div>
            <br> <br>
            <a href="index.php?acao=loginCliente" class="voltarLogin">Entrar como cliente</a>
        </div>
    </div>
    
	</form>

</body>
</html>