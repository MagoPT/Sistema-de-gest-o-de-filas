<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V13</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    <script src="../actions.js"></script>
</head>
<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('../../img/medico.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" method="post" action="register.php" id="register-form">
					<span class="login100-form-title p-b-59">
						Registar
					</span>

					<div class="wrap-input100 validate-input" data-validate="É necessario inserir o nome">
						<span class="label-input100">Primeiro Nome</span>
						<input class="input100" type="text" name="nome" placeholder="Nome...">
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate="É necessario inserir o apelido">
						<span class="label-input100">Apelido</span>
						<input class="input100" type="text" name="apelido" placeholder="Apelido...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "É necessario inserir o email">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email...">
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "É necessario inserir a sua especialidade">
						<span class="label-input100">Especialidade</span><br>
                        <label class="checkbox-inline">
                            <input type="radio" value="Geral" name="especialidade">Geral
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="Oftalmologista" name="especialidade">Oftalmologista
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="Cardiologia" name="especialidade">Cardiologia
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="Psicologia" name="especialidade">Psicologia
                        </label>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password é necessaria">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "É necessario repetir a password">
						<span class="label-input100">Repita a Password</span>
						<input class="input100" type="password" name="repeat-pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Eu concordo com os
									<a href="#" class="txt2 hov1">
										Termos e condições
									</a>
								</span>
							</label>
						</div>

						
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div><!--
							<button id="btn-submit" class="login100-form-btn form-signin" onclick='regist()'>
								Registar
							</button> -->
                            <input type="submit" value="registar">
						</div>

						<a href="../" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Entrar
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>