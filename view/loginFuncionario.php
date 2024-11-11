

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
	integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">


<title>Login</title>
</head>
<body>
	<main id="container">
		<form action="index.php?acao=autenticar" method="post" id="login_form">
			<div id="form_header">
				<h1>Login</h1>

			</div>

			<div id="inputs">
				<div class="input-box">
					<label for="txtloginfuncionario"> Login
						<div class="input-field">
							<i class="fa-solid fa-circle-user"></i> <input type="text"
								id="txtloginfuncionario" name="txtloginfuncionario" autocomplete="off" required>
						</div>


					</label>

				</div>




			</div>
			<div class="input-box">
				<label for="txtsenhafuncionario"> Senha
					<div class="input-field">
						<i class="fa-solid fa-lock"></i> <input type="password"
							id="txtsenhafuncionario" name="txtsenhafuncionario" autocomplete="off" required>
					</div>


				</label>



			</div>
			<input type="hidden" name="acao" value="login">
			<button type="submit" id="login_button" value="Logar">login
			</button>


		</form>
	</main>

</body>
</html>