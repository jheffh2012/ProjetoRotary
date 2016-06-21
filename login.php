<!DOCTYPE html>
<html>
<head>
	<title>Login para Análise Rotary</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script type="text/javascript" src="js/jquery/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="js/angular/angular.min.js"></script>
	<script type="text/javascript" src="js/angular/ui-bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular/ngStorage.min.js"></script>
	<script type="text/javascript" src="js/login.module.js"></script>
</head>
<body ng-app="login">
	<form class="form-group" ng-controller="loginController">
		<div class="row">
			<label for="inputUsuario" class="col-sm-2">Usuário</label>
			<div class="col-sm-10">
				<input type="text" ng-model="u.usuario" class="form-control" id="inputUsuario" placeholder="Digite o Usuário"></input>
			</div>
		</div>
		<div style="height: 10px;">
			
		</div>
		<div class="row">
			<label for="inputSenha" class="col-sm-2">Senha:</label>
			<div class="col-sm-10">
				<input type="password" ng-model="u.senha" class="form-control" id="inputSenha" placeholder="Digite a senha"></input>
			</div>
		</div>
		<div style="height: 10px;">
			
		</div>
		<div class="row">
			<div class="col-sm-6">
				<button class="form-control btn btn-primary" ng-click="logar()">Login</button>
			</div>
			<div class="col-sm-6">
				<button class="form-control btn btn-danger">Cancelar</button>
			</div>
		</div>

	</form>
</body>
</html>