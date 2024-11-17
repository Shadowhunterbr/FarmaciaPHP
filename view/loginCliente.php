<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<title>Login</title>
</head>
<body>
	<main id="container">
		<form action="index.php?acao=autenticarCliente" method="post" id="login_form">
			<div id="form_header">
				<h1>Login Cliente</h1>

			</div>

			<div id="inputs">
				<div class="input-box">
					<label for="txtemailCliente"> Login
						<div class="input-field">
							<i class="fa-solid fa-circle-user"></i> <input type="text"
								id="txtemailCliente" name="txtemailCliente" autocomplete="off" required>
						</div>


					</label>

				</div>




			</div>
			<div class="input-box">
				<label for="txtsenhaCliente"> Senha
					<div class="input-field">
						<i class="fa-solid fa-lock"></i> <input type="password"
							id="txtsenhaCliente" name="txtsenhaCliente" autocomplete="off" required>
					</div>


				</label>



			</div>
			<input type="hidden" name="acao" value="login">
			<button type="submit" id="login_button" value="Logar">login
			</button>


		</form>
    
</body>
</html>