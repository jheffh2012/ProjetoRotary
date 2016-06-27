<!DOCTYPE html>
<html ng-app="login">
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
<body ng-controller="loginController">
	<div class="container" style="">
		<form class="form-signin">
			<h2 class="form-signin-heading">Login</h2>
			<label for="inputEmail" class="sr-only">Usuário</label>
			<input type="text" id="inputEmail" ng-model="u.usuario" class="form-control" placeholder="Usuário" required autofocus>
			<div style="height: 10px">
				
			</div>
			<label for="inputPassword" class="sr-only">Senha</label>
			<input type="password" id="inputPassword" ng-model="u.senha" class="form-control" placeholder="Senha" required>
			<button class="btn btn-lg btn-primary btn-block" ng-click="logar()" type="submit">Entrar</button>
			<div ng-if="erroLogin">
				<label class="form-control" style="color: #FF0000">{{erroLogin}}</label>
			</div>
		</form>
	</div>
</body>
</html>