<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cadastro</title>
     <!-- font awesome icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css stylesheet -->
    <link rel="stylesheet" href="view\logins\estiloLoginClie.css">
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="index.php?acao=cadastrarCliente" method="POST"> <!-- mudar aqui -->
                <h1>Criar Conta</h1>
                <span>ou use seu e-mail para registro</span>
                <div class="infield">
                    <input type="text" placeholder="Nome" name="txtnome" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="Email" name="txtemail"  required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Senha" name="txtsenha"  required/>
                    <label></label>
                </div> 
                <div class="infield">
                    <input type="text" placeholder="CPF" name="txtcpf"  required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="number" placeholder="Telefone" name="txttelefone"  required/>
                    <label></label>
                </div>
				<div class="infield">
    <select id="txtgenero" name="txtgenero" class="infield" required>
        <?php 
            foreach ($generos as $gr) { 
                $selected = (isset($clienteData['cod_genero']) && $clienteData['cod_genero'] == $gr['codigo']) ? "selected" : "";
                echo "<option value='" . $gr['codigo'] . "' $selected>" . $gr['genero'] . "</option>";
            }
        ?>
    </select>
    <label></label>
</div>
                <div class="infield">
                    <input type="date" placeholder="Data Nascimento" name="txtdataNascimento"  required/>
                    <label></label>
                </div>
                <button type="submit" class="btnCadastrar">cadastrar</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="index.php?acao=autenticarCliente" method="post">
                <h1>Entrar</h1>
                <span>ou use sua conta</span>
                <div class="infield">
                    <input type="email" placeholder="Email" name="txtemailCliente"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Senha" name="txtsenhaCliente" />
                    <label></label>
                </div>
                <a href="#" class="forgot">Esqueceu sua senha?</a>
                <button type="submit" class="btnLogin">Fazer login</button> <br> <br>
                <div>
                    <br> <br> <br> <br>
                    <a href="index.php?acao=login" class="loginFunc">Login Funcionario</a> <!-- mudar aqui -->
                    <!-- <button class="btnCadastrar" id="btnCadastrar2"><a href="View/loginFuncionario.html">Login Funcionario</a></button></a> -->
                </div>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <img class="img "src="view\logins\img\img-logo.png" alt=""><br>
                    <h1>Bem Vindo!</h1>
                    <p>Registre-se para conhecer o nosso site</p>
                    <button type class="btnLogin2">Fazer login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <img class="img "src="view\logins\img\img-logo.png" alt="">
                    <h1>Cadastrar</h1>
                    <p>Insira seus dados pessoais e comece sua jornada conosco</p><br>
                    <button class="btnCadastrar">Criar Conta</button>
                </div>
            </div>
            <button id="overlayBtn"></button><!-- o problema esta aqui -->
        </div>
    </div>

    
    <!-- js code -->
    <script>
        const container = document.getElementById('container');
        const overlayCon = document.getElementById('overlayCon');
        const overlayBtn = document.getElementById('overlayBtn');

        overlayBtn.addEventListener('click', ()=> {
            container.classList.toggle('right-panel-active');

            overlayBtn.classList.remove('btnScaled');
            window.requestAnimationFrame( ()=> {
                overlayBtn.classList.add('btnScaled');
            })
        });
    </script>

</body>
</html>